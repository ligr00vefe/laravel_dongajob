$(document).ready(function(){
    /*list*/
    $('#view-item-count').on('change', function(){
        $('.search_form').submit();
    });

    /*create, update*/
    var fileTarget = $('.file-hidden');
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
        $(this).siblings('.file-hidden').click();
    });
});

function archive_validate(f)
{
    // 제목 검사
    if (f.subject.value.length <= 0) {
        alert('제목을 입력해 주세요');
        f.subject.select();
        return false;
    }

    if (f.contents.value.length < 0) {
        alert("내용을 입력해 주세요.");
        // alert(f.contents.value);
        f.contents.focus();
        return false;
    }

    var agree01 = document.getElementById('agree01-01');
    var agree02 = document.getElementById('agree02-01');

    if (agree01) {
        if (!agree01.checked) {
            alert("개인정보 수집·이용·제공에 동의하셔야 작성 가능합니다.");
            document.getElementById('agree01-01').focus();
            return false;
        }
    }

    if (agree02) {
        if (!agree02.checked) {
            alert("개인정보 제3자 제공에 동의하셔야 작성 가능합니다.");
            document.getElementById('agree02-01').focus();
            return false;
        }
    }

    // document.getElementById("btn-register").disabled = "disabled";

    return true;
}