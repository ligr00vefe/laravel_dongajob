(function () {

    let form = document.forms;


    let saveBtn = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.btn-save');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('click', function () {

                //--- 유효성 검사
                let validation = _this.validation();
                if (validation.status) {
                    alert(validation.msg);
                    return;
                }

                form.submit();

            });

        },
        validation: function () {
            let enterprise = form.enterprise.value;
            let category = form.category.value;
            let support_division = form.support_division.value;
            let support_job = form.support_job.value;
            let next_round = form.next_round.value;
            let next_round_schedule = form.next_round_schedule.value;
            let interview_agree01 = document.getElementById('agree01-01').checked;
            let interview_agree02 = document.getElementById('agree02-01').checked;
            let msg = '';

            console.log(
                document.getElementById('agree02-01')
            );

            if(!enterprise) {
                msg = '지원기업명 입력 바랍니다.';
            } else if(!category) {
                msg = '지원구분 선택 바랍니다.';
            }else if(!support_division) {
                msg = '지원사업부 입력 바랍니다.';
            }else if(!support_job) {
                msg = '지원직무 입력 바랍니다.';
            }else if(!next_round) {
                msg = '다음 전형 선택 바랍니다.';
            }else if(!next_round_schedule) {
                msg = '다음 전형 일정 선택 바랍니다.';
            }else if(!interview_agree01) {
                msg = '개인정보 수집동의서에 동의 바랍니다.';
            }else if(!interview_agree02) {
                msg = '개인정보 수집동의서에 동의 바랍니다.';
            }

            return {
                status : !!msg,
                msg : msg
            };

        }
    }



    saveBtn.main();
})();




