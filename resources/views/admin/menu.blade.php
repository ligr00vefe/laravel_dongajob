<nav id="nav">
    <ul class="nav-list">
        <li class="">
            <span>회원관리</span>
            <ul>
                <li><a href="/{{ ADMIN_URL }}/member/manager">- 관리자 관리</a></li>
            </ul>
        </li>
        <li class="">
            <span>채용정보</span>
            <ul>
                <li>
                    <span>- 추천채용</span>
                    <ul>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/recommend/create">신규등록</a></li>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/recommend">채용관리</a></li>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/support">지원자 관리</a></li>
                    </ul>
                </li>

                <li>
                    <span>- 일반채용</span>
                    <ul>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/normal/create">신규등록</a></li>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/normal">채용관리</a></li>
                    </ul>
                </li>

                <li>
                    <span>- 동아친화기업 300</span>
                    <ul>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/donga300/create">신규등록</a></li>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/donga300">동아친화기업관리</a></li>
                    </ul>
                </li>

                <li>
                    <span>- 각종 활동</span>
                    <ul>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/activity/create">신규등록</a></li>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/activity">활동관리</a></li>
                    </ul>
                </li>

                <li>
                    <span>- 취업컨설턴트 PICK</span>
                    <ul>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/pick/create">신규등록</a></li>
                        <li><a href="/{{ ADMIN_URL }}/jobinfo/pick">채용관리</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="">
            <span>공지사항</span>
            <ul>
                <li><a href="/{{ ADMIN_URL }}/notice">- 공지사항 관리</a></li>
                <li><a href="/{{ ADMIN_URL }}/notice/create">- 공지사항 등록</a></li>
            </ul>
        </li>
        <li class="">
            <span>취업지원실 프로그램 관리</span>
            <ul>
                <li><a href="/{{ ADMIN_URL }}/support/program/create">- 프로그램 등록</a></li>
                <li><a href="/{{ ADMIN_URL }}/support/program">- 프로그램 및 신청자 관리</a></li>
                <li>
                    <a href="/{{ ADMIN_URL }}/support/interview">- 서류합격자면접교육 접수</a>
                    <ul>
                        <li><a href="/{{ ADMIN_URL }}/support/interview">신청자 관리</a></li>
                        <li><a href="/{{ ADMIN_URL }}/support/interview/create">신규 등록</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="">
            <span>취업자료실</span>
            <ul>
                <li><a href="/{{ ADMIN_URL }}/archive/reviewlatest">- 최신 취업수기(최근 5년)</a></li>
                <li><a href="/{{ ADMIN_URL }}/archive/reviewbefore">- 이전 취업수기</a></li>
                <li><a href="/{{ ADMIN_URL }}/archive/reviewparticipate">- 프로그램 참여후기</a></li>
            </ul>
        </li>
        <li class="">
            <span>스터디룸 예약</span>
            <ul>
                <li><a href="/{{ ADMIN_URL }}/study/reservation">- 스터디룸 예약리스트</a></li>
                <li><a href="/{{ ADMIN_URL }}/study/reservation/create">- 스터디룸 예약등록(관리자)</a></li>
                <li><a href="/{{ ADMIN_URL }}/study/room/create">- 스터디룸 등록</a></li>
                <li><a href="/{{ ADMIN_URL }}/study/room">- 스터디룸 관리</a></li>
                <li><a href="/{{ ADMIN_URL }}/study/prevention">- 스터디룸 예약금지날짜 관리</a></li>
            </ul>
        </li>
        <li class="">
            <span>통계</span>
            <ul>
                <li><a href="/{{ ADMIN_URL }}/statistics/history">- 통계</a></li>
            </ul>
        </li>
        <li class="">
            <span>로그</span>
            <ul>
                <li><a href="/{{ ADMIN_URL }}/log/auth?category=all&from=&to=">- 로그</a></li>
            </ul>
        </li>
        @if(session()->get('level') > 1)
        <li class="">
            <span>팝업</span>
            <ul>
                <li><a href="/{{ ADMIN_URL }}/popup/info">- 팝업</a></li>
            </ul>
        </li>
        @endif
    </ul>
</nav>

<div class="data-box">
    <input type="hidden" id="callback-msg" value="{{ session('status') }}">
    <input type="hidden" id="callback-success-msg" value="{{ session('success') }}">
    <input type="hidden" id="callback-error-msg" value="{{ session('error') }}">
</div>

<script>

    // load시 실행되면 사용자 화면에서 뒤늦게 active 효과를 받아 느리다는 느낌을 받는다. 따라서 메뉴 html 로드후 바로 여기서 바로 실행 시킨다.
    menuActive();

    /**
     * 최초 로드시 선택했던 메뉴 활성화 함수
     */
    function menuActive() {

        let lastPath = [
            'edit'
        ];

        let checkPath = [];


        // 접속한 경로의 path
        let currentPath = document.location.pathname.split('/');
        // console.log('currentPath: ', currentPath);
        let path = document.location.href;
        // console.log('path: ', path);
        // console.log('path.slice(0, -1): ', path.slice(0, -1));
        // console.log('currentPath.length:', currentPath.length);
        // console.log('currentPath.length - 1: ', currentPath.length - 1);
        // console.log('currentPath[currentPath.length - 1]: ', currentPath[currentPath.length - 1]);
        // console.log('lastPath: ', lastPath);
        // console.log('location.origin : ', location.origin );
        // console.log('document.location.origin + path.slice(0, -1) : ', document.location.origin + path.slice(0, -1));


        if (lastPath.includes(currentPath[currentPath.length - 1])) {
            path = '/';
            for (let i = 0; i < currentPath.length - 2; i++) {

                if (currentPath[i] === '')
                    continue;

                path += currentPath[i] + '/';
            }
            path = document.location.origin + path.slice(0, -1);
        }

        let menuList = document.querySelectorAll('.nav-list li ul a');
        menuList.forEach(function (list) {
            // console.log('list: ', list);
            // console.log('list.href: ', list.href);
            //--- main 접근시 회원관리 페이지와 연결되기 떄문에 강제적으로 admin 링크를 넣어줌으로써 밑의 조건을 맞추게 한다.
            if (currentPath[currentPath.length - 1] === 'supervisor' && list.href === document.location.origin + '/supervisor/member/manager') {
                list.href = '/supervisor';
            } else if (currentPath[currentPath.length - 2] === 'supervisor' && list.href === document.location.origin + '/supervisor/member/manager') {
                list.href = '/supervisor/';
            }


            //--- 회원관리 : 관리자 등록은 링크에 없기떄문에 강제적으로 관리자 관리에서 active 효과를 준다.
            if (currentPath[currentPath.length - 2] === 'manager' && currentPath[currentPath.length - 1] === 'create' && list.href === document.location.origin + '/supervisor/member/manager') {
                list.parentNode.classList.add('active');
                list.parentNode.parentNode.parentNode.classList.add('active');
                return false;
            }

            // console.log('list: ', list);
            // console.log('list.href: ', list.href);
            // console.log('path: ', path);
            if (list.href === path) {
                list.parentNode.classList.add('active');
                list.parentNode.parentNode.parentNode.classList.add('active');
                list.parentNode.parentNode.parentNode.parentNode.parentNode.classList.add('active');
                return false;
            }
        });
    }
</script>
