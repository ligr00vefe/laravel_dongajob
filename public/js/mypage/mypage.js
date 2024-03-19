(function () {

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

    searchBox.main();

})()
