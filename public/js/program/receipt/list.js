(function () {

    let searchForm = document.search;
    let form = document.forms;

    //--- 10,30,60개 selectBox 객체
    let cntBox = {
        target: undefined,
        init: function () {
            this.target = searchForm.view_count;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('change', function (e) {

                _this.move(e.target.value);

            });
        },
        move: function (value) {

            let query = searchBox.getQuery() + '&view_count=' + value;

            location.href = query;
        }
    }


    //--- 검색 객체
    let searchBox = {
        cateTarget: undefined,
        termTarget: undefined,
        data: {},
        init: function () {
            this.cateTarget = searchForm.search_cate;
            this.termTarget = searchForm.term;
        },
        main: function () {
            this.init();
        },
        getTerm: function () {
            return this.termTarget.value;
        },
        getCate: function () {

            let elements = this.cateTarget;
            let result = {};

            for (let option of elements) {

                if (option.selected) {
                    result.value = option.value;
                    result.text = option.textContent;
                    break;
                }
            }

            return result;
        },
        getQuery: function () {

            let cate = this.getCate();
            let text = this.getTerm();

            return `?search_cate=${cate.value}&term=${text}`;
        }
    }


    cntBox.main();
    searchBox.main();
})();
