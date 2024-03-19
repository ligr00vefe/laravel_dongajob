$(document).ready(function () {
    var fileTarget = $('.file-hiddens');
    fileTarget.on('change', function () { // 값이 변경되면
        if (window.FileReader) { // modern browser
            var filename = $(this)[0].files[0].name;
        } else { // old IE
            var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
        } // 추출한 파일명 삽입
        // console.log(filename);
        $(this).siblings('.file-name').val(filename);
    });

    $('.tbl-file').on('click', function () {
        $(this).siblings('.file-hiddens').click();
    });
});

(function () {

        let form = document.forms;
        let id = form.id;

        //--- 강좌 신청 버튼 객체
        let applicationBtn = {
            target: undefined,
            init: function () {
                this.target = document.querySelector('.btn-apply');
            },
            main: function () {
                this.init();
                this.event();
            },
            event: function () {
                let _this = this;
                _this.target.addEventListener('click', function (e) {

                    //--- 유효성 검사
                    if (_this.validation()) {
                        return;
                    }

                    if (confirm('확인이 되었다면 확인버튼을 눌러주시길 바랍니다.')) {
                        form.submit();
                    }

                });
            },
            validation: function () {

                let problem = false;

                //--- 개인정보 수집 동의 체크
                for (let i = 1; i <= 2; i++) {

                    let target = document.querySelector('#agree0' + i + '-01');

                    if (!target.checked) {
                        alert('개인정보 수집에 모두 동의 바랍니다.');
                        target.focus();
                        problem = true;
                        break;
                    }
                }

                //--- 사전질문 체크
                if (!problem)
                    return questionsTable.validation();

                return problem;

            }
        }


        //--- 사전질문 테이블 객체
        let questionsTable = {
            target: undefined,
            getAll: function () {
                return document.querySelectorAll('.questions_table tr td input');
            },
            init: function () {
                this.container = document.querySelector('.questions_table');
            },
            main: function () {
                this.event();
            },
            event: function () {
                document.querySelector('.support-td').addEventListener('click', function (e) {

                    let target = e.target;

                    // 추천채용지원경로 이벤트
                    if (target.nodeName == 'INPUT' && target.getAttribute('name') == 'question6') {

                        let question7 = document.querySelector('#question7');
                        let val = target.value;
                        let chk = false;
                        let name = '';

                        // input 허용
                        switch (val) {
                            case '100': // 평생지도교수
                                name = '교수명';
                                chk = true;
                                break;
                            case '200': // 취업동아리
                                name = '담당자명';
                                chk = true;
                                break;
                            case '300': // 교직원
                                name = '이름';
                                chk = true;
                                break;
                            case '700': // 기타
                                chk = true;
                                break;
                        }


                        // input box 가리기
                        if (chk) {
                            question7.classList.remove('display_none');
                            question7.setAttribute('placeholder', name);
                        } else {
                            question7.value = '';
                            question7.classList.add('display_none');
                            question7.setAttribute('placeholder', '');
                        }
                    }
                });

                // 취업동아리여부 클릭 이벤트
                document.querySelector('.support-td2').addEventListener('click', function (e) {
                    let target = e.target;
                    if (target.nodeName == 'INPUT' && target.getAttribute('name') == 'question5') {
                        let question9 = document.querySelector('#question9');
                        let val = target.value;
                        let chk = false;

                        // input 허용
                        switch (val) {
                            case '100': // 경험있음
                                chk = true;
                                break;

                        }

                        // input box 가리기
                        if (chk) {
                            question9.classList.remove('display_none');
                        } else {
                            question9.value = '';
                            question9.classList.add('display_none');
                        }

                    }
                });
            },
            getInfo: function () {
                let result = {};
                let elements = this.getAll();

                elements.forEach(function (ele, index) {

                    switch (index) {
                        case 0:
                            result.question1 = ele.value; // 졸업예정
                            break;
                        case 1:
                            result.question2 = ele.value; // 공인어학성적
                            break;
                        case 2:
                            result.question3 = ele.value; // 연락처
                            break;
                        case 3:
                            result.question4 = ele.value; // email
                            break;
                    }
                });

                return result;
            },
            validation: function () {

                let problem = false;

                // 유효성 검사할 목록 key : name, value : 메시지
                let vali = {
                    question6: '추천채용지원경로 작성바랍니다.',
                    question7: '추천채용지원경로 작성바랍니다.',
                    question5: '취업동아리여부 작성바랍니다.',
                    question9: '동아리명 작성바랍니다.',
                    question1: '졸업(예정)일자 작성바랍니다.',
                    question3: '연락처 작성바랍니다.',
                    question4: 'E-mail 작성바랍니다.',
                    question8: '출신고교 작성바랍니다',
                    question2: '공인어학성적 작성바랍니다.',
                };

                let valiKey = Object.keys(vali);

                // 유효성검사 제외시킬 name
                let except = ['question2'];


                let question6 = [
                    '100', '200', '300', '700'
                ];


                for (let i = 0; i < valiKey.length; i++) {
                    let _key = valiKey[i];

                    // 제외 체크
                    if (except.includes(_key)) {
                        continue;
                    }


                    let ele = document.querySelector('input[name=' + _key + ']');

                    if (
                        ele.value == '' ||
                        (ele.getAttribute('name') == 'question6' && !document.querySelector('input[name="question6"]:checked')) ||
                        (ele.getAttribute('name') == 'question5' && !document.querySelector('input[name="question5"]:checked'))
                    ) {

                        // 취업동아리여부 input txt 적여야할때 적혀있는지 체크
                        if (ele.getAttribute('name') == 'question9' && document.querySelector('input[name="question5"]:checked').value == 200) {
                            continue;
                        }

                        // 추천채용지원경로 input txt 적여야할때 적혀있는지 체크
                        if (ele.getAttribute('name') == 'question7' && !question6.includes(document.querySelector('input[name=question6]:checked').value)) {
                            continue;
                        }

                        problem = true;
                        ele.focus();
                        alert(vali[_key]);
                        break;
                    }
                }

                return problem;
            }
        }


        //--- 사진등록 객체
        let photoUpload = {
            target: undefined,
            imgTarget: undefined,
            init: function () {
                this.target = form.proof_photo;
                this.imgTarget = document.querySelector('.img-wrap img');
            },
            main: function () {
                this.init();
                this.event();
            },
            event: function () {
                let _this = this;
                this.target.addEventListener('change', function (e) {

                    if (_this.check(e.target.value))
                        return;

                    _this.upload();
                })
            },
            check: function (file) {

                let length = file.length;
                let extension = file.split('.').pop().toLowerCase();
                let possible = ['gif', 'png', 'jpg', 'jpeg'];
                let pattern = /[\{\}\/?,;:|*~`!^\+<>@\#$%&\\\=\'\"]/gi;

                if (!possible.includes(extension)) {
                    alert('이미지 파일만 등록하실수가 있습니다.');
                    return true;
                }

                if (pattern.test(file)) {
                    //alert('파일명에 특수문자는 입력될수 없습니다.');
                    //this.reset();
                    //return true;
                }

                return false;

            },
            upload: function () {

                let _this = this;
                let reader = new FileReader();
                let data = this.target.files[0];

                reader.addEventListener('load', function () {
                    _this.imgTarget.src = reader.result;
                });

                reader.addEventListener('error', function () {
                    console.log(reader.error.message);
                });

                reader.readAsDataURL(data);

            },
            reset: function () {
                this.target.value = '';
            }
        }


        applicationBtn.main();
        photoUpload.main();
        questionsTable.main();
    }
)
();
