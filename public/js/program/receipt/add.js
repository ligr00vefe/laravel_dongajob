(function () {

    let form = document.forms;
    let id = form.program_id;

    //--- 강좌 신청 버튼 객체
    let applicationBtn = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.btn-register');
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
                if (!vaildation.problem) {
                    form.submit();
                } else {
                    vaildation.msg ? (function () {
                        alert(vaildation.msg)
                        //location.href = '/program/receipt';
                    })() : '';

                }
            });
        },
        validation: function () {

            let data = {
                problem: false,
                msg: '',
            }


            //--- 개인정보수집동의서 체크 확인
            let inputs = document.querySelectorAll('.fisrt-checkCircle');
            for (let input of inputs) {
                if (!input.checked) {
                    alert('개인정보 수집 동의서 확인후 신청 바랍니다.');
                    data.problem = true;
                    break;
                }

            }
            // var agree01 = document.getElementById('agree01-01');
            // var agree02 = document.getElementById('agree02-01');
            //
            // if (!agree01.checked) {
            //     alert('개인정보 수집·이용·제공에 동의하셔야 작성 가능합니다.');
            //     data.problem = true;
            //     break;
            // }
            // if (!agree02.checked) {
            //     alert('개인정보 제3자 제공에 동의하셔야 작성 가능합니다.');
            //     data.problem = true;
            //     break;
            // }

            if (data.problem)
                return data;

            __common.getAjax('GET', '/ajax/program/receipt/check', {program_id: id.value}, function (result) {

                //--- 이미 예약을 하였을 때
                if (result.status == 204) {
                    data.problem = true;
                    data.msg = __msg.msgCollection('already_reservation') + '\n게시판으로 이동 됩니다.';
                } else if (result.stauts == 206) {
                    data.problem = true;
                    data.msg = __msg.msgCollection('over_reservation')  + '\n게시판으로 이동 됩니다.';
                } else if (result.status == 404) {
                    data.problem = true;
                    data.msg = __msg.msgCollection('reapply_reservation')  + '\n게시판으로 이동 됩니다.';
                }

            }, false);

            return data;
        }
    }


    applicationBtn.main();

})();
