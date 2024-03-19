(function () {
    let form = document.search_form;


    let firstArea = {
        target: undefined,
        value: undefined,
        content: undefined,
        init: function () {
            this.target = form.firstArea;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;

            _this.target.addEventListener('change', function (e) {

                _this.value = e.target.value;
                _this.content = e.target.textContent;


                secondArea.html();

            })
        }
    }


    let secondArea = {
        target: undefined,
        value: undefined,
        content: undefined,
        init: function () {
            this.target = form.secondArea;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;

            _this.target.addEventListener('change', function (e) {

                _this.value = e.target.value;
                _this.content = e.target.textContent;


            })
        },
        get data() {
            let data = '';
            __common.getAjax('GET', '/ajax/course/employment/area', {key: firstArea.value}, function (result) {


                data = result.lists;

            }, false)

            return data;
        },
        html: function () {
            let data = this.data;
            this.target.innerHTML = data;

        }
    }


    let firstJob = {
        target: undefined,
        value: undefined,
        content: undefined,
        init: function () {
            this.target = document.querySelector('.firstJob');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;

            _this.target.addEventListener('change', function (e) {

                _this.value = e.target.value;
                _this.content = e.target.textContent;


                secondJob.html();
                thirdJob.reset();
            })
        }
    }

    let secondJob = {
        target: undefined,
        value: undefined,
        content: undefined,
        level: undefined,
        init: function () {
            this.target = document.querySelector('.secondJob');
            this.level = 2;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;

            _this.target.addEventListener('change', function (e) {

                _this.value = e.target.value;
                _this.content = e.target.textContent;

                thirdJob.html();
            })
        },
        get data() {
            let data = '';
            __common.getAjax('GET', '/ajax/course/employment/job', {
                key: firstJob.value,
                level: this.level
            }, function (result) {


                data = result.lists;

            }, false)

            return data;
        },
        html: function () {
            let data = this.data;
            this.target.innerHTML = data;

        }
    }

    let thirdJob = {
        target: undefined,
        value: undefined,
        content: undefined,
        level: undefined,
        init: function () {
            this.target = document.querySelector('.thirdJob');
            this.level = 3;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;

            _this.target.addEventListener('change', function (e) {

                _this.value = e.target.value;
                _this.content = e.target.textContent;


            })
        },
        get data() {
            let data = '';
            __common.getAjax('GET', '/ajax/course/employment/job', {
                key: secondJob.value,
                level: this.level
            }, function (result) {


                data = result.lists;

            }, false)

            return data;
        },
        html: function () {
            let data = this.data;
            this.target.innerHTML = data;
        },
        reset: function () {
            this.target.innerHTML = '<option value="">없음</option>';
        }
    }

    let searchBtn = {
        target: undefined,
        key: undefined,
        url: undefined,
        init: function () {
            this.target = document.getElementById('search_btn');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('clcick', function (e) {

                _this.search();
            });
        },
        search: function () {
            form.submit();
        }
    }


    let educationBtn = {
        target: undefined,
        parent : undefined,
        targetAll: undefined,
        init: function () {
            this.target = document.getElementById('education00');
            this.parent = document.querySelector('.education_td');
            this.targetAll = document.getElementsByName('education[]');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.parent.addEventListener('click', function (e) {

                let idList = [
                    'education01',
                    'education02',
                    'education03',
                    'education04',
                    'education05',
                    'education06',
                    'education07',
                    'education08',
                ];


                if (e.target.id == 'education00') { // 학력 무관일떄

                    for (ele of _this.targetAll) {
                        ele.checked = false;
                    }

                    _this.target.checked = true;
                } else if (idList.includes(e.target.id)) {
                    _this.target.checked = false; // 학력 무관만 해제
                }
            })
        }
    }


    let cntSelect = {
        target : undefined,
        init : function () {
            this.target = document.querySelector('#view-item-count');
        },
        main : function () {
            this.init();
            this.event();
        },
        event : function () {
            this.target.addEventListener('change', function (e) {
                searchBtn.search();
            })
        }
    }


    firstArea.main();
    secondArea.main();
    firstJob.main();
    secondJob.main();
    thirdJob.main();
    searchBtn.main();
    educationBtn.main();
    cntSelect.main();


})()
