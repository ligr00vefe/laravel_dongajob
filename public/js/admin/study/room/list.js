window.addEventListener('load', function () {

    let roomIndex = 0;
    let roomId = 'seunghak';

    init();


    function init() {

        let campusId = __common.getQueryString('campus');
        let campus = document.querySelectorAll('.campus_info span')
        let tables = document.querySelectorAll('.table03');

        // 최초 로드시 승학캠퍼스는 active, 부민캠퍼스 table 은 숨긴다.
        if (!campusId) {
            campus[0].classList.add('active');
            tables[1].classList.add('none');
        } else {

            // 페이징 처리 되면 페이징 처리된 테이블의 캠퍼스를 active 시킨다.
            campus.forEach(function (obj, i) {
                if (campusId == (i + 1)) {
                    obj.classList.add('active');
                    tables[i].classList.remove('none');
                } else {
                    obj.classList.remove('active');
                    tables[i].classList.add('none');
                }
            });
        }
    }


    //--- 선택삭제,엑셀출력 신규등록 버튼 이벤트
    document.querySelector('.action-wrap').addEventListener('click', function (e) {

        let route = '/superviser/study/room';


        switch (e.target.dataset.name) {

            // 스터디룸 예약등록
            case '등록':
                location.href = route + '/create';
                break;

            case '삭제':
                let chk = false;
                let checkBoxs = document.querySelectorAll('#' + roomId + ' ._chk');

                // 체크된 박스가 있는지 체크 한다.
                for (let box of checkBoxs) {
                    if (!box.checked)
                        continue;

                    chk = true;
                    break;
                }

                // 체크한 박스가 있다면 삭제 가능
                if (chk) {
                    confirm('정말로 삭제하시겠습니까? \n 삭제후 복구는 불가능 합니다.', function () {
                        document.forms[roomIndex].submit();
                    });
                } else alert('삭제하실 스터디룸을 1개 이상 선택해주세요.');

                break;


            case '엑셀':
                document.excel.submit();

                break;
        }
    });


    //--- 체크 박스 이벤트
    document.querySelectorAll('.check_all').forEach(function (check) {
        check.addEventListener('click', function () {


            adminCheckAll(document.forms[roomIndex], document.querySelectorAll('#' + roomId + ' ._chk'));
        });
    });


    //--- 승학, 부민 캠퍼스 클릭 이벤트
    document.querySelector('.campus_info').addEventListener('click', function (e) {
        let target = e.target;
        let name = target.dataset.name;
        let tables = document.querySelectorAll('.table03'); // 승학,부민 캠퍼스 테이블
        let campus = document.querySelectorAll('.campus_info span'); // 승학,부민 선택 버튼

        // 클릭한 대상체가 '승학' 이면
        if (name == '승학') {
            campus[0].classList.add('active');
            campus[1].classList.remove('active');
            tables[0].classList.remove('none');
            tables[1].classList.add('none');

            roomIndex = 0;
            roomId = 'seunghak';

        } else if (name == '부민') {
            campus[0].classList.remove('active');
            campus[1].classList.add('active');
            tables[0].classList.add('none');
            tables[1].classList.remove('none');

            roomIndex = 1;
            roomId = 'bumin';
        }

    });
});
