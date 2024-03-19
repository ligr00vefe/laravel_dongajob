(function () {

    let limitBtn = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.table03');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('change', function (e) {
                confirm(e.target.textContent + ' 하시겠습니까?', function () {
                    __common.getAjax('GET', '/superviser/member/manager/limit', {id: e.target.dataset.id, value: e.target.value}, function (result) {
                        location.reload();
                    });
                })

            });
        }
    }

    limitBtn.main();

})();
