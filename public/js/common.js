var __common = __common || {}
var __vaildate = __vaildate || {}
var __msg = __msg || {}
var __student = __student || {}

//--- 브라우저내 캐싱 체크
window.onpageshow = function (event) {
    // 뒤로가기시
    if (event.persisted || (window.performance && window.performance.navigation.type == 2)) {

    } else {
        __common.callbackMsg(); // 콜백 메시지는 뒤로가기시 출력이 되면 안되기때문에 여기서 실행한다.
    }
}

// maxlength 체크
function maxLengthCheck(object) {
    // console.log( object );
    if (object.value.length > object.maxLength) {
        object.value = object.value.slice(0, object.maxLength);
        alert(object.maxLength + '자 이상 입력할 수 없습니다.');
    }
}


function dd(msg) {
    console.log(msg);
}


;(function () {

    //*================================================== common ===================================================*/

    /**
     * 모든 체크박스 체크 on 기능 함수
     * @param f
     */
    function checkAll(f) {
        var checkBox = document.getElementsByName("chk[]");

        for (i = 0; i < checkBox.length; i++)
            checkBox[i].checked = f.check_all.checked;
    }

    /**
     * get query 가져오기 함수
     * @param key
     * @returns {string}
     */
    function getQueryString(key) {

        let str = location.href;
        var index = str.indexOf("?") + 1;
        var lastIndex = str.indexOf("#") > -1 ? str.indexOf("#") + 1 : str.length;

        // index 값이 0이라는 것은 QueryString이 없다는 것을 의미하기에 종료
        if (index == 0) {
            return "";
        }

        // str의 값은 a=1&b=first&c=true
        str = str.substring(index, lastIndex);
        str = str.split("&");

        // 결과값
        var rst = "";

        for (var i = 0; i < str.length; i++) {

            var arr = str[i].split("=");

            // arr의 length가 2가 아니면 종료
            if (arr.length != 2) {
                break;
            }

            // 매개변수 key과 일치하면 결과값에 셋팅
            if (arr[0] == key) {
                rst = arr[1];
                break;
            }
        }
        return rst;
    }


    function callbackMsg() {

        if (!document.getElementById('callback-msg'))
            return;

        //--- 콜백 메시지 실행
        let msg = document.getElementById('callback-msg').value;
        let successMsg = document.getElementById('callback-success-msg').value; // 관리자만 사용
        let errorMsg = document.getElementById('callback-error-msg').value; // 관리자만 사용

        if (msg) {
            alert(msg);
        } else if (successMsg) {
            alert(successMsg, 'success');
        } else if (errorMsg) {
            alert(errorMsg, 'error');
        }

    }


    //--- 부모 태그중 특정 노드 찾기
    function searchParentNode(target, search) {

        var parentNode = target;
        search = search.toUpperCase();


        for (; parentNode.nodeName != search; parentNode = parentNode.parentElement) {
            console.log(parentNode.nodeName);
        }


        if (parentNode.nodeName == search) {
            return parentNode;
        }

        return false;
    }


    //--- 10 이하 숫자 앞에 0을 붙여주는 함수
    function addZero(number) {
        return parseInt(number, 10) < 10 ? "0" + number : number;
    }


    //--- 로딩바 시작 함수
    function loadingStart(ele) {
        let backGroundCover = '<div class="loading_box loading-bar"><div class="circle loading-bar"></div></div>';
        $(ele).append(backGroundCover);
    }

    //--- 로딩바 시작 함수
    function loadingTdStart(ele, col) {
        let backGroundCover = '<tr><td class="loading_box loading-bar" colspan="' + col + '"><div class="circle loading-bar"></div></td></tr>';
        $(ele).append(backGroundCover);
    }


    //--- 로딩바 end 함수
    function loadingEnd(index) {
        let loadingBar = document.querySelectorAll('.loading-bar');

        if (index == 0 || index) {
            loadingBar[index].style.display = 'none';
        } else {
            for (let i = 0; i < loadingBar.length; i++) {
                loadingBar[i].style.display = 'none';
            }
        }
    }

    //--- ajax 함수
    function getAjax(type, url, data, callback, async, errorCallback) {

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: type,
            url: url,
            async: async ?? true,
            dataType: 'json',
            data: data,
            success: function (result) {
                callback(result);
            },
            error: function (result) {
                if (errorCallback) {
                    errorCallback(result);
                }
            }
        });

    }


    function scrap(id, title, subject) {

        if (!id || !title || !subject) {
            alert(__msg.msgCollection('error_enrollment'));
            return;
        }


        let type = '';
        __common.getAjax('GET', '/getType', {}, function (result) {
            type = result.type;
        }, false);

        //--- 관계자면 스크랩 사용 불가
        if (__common.isStaffCheck(type)) {
            alert(__msg.msgCollection('failure_staff'));
            return;
        }

        __common.getAjax('POST', '/scrap', {
            board_id: id,
            board_title: title,
            subject: subject,
            'url': location.pathname
        }, function (result) {

            if (result.status != 200) {
                alert((result.msg ? result.msg : __msg.msgCollection('error_enrollment')));
                return;
            }


            if (result.kinds == 'confirm') {


                if (confirm(result.msg)) {
                    __common.getAjax('POST', '/scrap', {
                        board_id: id,
                        board_title: title,
                        subject: subject,
                        'url': location.pathname,
                        mode: 'delete'
                    }, function (result) {
                        console.log(result);
                        result.msg ? alert(result.msg) : '';
                        return;
                    });
                }
            } else {
                result.msg ? alert(result.msg) : '';
            }


        })


    }

    //*================================================== vaildate ===================================================*/


    /**
     * 유효성 검사 함수
     */
    function validate() {
        let targets;
        let inputs;
        let radios;
        let checkBoxs;
        let options;
        let color;
        let opacity;
        let timeOut;
        let bool;

        // 데이터 세팅
        function init() {
            targets = document.querySelectorAll('._vali');
            inputs = [];
            radios = [];
            checkBoxs = [];
            options = [];

            color = '#1E90FF';
            opacity = '0.1';
            timeOut = 1500;

            bool = true;
        }


        //--- 유효성 검사할 목록 세팅
        function setting() {

            // 검사할 노드들 name을 속성을 배열로 저장 합니다.
            targets.forEach(function (target) {

                switch (target.type) {
                    case 'text':
                    case 'password':
                    case 'date':
                    case 'time':
                    case 'textarea':
                        inputs.push(target);
                        break;

                    case 'radio': // 동일한 name은 저장하지 않습니다.
                        if (!radios.includes(target.name)) {
                            radios.push(target.name);
                        }
                        break;

                    case 'checkbox': // 동일한 name은 저장하지 않습니다.
                        if (!checkBoxs.includes(target.name)) {
                            checkBoxs.push(target.name);
                        }
                        break;

                    case 'option':
                        options.push(target);
                        break;
                }

            });
        }

        /**
         * 유효성 검사 체크하는 함수
         * 해당 객체의 calss 명이 _vail, dataset-title이 있어야 한다.
         */
        function check() {

            if (targets.length === 0)
                return


            //--- input[text] 빈값 및 length 검사
            for (input of inputs) {

                // 값이 있을 때 length 검사
                if (input.value !== "") {

                    //--- type이 패스워드일떄
                    if (input.getAttribute('type') == 'password') {
                        let patternNum = /[0-9]/;	// 숫자
                        let patternEng = /[a-zA-Z]/;	// 문자
                        let patternSpc = /[~!@#$%^&*()_+|<>?:{}]/; // 특수문자


                        if (!patternNum.test(input.value) || !patternEng.test(input.value) || !patternSpc.test(input.value) || input.value.length < input.minLength) {
                            alert('비밀번호 영문·숫자·특수문자 3가지 조합 9자리 이상만 가능합니다.', 'warning');
                            colorChange(input);
                            bool = false;

                            break;
                        }

                    } else {

                        // min length 보다 작을 때
                        if (input.value.length < input.minLength) {
                            alert(input.dataset.title + "가 글자수 " + input.minLength + " 보다 커야 합니다.", 'warning');
                            colorChange(input);
                            bool = false;

                            break;
                        }

                    }

                    continue
                }


                alert(input.dataset.title + " 입력 해주세요.", 'warning');
                colorChange(input);
                bool = false;

                break;
            }

            if (!bool)
                return


            //--- radio 검사
            for (obj of radios) {
                let radio = document.getElementsByName(obj);
                let chk = true;

                for (let i = 0; i < radio.length; i++) {
                    if (radio[i].checked) {
                        chk = false;
                        break;
                    }
                }


                if (chk) {
                    for (let i = 0; i < radio.length; i++) {
                        if (i === 0)
                            alert(radio[i].dataset.title + " 입력 해주세요.", 'warning');

                        colorChange(radio[i]);
                    }
                    bool = false;
                    break;
                }
            }

            if (!bool)
                return


            //--- checkbox 검사
            for (obj of checkBoxs) {
                let checkBox = document.getElementsByName(obj);

                for (let i = 0; i < checkBox.length; i++) {
                    if (checkBox[i].checked) {
                        bool = true;
                        break;
                    }
                }

                // check된 데이터가 없기때문에 여기서 return 한다.
                if (!bool) {
                    alert(checkBox[0].dataset.title + " 입력 해주세요.", 'warning');
                    checkBox[0].focus();
                    break;
                }
            }

            //--- select 검사
        }


        /**
         * 유효성 대상체 background 변경
         * @param obj
         */
        function colorChange(obj) {

            obj.style.backgroundColor = color;
            obj.style.opacity = opacity;
            obj.focus();

            setTimeout(function () {
                obj.style.backgroundColor = '#ffffff';
                obj.style.opacity = '1';
            }, timeOut);
        }

        init();
        setting();
        check();


        return bool;
    }


    /**
     * 아이디에 숫자 영어만 있는지 체크
     * @param account
     * @returns {*}
     */
    function accountRegCheck(account) {
        let registerReg = /^[A-Za-z0-9]{4,12}$/;
        return registerReg.test(account);
    }


    function addslashes(string) {
        return string.replace(/\\/g, '\\\\').replace(/\u0008/g, '\\b').replace(/\t/g, '\\t').replace(/\n/g, '\\n').replace(/\f/g, '\\f').replace(/\r/g, '\\r').replace(/'/g, '\\\'').replace(/"/g, '\\"');
    }


    //*================================================== msg ===================================================*/


    function msgCollection(key = null) {

        let list = {
            'account_check': '학번확인이 필요합니다.',
            'student_name_check': '이름이 입력 되어야합니다.',
            'empty_account': '학번을 입력 해주세요.',
            'failure_account': '존재하지 않은 학번 입니다.',
            'already_account': '이미 등록되어 있는 학번 입니다.',
            'max_add': '더이상 추가 불가능 합니다.',
            'failure_self': '자신은 추가 불가능 합니다.',
            'already_reservation': '이미 예약한 상태입니다.',
            'over_reservation': '정원 초과입니다.',
            'reapply_reservation': '재신청 바랍니다.',
            'confirm_login': '로그인이 필요한 서비스입니다. \n로그인 페이지로 이동하시겠습니까?',
            'error_enrollment': '문제가 발생했습니다. 다시 시도해 주세요',
            'auto_logout': '장시간동안 움직임이 감지되지 않아 로그아웃 처리 됩니다.',
            'failure_staff': '관계자는 이용 불가능합니다.'
        };


        if (key) {
            return list[key];
        }

        return list;
    }


    //*================================================== 로그인관련 ===================================================*/
    let LogOut = {
        assoc: {
            timer: '',
            limitTime: 1000 * 600,
            func: function () {

                __common.getAjax('GET', '/autoLogout', {}, function (result) {
                    if (result.status == 200) {

                        if (location.href.indexOf('superviser') > 0) { // 관리자 페이지일시
                            alert(__msg.msgCollection('auto_logout'), 'warning', function () {
                                location.href = '/logout';
                            });

                        } else {
                            alert(__msg.msgCollection('auto_logout'));
                            location.href = '/logout';
                        }

                    }

                }, false);
            },
            start: function () {
                this.timer = window.setTimeout(this.func, this.limitTime);
            },
            reset: function () {

                window.clearTimeout(this.timer);
                this.start();
            },
        },
        init: function () {
            this.assoc.start();
            this.event();
        },
        event: function () {
            let _this = this;
            document.onmouseleave = function () {
                _this.assoc.reset();
            }

            document.onkeypress = function () {
                _this.assoc.reset();
            }
        }

    }


    //*================================================== 동아관련 ===================================================*/
    __common.authServer = 'https://sso.donga.ac.kr/svc/tk/Login.eps';
    // 학생인지 체크
    __common.isStudentCheck = function (type) {
        return type == 1 || type == 'student';
    };
    // 관리자인지 체크
    __common.isAdminCheck = function (type) {
        return type == 2 || type == 'admin';
    }
    // 관계자인지 체크
    __common.isStaffCheck = function (type) {
        return type == 3 || type == 'staff';
    }


    //*================================================== 팝업 관련 ===================================================*/
    let layoutPopUp = {
        init: function () {
            this.closeBtn = document.querySelector('.pop-close-btn');
            this.checkBox = document.querySelector('#pop-reject-time');
            this.container = document.querySelector('#top-pop-up');
            this.header = document.querySelector('#header');
        },
        main: function () {
            if (!this.isCheck())
                return;

            this.init();
            this.event();
        },
        isCheck: function () {
            return !!document.querySelector('.pop-close-btn');
        },
        event: function () {
            let self = this;
            this.closeBtn.addEventListener('click', function (e) {

                // 오늘하루 열지 않음 체크시
                if (self.checkBox.checked) {
                    self.setCookie();
                }

                self.closePopup();
            });
        },
        setCookie: function () {
            __common.getAjax('post', '/ajax/cookie', {key: 'pop-reject-time', time: 86400});
            this.closePopup();
        },
        closePopup: function () {
            this.container.style.display = 'none';
            this.header.style.top = '0px';
        }
    }


    //*================================================== 서브 메뉴 ===================================================*/
    let layoutSubMenu = {
        init() {
            this.topPx = '145px';
            this.subMenus = document.querySelectorAll('.sub-menu');
        },
        main() {
            this.init();
            this.start();
        },
        start() {
            let self = this;
            this.subMenus.forEach(function (menu) {

                //--- 익스플로러 팝업이 있는지 체크 (없으면 서브메뉴 top 위치를 맞추기 위해 이동시킨다 )
                if(!layoutPopUp.isCheck()) {
                    self.topLocation(menu);
                }

            });
        },
        topLocation(menu) {
            menu.style.top = this.topPx;

            //--- 서브 메뉴도 이동
            document.querySelector('#main').style.margin = '175px 0 0';
        }
    }

    //*================================================== total  ===================================================*/

    // common 네임스페이스에 추가
    __common.checkAll = checkAll;
    __common.getQueryString = getQueryString;
    __common.callbackMsg = callbackMsg;
    __common.searchParentNode = searchParentNode;
    __common.addZero = addZero;
    __common.loadingStart = loadingStart;
    __common.loadingTdStart = loadingTdStart;
    __common.loadingEnd = loadingEnd;
    __common.getAjax = getAjax;
    __common.scrap = scrap;
    __common.addslashes = addslashes;
    __common.logout = LogOut;
    __common.layoutPopUp = layoutPopUp;
    __common.layoutSubMenu = layoutSubMenu;

    // vaildate 네임스페이스 추가
    __vaildate.validate = validate;
    __vaildate.accountRegCheck = accountRegCheck;

    // msg
    __msg.msgCollection = msgCollection;


})()

