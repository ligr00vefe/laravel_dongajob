(function () {

    let sortBtn = {
        init: function () {
            this.container = document.querySelector('.table03 thead tr');
            this.btns = document.querySelectorAll('.table03 th');
            this.column = document.forms.column.value;
            this.orderBy = document.forms.orderBy.value;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let self = this;
            this.container.addEventListener('click', function (e) {
                let target = self.check(e.target);
                if (!target)
                    return;

                let data = self.converter(self.getIndex(target));
                if (!data.status)
                    return;

                self.location(data);
            })
        },
        check: function (ele) {
            let chk = false;

            switch (ele.nodeName) {
                case 'TH':
                    chk = ele;
                    break;

                case 'I':
                    chk = ele.parentNode;
                    break;
            }

            return chk;

        },
        getIndex: function (ele) {
            let i = 0;
            while ((ele = ele.previousElementSibling) != null) {
                i++;
            }
            return i;
        },
        converter: function (i) {

            let data = {};

            switch (i) {
                case 1:
                    data.status = true;
                    data.column = 'id';
                    break;
                case 2:
                    data.status = true;
                    data.column = 'subject';
                    break;
                case 3:
                    data.status = true;
                    data.column = 'location';
                    break;
                case 4:
                    data.status = true;
                    data.column = 'number_students';
                    break;
                case 7:
                    data.status = true;
                    data.column = 'open';
                    break;
                case 8:
                    data.status = true;
                    data.column = 'status';
                    break;
                default:
                    data.status = false;
                    break;
            }

            return data;
        },
        location: function (data) {
            let orderBy = this.column === data.column ? this.orderBy === 'desc'? 'asc' : 'desc' : 'desc';


            console.log(
                this.column,
                data.column,
                this.column === data.column,
                this.orderBy,
                this.orderBy === 'desc',
                orderBy
            );
            location.href = `?column=${data.column}&orderBy=${orderBy}`;
        }
    }

    sortBtn.main();

})();
