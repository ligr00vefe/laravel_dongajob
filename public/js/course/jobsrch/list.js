(function () {
    let form = document.forms;


    let JobCategory = {
        firstSelect: undefined,
        secondSelect: undefined,
        init: function () {
            this.firstSelect = form.firstCategory;
            this.secondSelect = form.secondCategory;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let self = this;

            console.log(self.firstSelect);

            self.firstSelect.addEventListener('change', function (e) {
                self.getCategory(e.target.value);
            });


            self.secondSelect.addEventListener('change', function (e) {
                dd(e.target);
            });
        },
        getCategory: function (id) {
            let self = this;
            __common.getAjax('GET', '/ajax/course/jobsrch/category', {id: id}, function (result) {
                self.setCategory(result.lists);
            })
        },
        setCategory: function (data) {
            this.secondSelect.innerHTML = '';
            for (let key in data) {
                let option = document.createElement('option');
                option.value = key;
                option.textContent = data[key];

                this.secondSelect.appendChild(option);
            }
        }
    }


    JobCategory.main();


})()
