// 검색창 및 게시물 노출 갯수 카운팅이 포함됨
// 추천채용 페이지를 바탕으로 작성되었으나 검색창 or 게시물 카운팅이 있으면 가져다 써도 됨

(function () {

    let searchForm = document.search_form;


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
        keywordTarget: undefined,
        termTarget: undefined,
        data: {},
        init: function () {
            this.keywordTarget = searchForm.keyword;
            this.termTarget = searchForm.term;
        },
        main: function () {
            this.init();
        },
        getTerm: function () {
            return this.termTarget.value;
        },
        getKeyword: function () {

            let elements = this.keywordTarget;
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

            let keyword = this.getKeyword();
            let text = this.getTerm();

            return `?keyword=${keyword.value}&term=${text}`;
        }
    }


    cntBox.main();
    searchBox.main();
})()
