(function () {

    //--- 방문자수 그래프 객체
    let visitGraph = {
        obj: undefined,
        name: 'visit',
        type: undefined,
        target: undefined,
        targets: undefined,
        data: undefined,
        init: function () {
            this.obj = this;
            this.type = 'line';
            this.target = [];
            this.targets = [
                document.querySelector('#visit_day_chart canvas').getContext('2d'),
                document.querySelector('#visit_week_chart canvas').getContext('2d'),
                document.querySelector('#visit_month_chart canvas').getContext('2d')
            ];
            this.data = chart.getData(this.name);
        },
        main: function () {
            this.init();
            this.start();
        },
        start: function () {

            let _this = this;

            for (let index = 0; index < _this.targets.length; index++) {
                _this.setting(_this.targets[index], index);
            }
        },
        setting: function (context, index) {

            let _this = this;

            _this.target.push(
                new Chart(
                    context,
                    _this.make(index)
                )
            );
        },
        make: function (index) {
            return chart.getChart(this.obj, this.type, this.name, index);
        },
    }


    //--- 게시판 등록 그래프 객체
    let boardGraph = {
        obj: undefined,
        name: 'board',
        type: undefined,
        target: undefined, // 그래프 객체
        targets: undefined,
        data: undefined,
        init: function () {
            this.obj = this;
            this.type = 'bar';
            this.target = [];
            this.targets = [
                document.querySelector('#board_day_chart canvas').getContext('2d'),
                document.querySelector('#board_week_chart canvas').getContext('2d'),
                document.querySelector('#board_month_chart canvas').getContext('2d')
            ];
            this.data = chart.getData(this.name);
        },
        main: function () {
            this.init();
            this.start();
        },
        start: function () {

            let _this = this;

            for (let index = 0; index < _this.targets.length; index++) {
                _this.setting(_this.targets[index], index);
            }
        },
        setting: function (context, index) {

            let _this = this;

            _this.target.push(
                new Chart(
                    context,
                    _this.make(index)
                )
            );
        },
        make: function (index) {
            return chart.getChart(this.obj, this.type, this.name, index);
        },
    }


    let statisticsDate = {
        now: undefined,
        year: undefined,
        month: undefined,
        day: undefined,
        init: function () {
            this.now = new Date();
            this.year = this.now.getFullYear();
            this.month = this.now.getMonth() + 1;
            this.day = this.now.getDate();
        },
        beforeAfterMonth(label) {

            let _this = this;
            let data = [];


            switch (label) {
                case 'day':
                    for (let i = 6; i > 0; i--) {
                        data.push(
                            new Date(_this.now.getTime() - (i * 24 * 60 * 60 * 1000)).getDate() + '일'
                        );
                    }

                    data.push('오늘');
                    break;

                case 'week':
                    for (let i = 6; i > 0; i--) {
                        data.push(i + '주전');
                    }

                    data.push('이번주');
                    break;

                case 'month':
                    for (let i = 6; i > 0; i--) {

                        if (13 <= this.month - i) {
                            data.push(this.month - 12 + '월');
                        } else {
                            data.push(this.month - i + '월');
                        }
                    }

                    data.push(this.month + '월');

            }

            return data;
        }
    }


    let chart = {
        getChart: function (obj, type, name, index) {

            let _this = this;
            let category = _this.getCategory(index);


            return {
                type: type, // 차트의 형태
                data: { // 차트에 들어갈 데이터
                    labels: statisticsDate.beforeAfterMonth(category),
                    datasets: _this.setData(obj.data, index, name, category)
                },
                options: {
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        ]
                    }
                }
            }

        },
        getCategory: function (index) {
            return [
                'day',
                'week',
                'month'
            ][index];

        },
        getLabel: function (name, index) {

            switch (name) {
                case 'visit':
                    return [
                        '일방문 수',
                        '주간방문 수',
                        '월방문 수'
                    ][index];


                case 'board':
                    return [
                        '이전 취업수기',
                        '최신 취업수기',
                        '프로그램 참여 후기'
                    ][index];

            }


        },
        getData: function (mode) {

            let data;
            __common.loadingStart('table03');
            __common.getAjax('GET', `/ajax/statistics/${mode}`, {}, function (result) {
                data = result;
            }, false);
            __common.loadingEnd();
            return data;
        },
        setData: function (data, index, name, category) {

            let _this = this;
            let graph = [];

            if (Array.isArray(data[category][0])) {
                let length = data[category].length;
                for (let i = 0; i < length; i++) {
                    let label = _this.getLabel(name, i);
                    graph.push(_this.setGraph(data[category][i], label))
                }

            } else {
                let label = _this.getLabel(name, index);
                graph.push(_this.setGraph(data[category], label))
            }

            return graph;
        },
        setGraph: function (data, label) {
            return { //데이터
                label: label,
                fill: true,
                data: data,
                backgroundColor: [
                    //색상
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    //경계선 색상
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1 //경계선 굵기
            }
        },


    }


    statisticsDate.init();
    visitGraph.main();
    boardGraph.main();

})
();
