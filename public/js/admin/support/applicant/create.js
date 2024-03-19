(function () {

    let form = document.forms;
    let nameInput = form.name;
    let studentInput = form.account;

    //--- 학번확인 버튼 객체
    let confirmBtn = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.student-confirm');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('click', function () {

                //--- 유효성검사
                let validation = _this.validation();
                if (validation.problem) {
                    alert(validation.msg, 'warning');
                    return;
                }

                //--- 학생정보 가져오기
                let studentInfo = _this.searchStudent()
                if (studentInfo) {
                    _this.make(studentInfo); // html 생성
                } else {
                    alert('존재하지 않는 학생입니다.', 'warning');
                }
            });
        },
        validation: function () {

            let problem = false;
            let studentName = nameInput.value;
            let studentId = studentInput.value;

            let data = {
                problem: false,
                msg: ''
            }
            // 이름 검사
            if (studentName.length < 1) {
                data.msg = __msg.msgCollection('student_name_check');
                data.problem = true;

                // 학번 길이 검사
            } else if (studentId.length < 8) {
                data.msg = __msg.msgCollection('account_check');
                data.problem = true;
            }

            return data;
        },
        searchStudent: function () {

            let studentInfo = '';

            __common.getAjax('POST', '/ajax/student/search', {account: studentInput.value}, function (result) {
                if (result.status != 404) {
                    studentInfo = result.data;
                }
            }, false);

            return studentInfo;
        },
        make: function (info) {

            let table = document.getElementById('search_table');
            let html = '';

            html += '<h2 class="search-table_title mgt50">신청자 정보</h2>';

            for (let key in info) {
                let title = this.getTile(key);
                html += `<tr><th>${title}</th><td>${info[key]}</td></tr>`;
            }

            table.innerHTML = html;
            table.classList.remove('none');
        },
        getTile: function (key) {

            let list = {
                'account': '학번',
                'name': '이름',
                'university': '대학',
                'department': '학부(과)',
                'grade': '학년',
                'academic': '학적',
                'email': '이메일',
                'phone_number': '휴대폰',
                'number': '전화번호'
            };

            return list[key];
        }
    }

    //--- 추가 버튼 객체
    let addBtn = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.btn_submit');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('click', function () {

                form.submit();

            });
        }
    }

    confirmBtn.main();
    addBtn.main();
})();

