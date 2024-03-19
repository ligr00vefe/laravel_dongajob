(function () {

    //--- submit 버튼
    let submitEvent = {
        target: undefined, // submit button
        form: undefined, // form element
        minCnt: 0,
        infos: {
            name: undefined,
            studentId: undefined,
            usePeople: undefined,
            usePurpose: undefined,
        },
        init: function () {
            this.target = document.querySelector('.btn-save');
            this.form = document.forms;
            this.minCnt = this.form.min_personnel.value;
        },
        main: function () {
            this.init(); // 각종 프로퍼티 세팅
            this.event(); // 이벤트 등록
        },
        event: function () {

            let _this = this;

            _this.target.addEventListener('click', function () {

                //--- 유효성 검사
                if (_this.validation())
                    return;

                //--- 예약 상황 체크
                if (_this.infoCheck()) {
                    document.forms.submit();
                }
            });
        },

        validation: function () {

            this.infos.name = this.form.name;
            this.infos.studentId = this.form.account;
            this.infos.usePeople = this.form.use_people;
            this.infos.usePurpose = this.form.use_purpose;
            let agree01 = document.getElementById('agree01-01');
            let agree02 = document.getElementById('agree02-01');
            let msg = '';

            if (this.minCheck()) {  // 최소인원 체크
                msg = '예약하시기에 최소 인원에 맞지 않습니다. \n최소 인원 : ' + this.minCnt;
            } else if (this.infos.name.value == '') {
                msg = '이름을 등록해주세요.';
                this.infos.name.focus();
            } else if (this.infos.studentId.value == '') {
                msg = '학번을 등록해주세요.';
                this.infos.studentId.focus();
            } else if (this.infos.usePeople.value == '') {
                msg = '사용인원을 등록해주세요.';
                this.infos.usePeople.focus();
            } else if (this.infos.usePurpose.value == '') {
                msg = '사용목적을 등록해주세요.';
                this.infos.usePurpose.focus();
            } else if (!agree01.checked) {
                msg = '유의사항 숙지후 이용 가능합니다.';
                agree01.focus();
            } else if (!agree02.checked) {
                msg = '개인정보수집동의서 동의후 이용 가능합니다.';
                agree02.focus();
            }


            if (msg) {
                alert(msg);
                return true;
            }

        },

        minCheck: function () {

            // cnt = 동반 사용자 + 예약자
            let cnt = document.querySelectorAll('.companion_id').length + 1;
            let problem = true;

            // 총 예약인원이 최소인원보다 많은지 체크
            if (cnt >= this.minCnt) {
                problem = false;
            }

            return problem;
        },

        infoCheck: function () {

            let next = false;

            //--- 룸아이디 가져오기
            let roomId = document.forms.room_id.value;

            //--- 동반사용자 가져오기
            let companion = document.querySelectorAll('.companion_id');
            let reservationCnt = companion.length + 1; // 예약총인원(+1은 예약자를 의미)
            let companionUsers = [];
            for (let ele of companion) {
                companionUsers.push(ele.value);
            }


            let msg =
                '캠퍼스 : ' + this.form.campus_name.value + '\n' +
                '스터디룸 : ' + this.form.study_room_name.value + '\n' +
                '예약일시 : ' + this.form.reservation_date_info.value + '\n' +
                '예약자 : ' + this.infos.name.value + '\n' +
                '학번 : ' + this.infos.studentId.value + '\n' +
                '사용인원 : ' + this.infos.usePeople.value + '\n' +
                '동반사용자 학번: ' + companionUsers.join(', ') + '\n\n' +
                '위의 예약정보가 맞다면 확인 버튼을 눌러주세요.';

            if (confirm(msg)) {

                //--- 예약정보 체크
                __common.getAjax('GET', '/ajax/studyroom/check', {
                    cnt: reservationCnt,
                    room_id: roomId
                }, function (result) {

                    //... TODO : 예약 체크 해야함

                    next = true;
                }, false);
            }


            return next;
        }


    }

    //--- 동반 사용자 추가
    let addBtn = {
        target: undefined, // 동반사용자 추가 버튼
        tbody: undefined,
        maxCnt: 0, // 최대 수용인원
        init: function () {
            this.target = document.querySelector('.btn-add');
            this.tbody = document.querySelector('.companion_table tbody');
            this.maxCnt = document.forms.max_personnel.value;
        },
        main: function () {
            this.init();
            this.event();
            this.remove();
        },
        event: function () {

            let _this = this;

            _this.target.addEventListener('click', function () {

                let companion = document.querySelector('.search_account'); // 동반 사용자 학번

                // 유효성 검사
                if (_this.addValidation(companion))
                    return;


                // 동반 사용자 추가
                __common.getAjax('POST', '/ajax/student/search', {account: companion.value}, function (result) {

                    // 없는 학생 일때 return
                    if (result.status == 404) {
                        alert(__msg.msgCollection('failure_account'));
                        return;
                    }

                    // 등록하려는 사람이 자신일때 return
                    if (result.status == 204) {
                        alert(__msg.msgCollection('failure_self'));
                        return;
                    }


                    // 동반사용자 추가
                    _this.add(result.data);
                    companion.value = ''; // 동반사용자가 추가 되었기 떄문에 적혀있던 학번 지우기
                });
            });
        },


        //--- 동반 사용자 추가에 대한 유효성검사
        addValidation: function (companion) {


            // 학번을 입력하지 않았을 때
            if (!companion.value) {
                alert(__msg.msgCollection('empty_account'));
                companion.focus();

                return true;
            }

            // 이미 등록되어 있는 동반 사용자가 있는지
            let companions = document.querySelectorAll('.companion_id');
            for (let ele of companions) {

                // 입력한 학번과 이미 등록한 학번이 다르다면 continue
                if (ele.value != companion.value)
                    continue;

                // 이미 등록하였을 때
                alert(__msg.msgCollection('already_account'));
                return true;
            }


            // 최대수용인원체크 (+ 1하는 이유는 등록자가 + 1이 되기 때문에)
            if ((companions.length + 1) >= this.maxCnt) {
                alert(__msg.msgCollection('max_add'));
                this.btnDisabled(true); // 추가 버튼 비활성화
                return true;
            }

            // 일주일에 2번 이상, no-show 2회 인지
            let problem = false;
            __common.getAjax('GET', '/ajax/studyroom/possible', {account: companion.value}, function (result) {
                if (!result.result) {
                    problem = false;
                    return
                }

                alert(result.msg);
                problem = true;
                return;


            }, false);

            return problem;
        },

        // 동반사용자 추가
        add: function (data) {

            let trs = document.querySelectorAll('.companion_table tbody tr');


            let tr = document.createElement('tr');
            let th = document.createElement('th');
            let td = document.createElement('td');
            let input = document.createElement('input');
            let button = document.createElement('button');

            th.textContent = '학번 ' + trs.length;

            input.setAttribute('type', 'text');
            input.setAttribute('name', 'companion_id[]');
            input.classList.add('companion_id');
            input.classList.add('w300');
            input.classList.add('input-add');
            input.value = data.account;
            input.readOnly = true;


            button.setAttribute('type', 'button');
            button.classList.add('btn02');
            button.classList.add('btn-remove');
            button.textContent = '삭제';

            td.append(input);
            td.append(button);

            tr.append(th);
            tr.append(td);

            this.tbody.appendChild(tr);
        },

        // 동반 사용자 제거
        remove: function () {

            let _this = this;

            document.querySelector('.companion_table').addEventListener('click', function (e) {

                //--- 클릭한 대상체가 삭제 버튼이 아니라면 return
                if (!e.target.classList.contains('btn-remove'))
                    return;


                // 삭제하려는 학번의 tr 태그 remove
                _this.tbody.removeChild(e.target.parentNode.parentNode);
                _this.btnDisabled(false); // 추가 버튼 활성화


                // 도중에 빠진 tr 태그로 인해 1,2,3 . . . 번호가 맞지 않기 때문에 th 번호 재배열 처리
                let th = document.querySelectorAll('.companion_table th');
                for (let i = 1; i < th.length; i++) {
                    th[i].textContent = '학번 ' + i;
                }

            });
        },
        btnDisabled: function (flag) {

            if (typeof flag == 'boolean')
                this.target.disabled = flag;
        }
    }


    submitEvent.main();
    addBtn.main();

})();
