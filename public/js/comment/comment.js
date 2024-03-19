(function () {

    let form = document.forms;
    let commentId = form.comment_id;


    //--- 코멘트 객체
    let commentInput = {
        target: undefined,
        init: function () {
            this.target = form.comment;
        },
        main: function () {
            this.init();
        },
        get: function () {
            return this.target.value;
        }
    }


    //--- 댓글 등록 객체
    let addBtn = {
        target: undefined,
        init: function () {
            this.target = document.querySelector('.ok_button');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let _this = this;
            _this.target.addEventListener('click', function () {

                if (_this.vaildation()) {
                    return;
                }

                form._method.value = 'post';
                form.submit();
            });
        },
        vaildation: function () {

            //--- 로그인 체크
            if(attributeBtn.loginCheck())
                return true;


            let comment = commentInput.get();
            if (!comment) {
                alert('댓글 내용을 입력하세요.');
                comment.target.focus();
                return true;
            }


            return false;
        },


    }

    let attributeBtn = {
        boxTarget: undefined,
        main: function () {
            this.event();
        },
        event: function () {
            let _this = this;

            form.addEventListener('click', function (e) {

                if (e.target.classList.contains('answer')) { // 답변

                    //--- 로그인 체크
                    if(_this.loginCheck())
                        return;

                    commentId.value = e.target.parentNode.dataset.id;
                    _this.open(`/comment/${commentId.value}/answer`, '/comment/' + commentId.value, 'post');
                } else if (e.target.classList.contains('modify')) { // 수정
                    commentId.value = e.target.parentNode.dataset.id;
                    _this.open(`/comment/${commentId.value}/edit`, '/comment/' + commentId.value, 'put');
                } else if (e.target.classList.contains('delete')) { // 삭제
                    commentId.value = e.target.parentNode.dataset.id;
                    _this.delete();
                }


            })
        },
        delete: function () {
            if (confirm('삭제하시겠습니까?')) {
                form._method.value = 'delete';
                form.action = form.action + '/' + commentId.value;
                form.comment_id.value = commentId.value;
                form.submit();
            }
        },
        open: function (url) {
            let childrenWin = window.open(url, "childForm", "width=570, height=300, resizable = no, scrollbars = no");

        },
        loginCheck: function () {

            if (!form.login.value) {
                if (confirm(__msg.msgCollection('confirm_login'))) {
                    location.href = '/login';
                }
                return true;
            }

            return false;
        }

    }


    commentInput.main();
    addBtn.main();
    attributeBtn.main();
})()
