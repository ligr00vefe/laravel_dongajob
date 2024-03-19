(function () {


    //--- 추천채용, 공지사항 버튼 object
    let tabList = {
        container: undefined,
        target: undefined,
        rel: undefined,
        activeClass: undefined,
        init: function () {
            this.container = document.querySelector('.option-tab');
            this.list = this.container.querySelectorAll('li');
            this.activeClass = 'active';
            this.rel = 'alimi01';
            this.target = this.container.querySelector('.active');
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {

            let self = this;

            self.container.addEventListener('click', function (e) {
                if (self.except(e.target))
                    return;

                //---
                self.hide();
                self.active();
                self.rel = self.target.getAttribute('rel');
                pageObj.getPaging(tableObj.currentTable().querySelector('.pagination'), tableObj.currentTable().querySelector('.pagination .active').dataset.page);
                submitBtn.submit(false);

                //---
                categoryList.hide();
                categoryList.show(self.target.getAttribute('rel'));


                //--- 테이블 변경
                tableObj.hide();
                tableObj.show(self.target.getAttribute('rel'));

            })
        },
        except: function (target) {

            let check = false;

            switch (target.nodeName) {
                case 'LI':
                    this.target = target;
                    break;

                case 'A':
                    this.target = target.parentNode;
                    break;

                default:
                    check = true;

            }

            return check;

        },
        active: function () {
            this.target.classList.add(this.activeClass);
        },
        hide: function () {
            for (let list of this.list) {
                if (list.classList.contains(this.activeClass))
                    list.classList.remove(this.activeClass);
            }
        },
        getId: function () {
            return this.container.querySelector('.active').dataset.id;
        }
    }


    //--- category 선택 object
    let categoryList = {
        container: undefined,
        list: undefined,
        className: undefined,
        target: undefined,
        init: function () {
            this.container = document.querySelector('.option-list');
            this.list = this.container.querySelectorAll('ul');
            this.className = '-option';
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {

        },
        show: function (id) {
            this.target = document.querySelector(`#${id}${this.className}`);
            this.target.style.display = '';
        },
        hide: function () {
            for (let list of this.list) {
                list.style.display = 'none';
            }
        },
        validation: function () {

            let checked = true;
            let targets = this.target.querySelectorAll('input[type="checkbox"]');

            for (let list of targets) {
                if (list.checked) {
                    checked = false;
                    break;
                }
            }

            return checked;
        },
        getData: function () {

            let data = [];
            let lists = this.target.querySelectorAll('input[type="checkbox"]');


            for (let list of lists) {
                if (list.checked) {
                    data.push(list.value);
                }
            }

            return data;
        },
    }


    //--- 설정완료 버튼 object
    let submitBtn = {
        target: undefined,
        imgClassName: undefined,
        imgTarget: undefined,
        imgPath: undefined,
        btnContent: '설정완료',
        init: function () {
            this.target = document.querySelector('.btn-setting');
            this.imgClassName = 'btn_loading';
            this.imgPath = '/img/btn_loading.gif';
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let self = this;

            self.target.addEventListener('click', function (e) {

                if (self.validation()) {
                    alert('알림받고 싶은 관심분야를 체크 해주시길 바랍니다.');
                    return;
                }


                self.disabled();
                self.loadingShow();
                self.submit(true);


            });
        },
        loadingShow: function () {
            this.imgTarget = document.createElement('img');

            this.imgTarget.setAttribute('class', this.imgClassName);
            this.imgTarget.setAttribute('src', this.imgPath);
            this.target.append(this.imgTarget);
        },
        loadingHide: function () {

            this.target.textContent = this.btnContent;
        },
        disabled: function () {
            this.target.disabled = true;
            this.target.textContent = '';
        },
        disabledHide: function () {

            this.target.disabled = false;
            this.target.textContent = this.btnContent;
        },
        validation: function () {
            return categoryList.validation();
        },
        submit: function (bool) {
            let self = this;

            let check = false;

            //--- 테이블 데이터 가져오기
            tableObj.loadingShow(document.querySelector(`.alimi-${tabList.rel}-table tbody`));

            __common.getAjax('GET', '/ajax/alimi', {id: tabList.getId(), data: categoryList.getData(), page : pageObj.page, bool : bool}, '', true, function (result) {


                self.disabledHide();
                self.loadingHide();


                tableObj.setData(result.responseText);

                check = true;
                //tableObj.loadingEnd(tableObj.recommendBox);

            });

            return check;
        }
    }


    //--- 테이블 object
    let tableObj = {
        recommendTable: undefined,
        noticeTable: undefined,
        recommendBox: undefined,
        noticeBox: undefined,
        containerClass : undefined,
        init: function () {
            this.recommendTable = document.querySelector('.alimi-alimi01-table');
            this.noticeTable = document.querySelector('.alimi-alimi02-table');
            this.recommendBox = document.querySelector('.alimi-table-box');
            this.noticeBox = document.querySelectorAll('.alimi-table-box')[1];
            this.containerClass = 'list-wrap';
        },
        main: function () {
            this.init();
        },
        loadingShow: function (parent) {
            this.initialization(parent);
            __common.loadingTdStart(parent, this.getColspan());
        },
        loadingEnd: function (parent) {
            __common.loadingEnd(parent);
        },
        initialization: function (parent) {
            parent.innerHTML = '';
        },
        setData: function (result) {
            let body = document.querySelector(`.alimi-${tabList.rel}-table tbody`);
            body.innerHTML = result;

        },
        show: function (id) {
            let box = document.querySelector(`#${id}-list`);

            box.style.display = '';
        },
        hide: function () {
            document.querySelectorAll(`.${this.containerClass}`).forEach(function (wrap) {
                wrap.style.display = 'none';
            })
        },
        currentTable : function () {

            let target = undefined;

            document.querySelectorAll(`.${this.containerClass}`).forEach(function (wrap) {
                if(wrap.style.display == 'none')
                    return;

                target = wrap;
            });


            return target;
        },
        getColspan : function () {

            switch (tabList.target.dataset.id) {
                case '200':
                    return 8;

                case '300':
                    return 6;
            }
        }
    }


    let pageObj = {
        recommendBox: undefined,
        noticeBox: undefined,
        page : 1,
        init: function () {
            this.recommendBox = document.querySelector('.pagination');
            this.noticeBox = document.querySelectorAll('.pagination')[1];
        },
        main: function () {
            this.init();
            this.event();
        },
        event: function () {
            let self = this;
            this.recommendBox.addEventListener('click', function (e) {

                if(!self.check(e.target)) {
                    return;
                }

                self.page = e.target.dataset.page;
                self.getPaging(e.currentTarget, self.page);
            });
        },
        getPaging : function (target, page) {
           __common.getAjax('GET', '/ajax/alimi/page', {id : tabList.target.dataset.id, page : page}, '', true, function (result) {

               submitBtn.submit(false);
               target.innerHTML = result.responseText;
           });
        },
        check : function (target) {
            let chk = false;

            switch (target.nodeName) {
                case 'A':
                case 'LI':
                    chk = true;
                    break;
            }

            return chk;
        }
    }

    //--- 전체 체크박스
    let checkBoxObj = {
        recommendCheck : undefined,
        noticeCheck : undefined,
        init : function () {
          this.recommendCheck = document.querySelector('.check_all');
          this.noticeCheck = document.querySelectorAll('.check_all')[1];
        },
        main : function () {
            this.init();
            this.event();
        },
        event : function () {
            this.recommendCheck.addEventListener('click', function () {
                __common.checkAll(document.forms[0]);
            })

            this.noticeCheck.addEventListener('click', function () {
                __common.checkAll(document.forms[1]);
            })
        },
        isCheck : function () {
            let targets = tableObj.currentTable().querySelectorAll('._chk');
            let chk = [];

            for(let target of targets) {
                if(!target.checked)
                    continue;

                chk.push(target.value);
            }

            if(!chk.length) {
                alert('삭제하실 알림내역을 선택해주시길 바랍니다.');
            }

            return chk;
        }
    }

    let deleteBtn = {
        recommendBtn : undefined,
        noticeBtn : undefined,
        init : function () {
            this.recommendBtn = document.querySelector('.btn-delete');
            this.noticeBtn = document.querySelectorAll('.btn-delete')[1];
        },
        main : function () {
            this.init();
            this.event();
        },
        event : function () {
            this.recommendBtn.addEventListener('click', function (e) {
                let checkBox = checkBoxObj.isCheck();
                if(!checkBox.length)
                    return;


                if(confirm('알림 내역을 삭제하시겠습니까?')) {
                    __common.getAjax('DELETE', '/ajax/alimi', {id : tabList.target.dataset.id, postId : checkBox}, function (result) {



                        pageObj.getPaging(tableObj.currentTable().querySelector('.pagination'), tableObj.currentTable().querySelector('.pagination .active').dataset.page);


                    }, true);
                }


            });



            this.noticeBtn.addEventListener('click', function (e) {
                let checkBox = checkBoxObj.isCheck();
                if(!checkBox.length)
                    return;


                if(confirm('알림 내역을 삭제하시겠습니까?')) {
                    __common.getAjax('DELETE', '/ajax/alimi', {id : tabList.target.dataset.id, postId : checkBox}, function (result) {



                        pageObj.getPaging(tableObj.currentTable().querySelector('.pagination'), tableObj.currentTable().querySelector('.pagination .active').dataset.page);
                    }, true);
                }


            });
        }
    }


    submitBtn.main();
    tabList.main();
    categoryList.main();
    tableObj.main();
    pageObj.main();
    checkBoxObj.main();
    deleteBtn.main();

    //--- 로드 시 카테고리 숨김처리
    categoryList.hide();
    categoryList.show(tabList.rel);

    //--- 데이터 가져오기
    tableObj.hide();
    tableObj.show(tabList.rel);
})()
