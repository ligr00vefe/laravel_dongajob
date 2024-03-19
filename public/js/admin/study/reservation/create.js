(function () {

    let form = document.forms;
    let campus_id = document.querySelector('input[name=campus_id]:checked').value;


    //--- 캠퍼스 radio 버튼 객체
    let campusBtn = {
        value: undefined, // 캠퍼스 value 값
        init: function () {
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            document.querySelector('.radio_button_wrap').addEventListener('click', function (e) {

                if (e.target.nodeName != 'INPUT')
                    return;

                campus_id = e.target.value;
                _this.getRoom();
            });
        },
        //--- 선한택 슿학,부민 캠퍼스의 정보를 가져옵니다.
        getRoom: function () {

            let _this = this;
            let problem = false;

            __common.getAjax('GET', '/ajax/studyroom/list', {campus_id: campus_id}, function (result) {
                if (result.status != 200) {
                    problem = true;
                }

                _this.selectBoxHtml(result.lists);
            });

            return problem;
        },

        //--- 가져온 스터디룸의 정보를 가지고 selectbox 재조합
        selectBoxHtml: function (rooms) {

            let option = '<option value="">스터디룸 선택</option>';

            for (let list of rooms) {
                option += '<option value="' + list.id + '">' + list.name + '</option>';
            }

            // select box에 option 넣기
            form.room.innerHTML = option;
        }


    }

    //--- 스터디룸 selectBox 객체
    let roomSelectBox = {
        target: undefined,
        campus_id: undefined,
        init: function () {
            this.target = form.room;
            this.campus_id = document.querySelector('input[name=campus_id]:checked').value;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {

            let _this = this;

            _this.target.addEventListener('change', function (e) {

                //--- 예약날짜가 안잡혀 있을경우
                if(dateBtn.target.value === '') {
                    alert('예약날짜 먼저 선택 바랍니다.', 'warning');
                    return;
                }

                let week = reservationDate.isWeek();
                if (week) {
                    reservationDate.setHtml(week);
                    return;
                }

                // 스터디룸 selectbox가 빈값으면 return
                if (e.target.value === '')
                    return;

                _this.getData(e.target.value); // 스터디룸 데이터 저장하기
                _this.getTime(e.target.value); // 스터디룸 예약 시간 가져오기
            })

        },
        getTime: function (value) {

            let _this = this;
            let problem = false;

            __common.getAjax('GET', '/ajax/studyroom/time', {
                mode: 'time_reservation',
                id: value,
                campus: form.campus_id.value,
                date: form.date.value
            }, function (result) {
                if (result.status != 200) {
                    problem = true;
                    return;
                }

                _this.timeHtml(result.lists);
            });

            return problem;
        },

        timeHtml: function (times) {

            let box = document.querySelector('.checkbox_txt_wrap');
            let len = times.length;
            let checkBox = '';


            for (let i = 0; i < len; i++) {
                let id = 'reservation_time_' + i;
                let time = times[i].split('/')[0];
                let reservation = times[i].split('/')[1];

                let disabled = '';
                let border = '';
                let color = '';

                if (reservation == 'reservation') {
                    disabled = 'disabled';
                    border = 'border:1px solid #dcdcdc';
                    color = 'color:#bebebe';

                }

                checkBox += ' <input type="checkbox" id="' + id + '" class="_vali input_checkbox" data-title="예약시간" name="time[]" value="' + times[i] + '" style="' + border + '"' + disabled + '>' +
                    '<label for="' + id + '" class="checkbox_txt"><span style="' + color + '">' + time + '</span></label>';
            }

            box.innerHTML = checkBox;
        },

        //--- 선택한 스터디룸 정보 가져오기
        getData: function (id) {
            let problem = false;
            let _this = this;
            __common.getAjax('GET', '/ajax/studyroom/get', {id: id}, function (result) {
                if (result.status != 200) {
                    problem = true;
                    return;
                }

                _this.setData(result.data); // 데이터 저장하기
            });
        },

        //--- 스터디룸 정보 hidden 값으로 저장시키기
        setData: function (room) {
            form.room_id.value = room.id;
            form.campus_name.value = room.campus_name;
            form.location.value = room.location;
            form.study_room_name.value = room.name;
            form.office_equipment.value = room.info_desc;
            form.max_personnel.value = room.max_personnel;
            form.min_personnel.value = room.min_personnel;
        }
    }


    //--- 학번 객체
    let studentInput = {
        target: undefined,
        showTarget: undefined, // 학번체크 메시지 ele
        confirmTarget: undefined, // 등록할때 체크할 ele
        init: function () {
            this.target = form.account;
            this.showTarget = document.getElementById('student_confirm');
            this.confirmTarget = form.student_check;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {

            let _this = this;

            //--- 실시간 아이디 검색
            _this.target.addEventListener("keyup", function (e) {

                _this.getStudent(e.target.value);

            });
        },
        getStudent: function (value, mode) {

            let _this = this;
            let targetType = form.target_type.value;

            if (mode == 'load') {
                if (targetType == 1) {
                    __common.getAjax('POST', '/ajax/student/search', {account: value}, function (result) {
                        _this.show(result);
                    });
                } else if (targetType == 2) {
                    __common.getAjax('POST', '/ajax/user/search', {account: value}, function (result) {
                        _this.show(result);
                    });
                }
            } else {
                __common.getAjax('POST', '/ajax/student/search', {account: value}, function (result) {
                    _this.show(result);
                });
            }

        },
        show: function (result) {

            let html = '';
            if (result.status == 404) {
                this.confirmTarget = 0;
                html = '<span style="color:red">없는학번</span>';
            } else if (result.status == 200 || result.status == 204) {
                this.confirmTarget = 1;
                html = '<span style="color:blue">확인완료</span>';
            }

            form.student_check = this.confirmTarget;
            this.showTarget.innerHTML = html;

        }
    }


    //--- 동반사용자 학번 추가 객체
    let addBtn = {
        target: undefined, // 동반사용자 추가 버튼
        tbody: undefined,
        maxCnt: 0, // 최대 수용인원
        init: function () {
            this.target = document.querySelector('.serch_button');
            this.tbody = document.querySelector('.companion_table tbody');
            this.maxCnt = document.forms.max_personnel.value;
        },
        main: function () {
            this.init();
            this.event();
            this.remove();
        },
        event: function () {

            let _this = this;

            _this.target.addEventListener('click', function () {

                let companion = document.querySelector('.serch_textbox'); // 동반 사용자 학번

                // 유효성 검사
                if (_this.addValidation(companion))
                    return;


                // 동반 사용자 추가
                __common.getAjax('POST', '/ajax/student/search', {account: companion.value}, function (result) {

                    // 없는 학생 일때 return
                    if (result.status == 404) {
                        alert(__msg.msgCollection('failure_account'), 'warning');
                        return;
                    }

                    // 등록하려는 사람이 자신일때 return
                    if (result.status == 204) {
                        alert(__msg.msgCollection('failure_self'),'warning');
                        return;
                    }


                    // 동반사용자 추가
                    _this.add(result.data);
                    companion.value = ''; // 동반사용자가 추가 되었기 떄문에 적혀있던 학번 지우기
                });
            });
        },


        //--- 동반 사용자 추가에 대한 유효성검사
        addValidation: function (companion) {

            // 학번을 입력하지 않았을 때
            if (!companion.value) {
                alert(__msg.msgCollection('empty_account'), 'warning');
                companion.focus();

                return true;
            }


            //--- 스터디룸을 선택을 했는지 체크
            let studyRoom = form.room.value;
            if (!studyRoom) {
                alert('예약하실 스터디룸을 선택해주세요.', 'warning');
                return true;
            }


            //--- 내자신을 등록하려고 할때 return
            let studentId = form.account;
            if (studentId.value == companion.value) {
                alert('예약자로 이미 등록하셨습니다.', 'warning');
                return true;
            }


            // 이미 등록되어 있는 동반 사용자가 있는지
            let companions = document.querySelectorAll('.companion_id');
            for (let ele of companions) {

                // 입력한 학번과 이미 등록한 학번이 다르다면 continue
                if (ele.value != companion.value)
                    continue;

                // 이미 등록하였을 때
                alert(__msg.msgCollection('already_account'), 'warning');
                return true;
            }


            // 최대수용인원체크 (+ 1하는 이유는 등록자가 + 1이 되기 때문에)
            if ((companions.length + 1) >= this.maxCnt.value) {
                alert(__msg.msgCollection('max_add'), 'warning');
                this.btnDisabled(true); // 추가 버튼 비활성화
                return true;
            }


            // 일주일에 2번 이상, no-show 2회 인지
            let problem = false;
            __common.getAjax('GET', '/ajax/studyroom/possible', {account: companion.value}, function (result) {
                if (!result.result) {
                    problem = false;
                    return
                }

                alert(result.msg, 'warning');
                problem = true;
                return;


            }, false);

            return problem;

        },

        // 동반사용자 추가
        add: function (data) {

            let trs = document.querySelectorAll('.companion_table tbody tr');


            let tr = document.createElement('tr');
            let div = document.createElement('div');
            let th = document.createElement('th');
            let td = document.createElement('td');
            let input = document.createElement('input');
            let button = document.createElement('button');

            th.textContent = '학번 ' + trs.length;

            input.setAttribute('type', 'text');
            input.setAttribute('name', 'companion_id[]');
            input.classList.add('serch_textbox');
            input.classList.add('companion_id');
            input.value = data.account;
            input.readOnly = true;


            button.setAttribute('type', 'button');
            button.classList.add('btn01');
            button.classList.add('btn-remove');
            button.textContent = '삭제';

            div.append(input);
            div.append(button);

            tr.append(th);
            td.append(div);
            tr.append(td);

            this.tbody.appendChild(tr);
        },

        // 동반 사용자 제거
        remove: function () {

            let _this = this;

            document.querySelector('.companion_table').addEventListener('click', function (e) {

                //--- 클릭한 대상체가 삭제 버튼이 아니라면 return
                if (!e.target.classList.contains('btn-remove'))
                    return;

                // 삭제하려는 학번의 tr 태그 remove
                _this.tbody.removeChild(e.target.parentNode.parentNode.parentNode); //tr
                _this.btnDisabled(false); // 추가 버튼 활성화


                // 도중에 빠진 tr 태그로 인해 1,2,3 . . . 번호가 맞지 않기 때문에 th 번호 재배열 처리
                let th = document.querySelectorAll('.companion_table th');
                for (let i = 1; i < th.length; i++) {
                    th[i].textContent = '학번 ' + i;
                }

            });
        },
        btnDisabled: function (flag) {
            if (typeof flag == 'boolean')
                this.target.disabled = flag;
        }
    }


    //--- 삭제 버튼 객체
    let removeBtn = {
        target: undefined,
        init: function () {
            this.target = document.getElementById('btn_delete');
        },
        main: function () {
            this.init();
            if (this.target)
                this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('click', function () {

                confirm('삭제시 복구가 불가능 합니다. <br> 예약 정보를 삭제하시겠습니까?', function () {
                    form._method.value = 'delete';
                    form.submit();
                });

            });
        }
    }


    //--- 상태 selectBox 객체
    let statusBox = {
        target: undefined,
        id: undefined,
        status: undefined,
        init: function () {
            this.target = form.status;
            this.id = this.target.value;
            this.status = this.getSelectedText();
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('change', function (e) {
                _this.id = e.target.value;
                _this.status = _this.getSelectedText();
            });
        },

        //--- select 된 상태 text 가져오기
        getSelectedText: function () {

            let text;

            for (let option of this.target) {
                if (option.selected) {
                    text = option.textContent;
                    break;
                }
            }

            return text;

        }

    }


    //--- submit 버튼 객체
    let submitBtn = {
        target: undefined, // submit button
        minCnt: 0,
        maxCnt: 0,
        infos: {
            name: undefined,
            studentId: undefined,
            usePeople: undefined,
            usePurpose: undefined,
            date: undefined,
            times: undefined
        },
        init: function () {
            this.target = document.querySelector('.btn_submit');
            this.minCnt = form.min_personnel;
            this.maxCnt = form.max_personnel;
        },
        main: function () {
            this.init(); // 각종 프로퍼티 세팅
            this.event(); // 이벤트 등록
        },
        event: function () {

            let _this = this;

            _this.target.addEventListener('click', function () {

                //--- 유효성 검사
                if (_this.validation())
                    return;

                //--- 예약 상황 체크

                _this.infoCheck();


            });
        },

        validation: function () {

            let msg = '';
            this.infos.name = form.name;
            this.infos.studentId = form.account;
            this.infos.usePeople = form.use_people;
            this.infos.usePurpose = form.use_purpose;
            this.infos.maxPersonnel = form.max_personnel;
            this.infos.minPersonnel = form.min_personnel;
            this.infos.date = form.date;
            this.infos.room = document.querySelector('select[name=room]');
            this.infos.idConfirm = studentInput.confirmTarget;
            this.infos.times = (() => { // 예약시간을 배열로 담는다.
                let times = [];
                document.querySelectorAll('.time_td input').forEach((time) => {
                    if (time.checked) {
                        times.push(time.value);
                    }
                });
                return times;
            })();

            if (this.infos.date.value == '') {
                msg = '예약날짜를 선택해주세요.';
            } else if (this.infos.room.value == '') {
                msg = '예약하실 스터디룸을 선택해주세요.';
            } else if (!this.infos.times.length) {
                msg = '예약시간을 선택해주세요.';
            } else if (this.infos.name.value == '') {
                msg = '이름을 등록해주세요.';
                this.infos.name.focus();
            } else if (this.infos.studentId.value == '') {
                msg = '학번을 등록해주세요.';
                this.infos.studentId.focus();
            } else if (!this.infos.idConfirm) {
                msg = '학번 확인해주세요.';
                this.infos.studentId.focus();
            } else if (this.infos.usePeople.value == '') {
                msg = '사용인원을 등록해주세요.';
                this.infos.usePeople.focus();
            } else if (this.infos.usePurpose.value == '') {
                msg = '사용목적을 등록해주세요.';
                this.infos.usePurpose.focus();
            } else if (this.minCheck()) {  // 최소인원 체크
                // 관리자는 제외
                // msg = '예약하시기에 최소 인원에 맞지 않습니다. <br> 최소인원 : ' + this.minCnt.value;
            } else if (this.maxCheck()) {
                // 관리자는 제외
                //msg = '예약최대 인원을 넘어 섰습니다. <br> 최소인원 : ' + this.maxCnt.value;
            }


            if (msg) {
                alert(msg, 'warning');
                return true;
            }

        },

        minCheck: function () {

            // cnt = 동반 사용자 + 예약자
            let cnt = document.querySelectorAll('.companion_id').length + 1;
            let problem = true;

            // 총 예약인원이 최소인원보다 많은지 체크
            if (cnt >= this.minCnt.value) {
                problem = false;
            }

            return problem;
        },
        maxCheck: function () {
            // cnt = 동반 사용자 + 예약자
            let cnt = document.querySelectorAll('.companion_id').length + 1;
            let problem = false;

            // 총 예약인원이 최대인원보다 많은지 체크
            if (cnt > this.maxCnt.value) {
                problem = true;
            }

            return problem;

        },
        infoCheck: function () {

            let next = false;

            //--- 룸아이디 가져오기
            let roomId = form.room_id.value;

            //--- 동반사용자 가져오기
            let companion = document.querySelectorAll('.companion_id');
            let reservationCnt = companion.length + 1; // 예약총인원(+1은 예약자를 의미)
            let companionUsers = [];
            for (let ele of companion) {
                companionUsers.push(ele.value);
            }


            let msg =
                '캠퍼스 : ' + form.campus_name.value + '<br>' +
                '스터디룸 : ' + form.study_room_name.value + '<br>' +
                '예약자 : ' + this.infos.name.value + '<br>' +
                '학번 : ' + this.infos.studentId.value + '<br>' +
                '상태 : ' + statusBox.status + '<br>' +
                '사용인원 : ' + this.infos.usePeople.value + '<br>' +
                '동반사용자 학번: ' + companionUsers.join(', ') + '<br><br>' +
                '위의 예약정보가 맞다면 확인 버튼을 눌러주세요.';


            confirm(msg, function () {

                //--- 예약정보 체크
                __common.getAjax('GET', '/ajax/studyroom/check', {
                    cnt: reservationCnt,
                    room_id: roomId
                }, function (result) {

                    //... TODO : 예약 체크 해야함


                    if (result.status == 200) {
                        form.submit();
                    }


                }, false);
            });

        },
    }


    let dateBtn = {
        target: undefined,
        value: undefined,
        init: function () {
            this.target = form.date;
            this.value = this.target.value;
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('input', function (e) {


                console.log(
                    _this.target.value,
                    reservationDate.today,
                    _this.target.value < reservationDate.today);
                if (_this.target.value < reservationDate.today) {
                    alert('이전날짜는 선택이 불가능 합니다.', 'warning');
                    _this.target.value = _this.value;
                }

                _this.value = _this.target.value;
                reservationDate.setHtml(reservationDate.isWeek(_this.target.value));


            })
        }
    }


    let reservationDate = {
        now: undefined,
        year: undefined,
        month: undefined,
        day: undefined,
        today: undefined,
        init: function () {
            this.now = new Date();
            this.year = this.now.getFullYear();
            this.month = this.now.getMonth() + 1;
            this.month  =  this.month < 10 && this.month >= 0 ? "0" + this.month : this.month;
            this.day = this.now.getDate();
            this.day = this.day < 10 && this.day >= 0 ? "0" + this.day : this.day;
            this.today = `${this.year}-${this.month}-${this.day}`;
        },
        isWeek: function (date) {
            date = date ? date : form.date.value;
            let week = new Date(date).getDay();

            return week == 6 || week == 0;
        },

        makeWeekHtml: function (week) {

            if (week) {
                return '<div style="color: red">주말은 이용이 불가능 합니다.</div>';
            } else {
                return '<div>스터디룸 선택 바랍니다.</div>';
            }
        },
        setHtml: function (week) {
            document.querySelector('.checkbox_txt_wrap').innerHTML = this.makeWeekHtml(week);
        }
    }


    campusBtn.main();
    statusBox.main();
    roomSelectBox.main();
    studentInput.main();
    addBtn.main();
    dateBtn.main();
    submitBtn.main();
    removeBtn.main();
    reservationDate.init();

    //--- 수정 페이지 일때 실행 기능
    if (form._method) {
        studentInput.getStudent(studentInput.target.value, 'load');
    }


})();
