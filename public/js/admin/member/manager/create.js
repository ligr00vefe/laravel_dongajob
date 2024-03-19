var regType1 = /^[A-Za-z0-9+]*$/;


window.addEventListener('load', function () {

    let form = document.forms;
    let route = '/superviser/member/manager';

    //--- 실시간 아이디 검색
    form.account.addEventListener("keyup", function () {

        var account = this.value;
        var len = account.length;
        var show = document.getElementById('id_ox');

        // readonly는 패스
        console.log(this.readonly);

        // 4글자 이상일때
        if (len < 4) {
            show.textContent = '4글자 이상만 가능';
            show.style.color = "red";
            return
        }

        // 영문 체크
        if (!__vaildate.accountRegCheck(account)) {
            show.textContent = '영문과 숫자 4~12자 이내로 입력';
            show.style.color = "red";
            return
        }

        $.ajax({
            type: 'get',
            url: '/superviser/isAdmin',
            dataType: 'json',
            data: {
                "account": account
            },
            success: function (data) {
                show.textContent = '';
                show.innerHTML = data['data'];
                form.permit.value = data['response'] ?? 0;
            },
            error: function (data) {
                //console.log(data);
            }
        });
    });


    //--- 버튼 이벤트
    document.querySelector('.btn-wrap').addEventListener('click', function (e) {
        switch (e.target.dataset.name) {
            case '삭제':
                confirm('정말로 삭제하시겠습니까? \n 삭제후 복구는 불가능 합니다.', function () {
                    form._method.value = 'delete';
                    form.action = route + '/' + form.id.value;
                    form.submit();
                });
                break;

            case '취소':
                location.href = route;
                break;

            case '등록':
                // 유효성 검사

                if (!form.permit.value) {
                    alert("아이디 조건에 부합해야 합니다.", "error");
                    return
                }

                if (__vaildate.validate()) {
                    form.action = route;
                    form.method = 'post';
                    form.submit();
                }

                break;

            case '수정':
                // 유효성 검사

                if (__vaildate.validate()) {
                    form.action = route + '/' + form.id.value;
                    form._method.value = 'put';
                    form.submit();
                }

                break;
        }


    });

});
