window.addEventListener('load', function () {

    //--- 카테고리 이동
    document.querySelector('.category_button_wrap') && document.querySelector('.category_button_wrap').addEventListener('click', function (e) {

        if (e.target.nodeName !== 'LI' && !e.target.dataset.id)
            return;

        let searchForm = document.querySelector('.search_form');
        let getQuery = '&search=' + searchForm.search.value + '&term=' + searchForm.term.value;

        location.href = '?category=' + e.target.dataset.id + getQuery;
    });


    //--- 스크랩
    document.querySelector('.btn-scrap') && document.querySelector('.btn-scrap').addEventListener('click', function (e) {

        if (!e.target.dataset.id && !e.target.dataset.board_id)
            return;

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'post',
            url: '/scrap',
            dataType: 'json',
            data: {
                "id": e.target.dataset.id,
                "category_id": e.target.dataset.board_id,
                "url" : location.pathname
            },
            success: function (data) {
                console.log(data);
                alert(data.msg);

            },
            error: function (data) {
                //console.log(data);
            }
        });

    });
    $('#view-item-count').on('change', function(){
        $('.search_form').submit();
    });
})

// maxlength 체크
function maxLengthCheck(object){
    // console.log( object );
    if (object.value.length > object.maxLength){
        object.value = object.value.slice(0, object.maxLength);
        alert(object.maxLength + '자 이상 입력할 수 없습니다.');
    }
}
