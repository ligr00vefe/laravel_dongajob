(function () {

    let form = document.spLoginFrm;

    document.querySelector('.btn_submit').addEventListener('click', function () {

        let account = form.user_id.value;
        let password = form.user_password;
        let confirmSize = window.outerWidth <= 768 ? '60%' : '20%';
        let check = true;

        if (account == '' || password.value == '') {
            alert('로그인 정보 입력 바랍니다.');
            return;
        }

        form.action = form.check.value ? __common.authServer : '/login';

        __common.getAjax('POST', '/ajax/user/search', {account: account}, function (serachResult) {


            // 개인정보 수집 제공 동의 했는지 체크
            __common.getAjax('GET', '/isPrivacy', {account: account}, function (result) {

                // 아직 하지 않았다면
                if (result.status == 204) {

                    check = false;

                    $.confirm({
                        title: '',
                        boxWidth: confirmSize,
                        boxHeight: '300px',
                        useBootstrap: false,
                        smoothContent: true,
                        scrollToPreviousElementAnimate: false,
                        scrollToPreviousElement: false,
                        draggable: true,
                        content: '<br><b>개인정보 수집 이용 및 제공에 동의하십니까?</b> <br><br> <a target="_blank" href="https://www.donga.ac.kr/gzSub_014.aspx">개인정보 수집 이용 및 제공<br>[내용보기]</a><br><br><br>',
                        buttons: {
                            '취소': function () {
                            },
                            '확인': function () {
                                __common.getAjax('GET', '/setPrivacy', {account: account, yn: 'y'}, function () {
                                    form.submit();
                                }, false);
                            }
                        }
                    });
                }

            }, false);


            if (serachResult.status == 200) {
                form.action = '/login';
                form.submit();
            }

            if (check)
                form.submit();


        }, false);


    });
})();
