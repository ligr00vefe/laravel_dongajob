(function () {

        let date;
        let year;
        let month;
        let day;
        let week;
        let weekList = ['일', '월', '화', '수', '목', '금', '토'];

        //--- 최초 load 시 함수 실행
        init();


        let campusEvent = {
            main: function () {

                //--- 캠퍼스 선택 이벤트
                document.querySelector('.choose-campus').addEventListener('click', function (e) {

                    if (e.target.nodeName !== 'LABEL')
                        return;

                    document.getElementById(e.target.getAttribute('for')).checked = true;


                    // loading start
                    loadingStart('.room-list');

                    // 스터디룸 데이터 가져오기
                    getRoom();

                    // 희망 시간대 안내문구 띄우기
                    timeGuide();

                    // 다음 버튼 disable 처리
                    nextBtn.disabled();
                });

            }
        }


        let dateEvent = {
            checkClass: 'checked',
            target: '',
            main: function () {

                let _this = this;

                //--- 날짜 선택 이벤트
                document.querySelector('.choose-date').addEventListener('click', function (e) {

                    if (!e.target.classList.contains('_vail'))
                        return;

                    //--- 클릭된 target에 따라 active 시킬 부모 초기화
                    _this.target = e.target;
                    switch (_this.target.nodeName) {
                        case 'P':
                            _this.target = _this.target.parentNode.parentNode;
                            break;

                        case 'DIV':
                            _this.target = _this.target.parentNode;
                            break;
                    }

                    // 날짜에 active 되어있는 class 모두 제거
                    _this.activeRemove();

                    // 데이터 저장
                    _this.dataSave();

                    // 날짜 변경
                    _this.titleChange();

                    // 로딩바 실행
                    loadingStart('.room-list');

                    // 스터디룸 데이터 가져오기
                    getRoom();

                    // 희망 시간대 안내문구 띄우기
                    timeGuide();

                    // 다음 버튼 disable 처리
                    nextBtn.disabled();

                });

            },

            activeRemove: function () {

                //--- 날짜 리스트를 순회하며 active 되어있는 element의 클래스를 remove 시킨다.
                let lists = document.querySelectorAll('.day-list');
                for (let list of lists) {
                    list.classList.remove(this.checkClass);
                }

                this.target.classList.add(this.checkClass);
            },

            //--- 변경한 데이터 저장
            dataSave: function () {

                // 선택된 시간대 element
                let choiceEle = document.querySelector('.choose-date .checked .day-num p');

                // iife 전역에 선택되어 있는 년도,월,날,요일 저장
                year = choiceEle.dataset.year;
                month = choiceEle.dataset.month;
                day = choiceEle.dataset.day;
                week = choiceEle.dataset.week;
                date = year + '-' + month + '-' + day;

                // form 에 넘길 input 에 년-월-시 저장
                document.forms.date.value = date;
            },

            //--- 선택된 날짜로 title 을 변경
            titleChange: function () {
                let title = document.querySelector('.chosen-date h4');
                title.textContent = month + '월 ' + day + '일 ' + '(' + weekList[week] + ')';
            }
        }


        //--- 스터디룸 클릭 이벤트
        document.querySelector('.room-list').addEventListener('click', function (e) {

            if (e.target.nodeName != 'INPUT')
                return;


            loadingStart('.available-time ol');
            getTime();
            nextBtn.disabled();

        });


        function getRoom() {

            let data = {
                date: date,
                campus: document.querySelector('input[name="campus"]:checked').value
            };

            __common.getAjax('GET', '/ajax/studyroom/room', data, function (result) {

                if (result.status != 200) {
                    return false;
                }

                document.querySelector('.room-list').innerHTML = result.lists;
            });

        }


        function getTime() {

            if (!document.querySelector('input[name="room_id"]:checked'))
                return;


            let data = {
                campus: document.querySelector('input[name="campus"]:checked').value,
                id: document.querySelector('input[name="room_id"]:checked').value,
                date: document.forms.date.value
            };

            __common.getAjax('GET', '/ajax/studyroom/time', data, function (result) {

                if (result.status != 200)
                    return false;

                document.querySelector('.available-time ol').innerHTML = result.lists;
            });
        }


        function timeGuide() {
            document.querySelector('.available-time ol ').innerHTML = ' <div>스터디룸 선택 후 선택 가능 합니다.</div>';
        }

        function loadingStart(ele) {
            document.querySelector(ele).innerHTML = '';
            __common.loadingStart(ele);
        }


        //--- 희망 시간대 클릭 이벤트
        let timeEvent = {
            target: '',
            selectClass: 'selected-time',
            disableClass: 'disabled-time',
            already: false,
            index: 0,
            maxCnt: 3,

            main: function () {

                let _this = this;

                //--- 시간대 클릭 이벤트
                document.querySelector('.available-time').addEventListener('click', function (e) {

                    if (e.target.nodeName != 'P')
                        return;

                    _this.target = e.target.parentNode; // li node
                    _this.already = false; // false 로 세팅, 눌렀는지 체크하는 변수
                    _this.index = $(_this.target).index();

                    //--- disable 상태는 return
                    if (_this.target.classList.contains(_this.disableClass))
                        return;

                    //--- 유효성 검사
                    let vail = _this.validation();
                    if (vail.problem) {
                        vail.msg ? alert(vail.msg) : '';
                        return false;
                    }

                    //--- target select 처리
                    if (_this.already)
                        _this.target.classList.remove(_this.selectClass);
                    else
                        _this.target.classList.add(_this.selectClass);


                    //--- 다음 버튼 disable 해제
                    nextBtn.disabledCancle();
                });

            },

            validation: function () {


                let cnt = document.querySelectorAll('.available-time ol .' + this.selectClass).length; // 선택한 시간대 갯수

                //--- 클릭한 시간대가 이미 select 되어 있는 시간대라면 cnt 1개 마이너스 한다.
                if (this.target.classList.contains(this.selectClass)) {
                    this.already = true; // 이미 선택한 시간대는 true 로 변경해준다.
                    cnt--;
                }


                //--- 3시간 이상 선택했는지 체크
                if (cnt >= this.maxCnt) {
                    return {
                        'msg': this.maxCnt + ' 시간 이상 선택 불가능 합니다.',
                        'problem': true,
                    };
                }

                // 연속된 시간을 선택하지 않았을 경우 체크
                if (!this.already && cnt) { // 선택한 시간대를 해제하는 경우가아니고, 첫번째 선택이 아닐경우 실행

                    let prevSibling = this.target.previousElementSibling;
                    let nextSibling = this.target.nextElementSibling;


                    // 이전 시간대가 선택된 시간이라면 return
                    if (prevSibling && prevSibling.classList.contains(this.selectClass)) {
                        return {'problem': false}
                    }

                    // 이후 시간대가 선택된 시간이라면 return
                    if (nextSibling && nextSibling.classList.contains(this.selectClass)) {
                        return {'problem': false}
                    }

                    return {
                        'msg': '연속된 시간만 선택하실수가 있습니다.',
                        'problem': true,
                    };

                }


                return {
                    'problem': false
                }
            }
        }

        //--- 다음버튼 이벤트
        let nextBtn = {
            target: undefined,
            init: function () {
                this.target = document.querySelector('.btn-next');
            },
            main: function () {
                this.init();
                this.event();
            },
            event: function () {
                let _this = this;
                _this.target.addEventListener('click', function () {
                    _this.validation();
                });
            },
            disabled: function () {
                this.target.disabled = true;
            },
            disabledCancle: function () {
                this.target.disabled = false;
            },
            validation: function () {
                let forms = document.forms;
                let campus = document.querySelector('input[name="campus"]:checked'); // 캠퍼스
                let date = forms.date; // 날짜
                let times = document.querySelectorAll('.input_time'); // 시간대

                //--- 로그인 체크
                if (!this.loginCheck()) {
                    if (confirm(__msg.msgCollection('confirm_login'))) {
                        location.href = '/login';
                    }
                    return;
                }

                //--- 관계자 체크
                if (__common.isStaffCheck(forms.type.value)) {
                    alert(__msg.msgCollection('failure_staff'));
                    return;
                }

                //--- 예약자 no-show 및 일주일내 예약 되어 있는지 체크
                if (this.reservationCheck()) {
                    return;
                }

                this.timeSelected();

                // 서브밋
                forms.submit();
            },
            loginCheck: function () {

                let chk = false;
                __common.getAjax('GET', '/ajax/login/check', '', function (result) {
                    chk = result.check;
                }, false);

                return chk;
            },
            reservationCheck: function () {

                let chk = false;
                __common.getAjax('GET', '/ajax/studyroom/possible', '', function (result) {

                    chk = result.result;
                    if (chk) {
                        alert(result.msg);
                    }

                }, false);

                return chk;

            },
            timeSelected: function () {
                let selecteds = document.querySelectorAll('.' + timeEvent.selectClass);
                for (selected of selecteds) {
                    selected.querySelector('.input_time').checked = true;
                }
            }
        }

        function init() {
            __common.loadingStart('.room-list');
            getRoom();
        }


        campusEvent.main();
        dateEvent.main();
        timeEvent.main();
        nextBtn.main();
    }
)
();

$(document).ready(function () {
    $('.radio-campus').on('click', function () {
        var campusRadioId = $(this).attr('id');

        if (campusRadioId == "campus01") {
            $('.campus01-label').children('img').attr('src', '/img/campus_icon01_w.png');
            $('.campus02-label').children('img').attr('src', '/img/campus_icon02.png');
        } else {
            $('.campus01-label').children('img').attr('src', '/img/campus_icon01.png');
            $('.campus02-label').children('img').attr('src', '/img/campus_icon02_w.png');
        }
    });
});
