var __board = __board || {}

window.addEventListener('load', function () {

    __board.listEvent();
    __board.createEvent();

});


;(function () {

    function listEvent() {

        //--- 선택삭제,엑셀출력 신규등록 버튼 이벤트
        document.querySelectorAll('.action-wrap') && document.querySelectorAll('.action-wrap').forEach(function (ele) {

            ele.addEventListener('click', function (e) {

                // 클릭한 버튼의 상위 section Node를 찾는다.
                var section = __common.searchParentNode(e.target, 'section');
                var formIndex = 0;

                // section 갯수 기준으로 form 위치를 찾는다.
                document.querySelectorAll('section').forEach(function (node, index) {
                    if (section != node)
                        return;

                    formIndex = index;
                });


                let form = document.querySelectorAll("form[name=forms]")[formIndex]; // ARTICLE 태그 기준으로 해당 폼을 찾는다.
                let route = form.dataset.route;
                console.log('e.target.dataset.name :', e.target.dataset.name);

                switch (e.target.dataset.name) {

                    case '등록':
                        // 넘길 id 값이 있다면 quety query 저장
                        let get = form.id ? '?id=' + form.id.value : '';

                        // 넘길 status 값이 있다면
                        get += get && form.status ? '&status=' + form.status.value :
                            !get && form.status ? '?status=' + form.status.value : '';

                        location.href = route + '/create' + get;
                        break;


                    case '삭제':
                        let chk = false;
                        let checkBoxs = document.querySelectorAll('._chk');

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
                                form.action = route + '/delete_all';
                                form._method = "delete";
                                form.submit();
                            });
                        } else {
                            alert('삭제하실 대상을 1개 이상 선택해주세요.', 'warning');
                        }
                        break;


                    case '엑셀':
                        location.href = '/superviser/excel/export?url=' + e.target.dataset.url + '&data_type=&from=' + e.target.dataset.from +'&to=' + e.target.dataset.to;
                        break;

                    case '스터디엑셀':
                        location.href = '/superviser/excel/export?url=' + e.target.dataset.url + '&data_type=&from=' + e.target.dataset.from +'&to=' + e.target.dataset.to;
                        break;

                    case '스터디엑셀1':
                        location.href = '/superviser/excel/export?url=' + e.target.dataset.url + '&data_type=1&from=' + e.target.dataset.from +'&to=' + e.target.dataset.to;
                        break;

                    case '이동':
                        console.log(route + '/move_all');

                        let moveChk = false;
                        let moveCheckBoxs = document.querySelectorAll('._chk');


                        // 체크된 박스가 있는지 체크 한다.
                        for (let moveBox of moveCheckBoxs) {
                            if (!moveBox.checked)
                                continue;

                            moveChk = true;
                            break;
                        }

                        // 체크한 박스가 있다면 삭제 가능
                        if (moveChk) {
                            confirm('선택된 게시물을 이전 취업수기게시판으로 옮기시겠습니까?', function () {
                                form.action = route + '/move_all';
                                form._method.value = "post";
                                form.submit();
                            });
                        } else {
                            alert('이동하실 대상을 1개 이상 선택해주세요.', 'warning');
                        }
                        break;
                }

            });
        });


        //--- 체크 박스 이벤트
        document.querySelector('#check_all') && document.querySelector('#check_all').addEventListener('click', function () {
            __common.checkAll(document.forms);
        });

    } // end listEvent


    //--- 등록,수정 게시판 이벤트
    function createEvent() {

        //--- 등록, 수정 게시판에만 설치를 한다.
        $editor = __board.editorEvent();


        document.querySelector('.btn-wrap') && document.querySelector('.btn-wrap').addEventListener('click', function (e) {

            // 클릭한 버튼의 상위 section Node를 찾는다.
            var section = __common.searchParentNode(e.target, 'section');
            var formIndex = 0;

            // section 갯수 기준으로 form 위치를 찾는다.
            document.querySelectorAll('section').forEach(function (node, index) {
                if (section != node)
                    return;

                formIndex = index;
            });

            let form = document.querySelectorAll("form[name=forms]")[formIndex]; // ARTICLE 태그 기준으로 해당 폼을 찾는다.
            let route = form.dataset.route;


            switch (e.target.dataset.name) {
                case '삭제':
                    confirm('정말로 삭제하시겠습니까? \n 삭제후 복구는 불가능 합니다.', function () {
                        form._method.value = 'delete';
                        form.action = route + '/' + form.id.value;
                        form.submit();
                    });
                    break;

                case '취소':
                    //location.href = route;
                    history.back();
                    break;

                case '등록':
                    // 유효성 검사

                    dd(textEditor.data);

                    if (__vaildate.validate()) {


                        form.action = route;
                        form.method = 'post';
                        form.submit();
                    }
                    break;

                case '수정':

                    // 유효성 검사
                    if (__vaildate.validate()) {

                        // 에디터가 있을경우 textArea에 저장
                        if (__board.editor) {
                            let editorData = document.createTextNode(__board.editor.getData());
                            document.forms.contents.innerHTML = '';
                            document.forms.contents.appendChild(editorData);
                        }

                        form.action = route + '/' + form.id.value;
                        form._method.value = 'put';
                        form.submit();
                    }
                    break;
            }
        });
    }

    //--- 에디터 세팅
    function editorEvent() {

        const $editor = document.getElementById('editor');

        if ($editor instanceof HTMLElement) {
            BalloonEditor.create($editor, {
                ckfinder: {
                    uploadUrl: '/superviser/notice/upload' + '?_token=' + document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(editor => {
                editor.editing.view.focus();

                __board.editor = editor;
            });
        }
    }

    __board.listEvent = listEvent;
    __board.createEvent = createEvent;
    __board.editorEvent = editorEvent;

})()


window.addEventListener('load', function () {
    var pathName = window.location.pathname;
    // console.log(pathName);
    var matchCreate = pathName.match('create');
    // console.log(matchCreate);

    if (matchCreate)  {
        // 라디오 박스 첫번째 항목 체크
        var isRadio = $(document).find('.radio_button_wrap');

        if(isRadio) {
            $('.radio_button_wrap input:first-of-type').prop('checked', true);
        }
    }

});
