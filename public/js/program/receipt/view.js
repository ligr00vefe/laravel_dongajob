(function () {

    let form = document.forms;
    let id = form.id;

    //--- 강좌 신청 버튼 객체
    let applicationBtn = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.btn-application');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('click', function (e) {


                //--- 유효성 검사
                let vaildation = _this.validation();
                if (vaildation.problem) {
                    alert(vaildation.msg);
                    return;
                }

                //--- 관계자는 지원불가
                if (__common.isStaffCheck(e.target.dataset.type)) {
                    alert(__msg.msgCollection('failure_staff'));
                    return;
                }

                if (_this.guide()) {
                    form.submit();
                }
            });
        },
        validation: function () {

            let data = {
                problem: false,
                msg: '',
            }

            __common.getAjax('GET', '/ajax/program/receipt/check', {program_id: id.value}, function (result) {

                //--- 이미 예약을 하였을 때
                if (result.status == 204) {
                    data.problem = true;
                    data.msg = __msg.msgCollection('already_reservation') + '\n신청 내역은 마이페이지에서 확인 가능합니다.';
                } else if (result.stauts == 206) {
                    data.problem = true;
                    data.msg = __msg.msgCollection('over_reservation');
                } else if (result.status == 404) {
                    data.problem = true;
                    data.msg = __msg.msgCollection('reapply_reservation');
                }

            }, false);

            return data;
        },
        guide: function () {

            let lectureInfos = lectureTable.getInfo();
            let depositInfos = depositTable.getInfo();

            let msg =
                `＊강좌명 : ${lectureInfos.sbject}\n` +
                `＊접수일시 : ${lectureInfos.reception_date}\n` +
                `＊수강일시 : ${lectureInfos.course_date}\n` +
                `＊수강장소 : ${lectureInfos.location}\n` +
                `＊교재 : ${lectureInfos.text_book}\n` +
                `＊수강료 : ${lectureInfos.tuition_fees}\n\n` +
                `＊입금 마감일시 : ${depositInfos.deadline_date}\n` +
                `＊은행명 : ${depositInfos.bank_name}\n` +
                `＊예금주 : ${depositInfos.account_holder}\n` +
                `＊계좌번호 : ${depositInfos.account_number}\n\n` +
                `프로그램 정보가 확인 되었으면 신청 페이지로 이동 됩니다.\n` +
                `확인 되었으면확인버튼을 눌러주세요.`;

            return confirm(msg);
        }
    }


    //--- 입금 수단 테이블 객체
    let depositTable = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.deadline_table');
        },
        main: function () {
            this.init();
        },
        getAll: function () {
            return document.querySelectorAll('.deadline_table tr td p');
        },
        getInfo: function () {

            let result = {};
            let elements = this.getAll();

            elements.forEach(function (ele, index) {

                switch (index) {
                    case 0:
                        result.deadline_date = ele.textContent;
                        break;
                    case 1:
                        result.bank_name = ele.textContent;
                        break;
                    case 2:
                        result.account_holder = ele.textContent;
                        break;
                    case 3:
                        result.account_number = ele.textContent;
                        break;
                }
            });

            return result;
        }
    }

    //--- 강좌정보 테이블 객체
    let lectureTable = {
        getAll: function () {
            return document.querySelectorAll('.lecture_table tr td p');
        },
        getInfo: function () {

            let result = {};
            let elements = this.getAll();

            elements.forEach(function (ele, index) {

                switch (index) {
                    case 0:
                        result.sbject = ele.textContent;
                        break;
                    case 1:
                        result.status = ele.textContent;
                        break;
                    case 2:
                        result.reception_date = ele.textContent;
                        break;
                    case 3:
                        result.course_date = ele.textContent;
                        break;
                    case 4:
                        result.location = ele.textContent;
                        break;
                    case 5:
                        result.number_students = ele.textContent;
                        break;
                    case 6:
                        result.education_target = ele.textContent;
                        break;
                    case 7:
                        result.student_grade = ele.textContent;
                        break;

                    case 9:
                        result.text_book = ele.textContent;
                        break;
                    case 11:
                        result.tuition_fees = ele.textContent;

                        break;

                }
            });

            return result;
        }
    }


    applicationBtn.main();
    depositTable.main();
})();
