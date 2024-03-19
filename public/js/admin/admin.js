var __admin = __admin || {}

window.addEventListener('load', function () {

    eventInit(); // 이벤트 초기화


});


;(function () {

    //--- 로딩박스 객체
    let LoadingBox = {
        target: document.querySelector('.loading_box'),
        start: () => { // 로딩 시작
            let _this = this.__admin.LoadingBox;
            console.log(_this.target.style.display );
            _this.target.style.display = 'block';

        },
        end: () => { // 로딩 종료
            let _this = this.__admin.LoadingBox;
            _this.target.style.display = 'none';
        }
    }



    __admin.LoadingBox = LoadingBox;

})();


function eventInit() {

    //--- 로그아웃 버튼 이벤트
    document.querySelector('.logout-btn').addEventListener('click', function () {
        confirm('로그아웃하시겠습니까?', function () {
            location.href = '/logout';
        });
    })


    //--- 메뉴 클릭 이벤트
    document.querySelector('.nav-list').addEventListener('click', function (e) {

        if (this.classList.contains('.nav-list'))
            return


        //--- 이벤트 대상체
        let menu = e.target;
        let secondMenu = undefined; // 2차메뉴
        let thirdMenu = undefined; // 3차메뉴
        let menuList = document.querySelectorAll('.nav-list > li');
        let menuList3rd = document.querySelectorAll('.nav-list > li > ul > li');
        let check = true; // 이미 선택한 메뉴가 있다면 false

        //--- 클릭한 메뉴의 대상체의 active 효과를 주기위해 LI 태그를 저장시킨다.
        switch (menu.nodeName) {
            case "LI":
                secondMenu = menu.nextElementSibling;
                thirdMenu = menu.parentNode.parentNode.parentNode.nextElementSibling;
                break;

            case "SPAN":
                secondMenu = menu.parentNode;
                thirdMenu = menu.parentNode.parentNode.parentNode;
                break;
        }

        // console.log('thirdMenu: ', thirdMenu);

        // 대메뉴 선택시 3depth parent로 nav#nav가 찍힘
        // 대메뉴 선택시 nav에 .active 클래스를 추가할 필요가 없으므로 제외

        var notSecondMenu = thirdMenu.querySelector('.nav-list');
        // console.log('notSecondMenu: ', notSecondMenu);

        // 대메뉴 이외의 span 태그를 클릭했을때
        if (!notSecondMenu) {
            // 기존에 active 효과를 주었던 li들을 제거 합니다.
            menuList3rd.forEach(function (list) {
                // console.log('list: ', list);

                // active 되어 있던 메뉴를 클릭했을 시(부모거나 조부모 태그에 active가 유지 되어있을시 == 같은 태그를 다시 클릭했을때)
                if (list.classList.contains('active') && secondMenu == list || thirdMenu == list) {
                    check = false;
                }

                // 모든 메뉴의 클래스 active를 제거
                list.classList.remove('active');
            });

            if (check) {
                // 클릭한 리스트에 active 합니다.
                secondMenu.classList.add('active');
                thirdMenu.classList.add('active');
            }
        }else {
           if (secondMenu) {

               // 기존에 active 효과를 주었던 li들을 제거 합니다.
               menuList.forEach(function (list) {
                   // console.log('list: ', list);
                   // console.log('secondMenu: ', secondMenu);

                   // active 되어 있던 메뉴를 클릭했을 시
                   if (list.classList.contains('active') && secondMenu == list) {
                       check = false;
                   }

                   // 모든 메뉴의 클래스 active를 제거
                   list.classList.remove('active');
               });


               if (check) {
                   // 클릭한 리스트에 active 합니다.
                   secondMenu.classList.add('active');
               }
           }
       }

    });
}

/*alert sweet alert로 커스터마이징*/
function alert(msg, mode = '', callback) {

    switch (mode) {

        case 'success':
        case 'warning':
            swal.fire({
                title: "",
                html: msg,
                icon: mode,
                confirmButtonText: "확인",
                closeOnClickOutside : false
            }).then(function(){
                callback ? callback() : '';
            });
            break;

        case 'error':
            swal.fire({
                title: "",
                html: msg,
                icon: mode,
                confirmButtonText: "확인",
                dangerMode: true,
            });
            break;

        default:
            swal.fire({
                title: "",
                html: msg,
                confirmButtonText: "확인"
            });
    }
}

function confirm(msg, callback) {

    swal.fire({
        html: msg,
        icon: "warning",
        buttons: true,
        dangerMode: true,
        showCancelButton: true,
        confirmButtonText: '확인',
        cancelButtonText: '취소'
    }).then(async (result) => {

            if (result.isConfirmed) {
                callback();
            } else {
                return false;
            }
        });

}


/**
 * 테이블 2개 쓰는 곳에 쓰이는 체크박스 all check 용
 * @param f
 */
function adminCheckAll(f, chkBoxs) {

    for (i = 0; i < chkBoxs.length; i++)
        chkBoxs[i].checked = f.check_all.checked;
}


/* 어드민 헤더 / 사이드 메뉴 / 메인 콘텐츠 간격 */
function adminTopLayout() {
    var headerHeight = $('#app header').innerHeight();
    // console.log(headerHeight);

    // $('#app #nav').css('margin-top', headerHeight);
    $('#app #main').css('margin-top', headerHeight);
}

// 파일첨부
window.addEventListener('load', function () {
    var fileTarget = $('.file-hidden');
    fileTarget.on('change', function () { // 값이 변경되면
        if (window.FileReader) { // modern browser
            var filename = $(this)[0].files[0].name;
        } else { // old IE
            var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
        } // 추출한 파일명 삽입
        // console.log(filename);
        $(this).siblings('.file-exist').text(filename);
    });
});
