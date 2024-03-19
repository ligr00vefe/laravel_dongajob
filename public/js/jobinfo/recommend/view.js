$(document).ready(function () {

});

(function () {
    let nextBtn = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.support_buttom a');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            this.target.addEventListener('click', function (e) {

                //--- 로그인이 되지 않았으면 로그인 페이지로
                if (!e.target.dataset.login) {
                    if (confirm(__common.msgCollection('confirm_login'))) {
                        location.href = '/login?redirect=' + location.pathname;
                    }
                }

                //--- 관계자는 지원불가
                if (__common.isStaffCheck(e.target.dataset.type)) {
                    alert(__msg.msgCollection('failure_staff'));
                }

            });
        }
    }

    nextBtn.main();
})()

