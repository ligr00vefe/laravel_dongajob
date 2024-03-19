window.addEventListener('load', function () {

    document.querySelector('.btn-wrap').addEventListener('click', function (e) {

        let route = '/superviser/study/room';
        let form = document.forms;

        switch (e.target.dataset.name) {
            case '삭제':
                confirm('정말로 삭제하시겠습니까? \n 삭제후 복구는 불가능 합니다.', function () {
                    form._method.value = 'delete';
                    form.action = route + '/' + form.id.value ;
                    form.submit();
                });
                break;

            case '취소':
                location.href = route;
                break;

            case '등록':
                // 유효성 검사
                if (__vaildate.validate()) {
                    form.action = route;
                    form.method = 'post';
                    form.submit();
                }
                break;

            case '수정':
                // 유효성 검사
                if (__vaildate.validate()) {
                    form.action = route + '/' + form.id.value ;
                    form._method.value = 'put';
                    form.submit();
                }
                break;
        }
    });
});