window.addEventListener('load', function () {


    //탑버튼 모션
    $('.top_btn').on('click', function () {
        $('html, body').animate({'scrollTop': 0}, 300);
    });

    // 사용자 페이지일경우 푸터 영역에서 탑버튼 생상변경
    $(window).on('scroll', function () {

        if (!document.querySelector('#footer'))
            return false;

        var footerTop = $('#footer').offset().top;
        var winHeight = $(window).innerHeight();
        var winScroll = $(window).scrollTop();
        var topBtnScroll = winHeight + winScroll;

        // console.log('footerTop: ', footerTop);
        // console.log('topBtnTop: ',topBtnTop);
        // console.log('winHeight: ',winHeight);
        // console.log('winScroll: ',winScroll);
        // console.log('topBtnScroll: ',topBtnScroll);
        // console.log(topBtnScroll, '>', footerTop);


        if (topBtnScroll > footerTop) {
            $('.top_btn').css('border', '3px solid #fff');
            $('.top_btn i').css('color', '#fff');
        } else {
            $('.top_btn').css('border', '3px solid #01387F');
            $('.top_btn i').css('color', '#01387F');
        }
    });

    // 페이지 로드 시 서브메뉴/main top값 변경
    pageTopMotion();

    //--- 로그아웃 기능 start
    __common.logout.init();

    //--- 팝업 이벤트 추가
    __common.layoutPopUp.main();

    //--- 팝업에 따른 서브메뉴 위치 조정 등
    __common.layoutSubMenu.main();

});

