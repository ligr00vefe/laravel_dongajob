window.addEventListener('load', function () {


    (function () {

        let now = new Date();
        let first = new Date(now.getFullYear(), now.getMonth(), 1);
        let pageFirst = first;
        let fullDate = '';


        let moveBtn = {
            target: undefined,
            init: function () {
                this.target = document.querySelector('.date-area');
            },
            main: function () {
                this.init();
                this.event();
            },
            event: function () {
                let _this = this;
                _this.target.addEventListener('click', function (e) {

                    if (e.target.nodeName != 'BUTTON' && !e.target.dataset.type)
                        return;

                    if (e.target.dataset.type == 'prev') _this.prev();
                    else if (e.target.dataset.type == 'next') _this.next();


                    _this.show();
                    _this.getData();

                })
            },
            prev: function () {
                // 이전 달로 이동
                if (pageFirst.getMonth() === 1) {
                    pageFirst = new Date(first.getFullYear() - 1, 12, 1);
                    first = pageFirst;
                } else {
                    pageFirst = new Date(first.getFullYear(), first.getMonth() - 1, 1);
                    first = pageFirst;
                }
            },
            next: function () {
                if (pageFirst.getMonth() === 12) {
                    pageFirst = new Date(first.getFullYear() + 1, 1, 1);
                    first = pageFirst;
                }
                {
                    pageFirst = new Date(first.getFullYear(), first.getMonth() + 1, 1);
                    first = pageFirst;
                }
            },
            show: function () {
                document.querySelector('.date-area h3').textContent = first.getFullYear() + '년 ' + (first.getMonth() + 1) + '월';
            },
            getData: function () {


                let data = [];

                __common.getAjax('GET', '/program/calendar/notice', {date: first.getFullYear() + '-' + __common.addZero((first.getMonth() + 1)) + '-' + '01'}, function (notice) {
                    if (notice.status != 200)
                        return false;


                    __common.getAjax('GET', '/program/calendar/program', {date: first.getFullYear() + '-' + __common.addZero((first.getMonth() + 1)) + '-' + '01'}, function (program) {
                        if (program.status != 200)
                            return false;


                        let noticeCnt = notice.lists.length;
                        for (let i = 0; i < program.lists.length; i++) {
                            notice.lists[noticeCnt + i] = program.lists[i];
                        }

                        setChaleandar(notice.lists);
                    }, false);


                }, false);


            }
        }


        //--- 캘린더 데이터 가져오기
        moveBtn.getData();


        function setChaleandar(list, mode) {
            console.log(list);
            var event = [];
            var lastDay = "";

            $.each(list, function (idx, val) {

                var repeatCheck = false;
                var dateCheck = true;


                var today = moment().format("YYYY-MM-DD");
                var programStartDate = moment(val['schedule_date']).format("YYYY-MM-DD");
                var currDate = programStartDate;
                var endDate = new Date(first.getFullYear(), (first.getMonth() + 1), 0);


                var pushEvent = {
                    title: "\n" + val['subject'] + "\n\n", // 마지막에 줄바꿈2개해줘야 달력에 스크롤안생김.
                    classNames: "reserv-icon__poss" + " groupId_" + 12345,
                    color: "transparent",
                    textColor: "#000000",
                    start: val['schedule_date'],
                    id: val['id'],
                    categoryId: val['category_id'],
                    statusId: val['status_id']
                };

                event.push(pushEvent);
            });

            var calendarEl = document.getElementById('calendar');
            var defaultDate = first.getFullYear() + '-' + __common.addZero(first.getMonth() + 1) + '-' + '01';
            calendarEl.innerHTML = '';

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: "auto",
                plugins: ['dayGrid'],
                defaultDate: defaultDate,
                header: {
                    left: '',
                    center: '',
                    right: ''
                },
                fixedWeekCount: false, // true면 항상 6주고정
                showNonCurrentDates: false, // false 해당 주 아니면 노출X
                contentHeight: "300px",
                events: event,
                eventClick: function (info) {
                    let url = info.event._def.extendedProps.statusId == 1 ? '/program/receipt/' : '/program/notice/';
                    location.href = url + info.event.id + '/view';
                },
                eventRender: function (event, eventElement) {
                    var $event = $(event.el);
                    var $date = moment(event.event.start).format("D");
                    var $statusId = event.event.extendedProps.statusId;
                    var $categoryId = event.event.extendedProps.categoryId;
                    var $statusImg = getNoticeStatusImgAdd($statusId);
                    var $category = getNoticeCategory($categoryId);
                    console.log($statusImg);
                    // console.log($category);

                    $($event).addClass("date_" + $date);
                    $($event).find(".fc-title").prepend($("<span class=\"fc-category\"></span>").html('[' + $category + ']'));
                    $($event).find(".fc-title").prepend($("<div class=\"fc-status-icon\"></div>").html($statusImg));


                },
                navLinks: true,
                navLinkDayClick: function (date, jsEvent) {
                    var currentDate = moment(date).format("YYYY-MM-DD");
                    currentDate = encodeURI(currentDate);

                },
                locale: 'ko',
            });

            calendar.render();

        }

        moveBtn.main();


    })();
});


function getNoticeStatusImgAdd(status) {
    switch (status) {
        case 2 :
            return "<img class='fc-status-icon' src='/img/calendar_notice_icon.png' alt='공지 아이콘' />";
        case 1 :
            return "<img class='fc-status-icon' src='/img/calendar_program_recruit_icon.png' alt='모집 아이콘' />";
    }
}

function getNoticeCategory(category) {
    switch (category) {
        case '100' :
            return "전체";
        case '200' :
            return "취업동아리";
        case '300' :
            return "재직선배 교육";
        case '400' :
            return "자격증 및 실무자 양성과정 교육";
        case '500' :
            return "채용 설명회 및 박람회";
        case '600' :
            return "특강";
        case '700' :
            return "기타";
        default :
            return "전체";
    }

}
