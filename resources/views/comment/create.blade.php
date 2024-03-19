<style>
    .view_comment_wrap {
        width: 100%;
    }

    .view_comment_wrap .comment_tit {
        font-weight: 600;
        padding-bottom: 30px;
    }

    .view_comment_wrap .comment_tit img {
        padding: 0 0 0 5px;
    }

    .view_comment_wrap .comment_list_wrap {
        width: 100%;
    }

    .view_comment_wrap .comment_list_wrap .comment_name {
        overflow: hidden;
        padding-bottom: 10px;
        font-size: 15px;
    }

    .view_comment_wrap .comment_list_wrap .comment_name .id_area {
        float: left;
        font-weight: 600;
    }

    .view_comment_wrap .comment_list_wrap .comment_name .time_area {
        float: right;
    }

    .view_comment_wrap .comment_list_wrap .comment_content {
        background: #F5F5F5;
        border: 1px solid #AEAEAE;
        padding: 20px;
        display: inline-block;
        width: 100%;
    }

    .view_comment_wrap .comment_list_wrap .comment_content .button_type {
        display: inline-block;
        float: right;
        padding-top: 20px;
    }

    .view_comment_wrap .comment_list_wrap .comment_content .button_type li {
        list-style: none;
        float: left;
        color: #AEAEAE;
        background: #fff;
        border: 1px solid #AEAEAE;
        padding: 8px;
        margin-right: 3px;
        font-size: 14px;
    }

    .view_comment_wrap .comment_write_wrap{
        padding: 20px;border: 1px solid #AEAEAE;clear:both;
    }
    .view_comment_wrap .comment_write_wrap .comment_box{
        position: relative;
        height:80px;
    }
    .view_comment_wrap .comment_write_wrap .comment_box textarea{
        width: 100%; height:100%; resize:none;font-size: 15px;color:#000;border:0;word-break: break-all
    }
    .view_comment_wrap .comment_write_wrap .comment_box textarea:active,
    .view_comment_wrap .comment_write_wrap .comment_box textarea:focus {
        outline:0;
    }

    .view_comment_wrap .comment_ok_wrap {
        overflow: hidden;
        padding: 20px 0 50px;
        clear:both;
        text-align: right;
    }

    .view_comment_wrap .comment_ok_wrap .ok_button {
        display:inline-block;
        background: #000;
        width: 150px;
        height: 55px;
        line-height: 55px;
        text-align: center;
        color: #fff;
        cursor:pointer;
    }
    /*댓글 카운트*/
    .view_comment_wrap .comment_write_wrap .comment_box .comment_text_guide {
        overflow: hidden;
        position: absolute;
        top: 2px;
        right: 25px;
        bottom: 5px;
        left: 16px;
        z-index: 10;
        border: none;
        font-size: 14px;
        color: #ccc;
        line-height: 1.5;
        cursor: default;
    }
    .view_comment_wrap .comment_write_wrap .comment_box #comment_text {}
    .view_comment_wrap .comment_ok_wrap .comment_cnt {display:inline-block;margin:10px 20px;vertical-align: bottom;}

    /*답글 반응형 */
    @media (max-width:1280px) {
        .view_comment_wrap .comment_tit{padding-bottom: 18.5px;}
        .view_comment_wrap .comment_ok_wrap .ok_button{width: 100px; height: 45px; font-size: 15px; line-height: 45px;}
    }

    @media (max-width:768px){
        .view_comment_wrap .comment_list_wrap {padding-bottom:15px;}
        .view_comment_wrap .comment_list_wrap.reply {width:95%;}

        .view_comment_wrap .comment_list_wrap .comment_name .id_area,
        .view_comment_wrap .comment_list_wrap .comment_name .time_area {font-size:13px;}
    }

</style>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>동아대학교 댓글 {{ $mode }}</title>
</head>
<body>
<div class="view_comment_wrap pdt50">
    @if($mode == '수정' && $account == $list->account || $mode == '답변')

    @if(session('success') || session('error'))
        <script>
            alert('{{ session('success') }}')
            opener.document.location.reload();
            self.close();
        </script>
    @endif

    <form action="/comment/{{ $list->id }}{{ $mode == '답변' ?  '/answer' : ''  }}" name="forms" method="post">
        @csrf
        @method($mode == '수정' ? 'put' : 'post')
        <input type="hidden" name="board_id" value="{{ $list->board_id }}">
        <input type="hidden" name="id" value="{{ $list->id }}">
        <input type="hidden" name="board_title" value="">

        <div class="comment_write_wrap">
            <div class="comment_box">
                <textarea name="comment" id="comment_text" maxlength="300" placeholder="댓글을 입력하세요" oninput="maxLengthCheck(this)" onfocus="this.placeholder=''">{{ $mode == '수정' ? $list->comment : '' }}</textarea>
                {{--<label class="comment_text_guide" for="comment_text">저작권 등 다른 사람의 권리를 침해하거나 명예를 훼손하는 게시물은 이용약관 및 관련 법률에 의해 제재를 받을 수 있습니다. 타인에게 불쾌감을 주는 욕설 또는 특정 계층/민족, 종교 등을 비하하는 단어들은 표시가 제한됩니다.</label>--}}
            </div>
        </div>

        <div class="comment_ok_wrap">
            <div class="comment_cnt"><span id="count">0</span><span>/</span><span id="max_count"></span></div>
            <div class="ok_button">댓글{{ $mode }}</div>
        </div>
    </form>
</div>

<script>
    // 댓글 카운트
    document.getElementById('comment_text').addEventListener('keydown', checkByte);
    var countSpan = document.getElementById('count');
    var message = "";
    var MAX_MESSAGE_BYTE = 302;

    document.getElementById('max_count').innerHTML = (MAX_MESSAGE_BYTE.toString() - 2);

    function count(message) {
        var totalByte = 0;

        for (var index = 0, length = message.length; index < length; index++) {
            var currentByte = message.charCodeAt(index);
            (currentByte > 128) ? totalByte += 2 : totalByte++;
        }
        return totalByte;
    }

    function checkByte(event) {
        const totalByte = count(event.target.value);

        if (totalByte < MAX_MESSAGE_BYTE) {
            countSpan.innerText = totalByte.toString();
            message = event.target.value;
        }else {
            alert((MAX_MESSAGE_BYTE - 2) + "자까지 입력 가능합니다.");
            countSpan.innerText = count(message).toString();
            event.target.value = message;
        }
    }


    document.forms.board_title.value = opener.document.forms.board_title.value;

    document.querySelector('.ok_button').addEventListener('click', function () {

        if (!document.forms.comment.value) {
            alert('댓글 내용을 입력하세요.');
        }

        document.forms.submit();

    });
</script>

@else
    <div style="text-align: center">권한이 없습니다.</div>
    <div class="comment_ok_wrap">
        <div class="ok_button">종료</div>
    </div>

    <script>
        document.querySelector('.ok_button').addEventListener('click', function () {
            opener.document.location.href = "/";
            self.close();
        });
    </script>
@endif
</body>
</html>