window.addEventListener('resize', function (event) {
    // 페이지 가로 사이즈 변경시 서브메뉴/main top값 변경
    pageTopMotion();
}, true);


function pageTopMotion() {
    // 팝업 모션

    if (!document.getElementById('top-pop-up'))
        return;

    var topPopHeight = document.getElementById('top-pop-up').offsetHeight;
    // console.log('팝업높이: ', topPopHeight);

    var header = document.getElementById('header');
    var headerHeight = header.offsetHeight;
    // console.log('헤더높이: ', headerHeight);

    header.style.top = topPopHeight + 'px';

    var pcSubMenu = document.getElementsByClassName('sub-menu');
    var reSubMenu = document.getElementsByClassName('hd-menu_re');
    // console.log('피씨서브메뉴: ', pcSubMenu);
    // console.log('모바일서브메뉴: ', reSubMenu);

    // 피씨 서브메뉴 위치 조절
    for (var i = 0; i < pcSubMenu.length; i++) {
        pcSubMenu[i].style.top = (topPopHeight + headerHeight - 1) + 'px';
    }

    // 모바일 서브메뉴 위치 조절
    reSubMenu[0].style.top = (topPopHeight + headerHeight - 1) + 'px';

    // 윈도우 가로 사이즈
    var winWidth = window.innerWidth;
    var topPopUp = document.getElementById('top-pop-up');
    var mainContents = document.getElementById('main');
    // console.log(winWidth);
    // console.log('main 컨텐츠: ', mainContents);

    // URL 하위경로
    var pathName = window.location.pathname;
    console.log(pathName);

    if (winWidth > 768) {
        topPopUp.display = 'block';
        // #main 콘텐츠 위치 조절
        mainContents.style.margin = (topPopHeight + headerHeight + 27) + 'px 0 0';
    } else {
        topPopUp.display = 'none';

        //메인페이지일때,
        if (pathName == "/") {
            // #main 콘텐츠 위치 조절
            mainContents.style.margin = (topPopHeight + headerHeight + 10) + 'px 0 0';
        } else {
            mainContents.style.margin = (topPopHeight + headerHeight + 27) + 'px 0 0';
        }
    }
}
