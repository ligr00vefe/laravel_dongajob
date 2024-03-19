<form action="/comment" name="forms" method="post">
    @csrf
    @method('post')
    <input type="hidden" name="board_id" value="{{ $board_id }}">
    <input type="hidden" name="board_title" value="{{ $board_title }}">
    <input type="hidden" name="comment_id" value="">
    <input type="hidden" name="login" value="{{ $account }}">

    <div class="comment_tit">
        <h3>댓글 목록 <img src="/img/comment_arrow.png"></h3>
    </div>

    @forelse($comments as $comment)
        <div class="comment_list_wrap {{ $comment->class ? 'reply' : '' }}">
            <div class="comment_name">
                <p class="id_area">{{ $comment->class ? '└ [답변]' : '' }} {{ $comment->writer_type == 1 ? \App\Models\Student::getStudent($comment->account)->name : \App\Models\User::getUser($comment->account)->name ?? '-' }}</p>
                <p class="time_area">{{ $comment->created_at }}</p>
            </div>
            <div class="comment_content">
                <p>{{ $comment->comment }}</p>
                <div class="button_type" data-id="{{ $comment->id }}">
                    @if(!$comment->class)
                        <li class="answer">답변</li>
                    @endif
                    @if($account == $comment->account)
                        <li class="modify">수정</li>
                        <li class="delete">삭제</li>
                    @endif
                </div>
            </div>
        </div>

    @empty

    @endforelse

    <div class="comment_write_wrap">
        <div class="comment_box">
            <textarea name="comment" id="comment_text" maxlength="300" placeholder="댓글을 입력하세요" onfocus="this.placeholder=''"></textarea>
            {{--<label class="comment_text_guide" for="comment_text">저작권 등 다른 사람의 권리를 침해하거나 명예를 훼손하는 게시물은 이용약관 및 관련 법률에 의해 제재를 받을 수 있습니다. 타인에게 불쾌감을 주는 욕설 또는 특정 계층/민족, 종교 등을 비하하는 단어들은 표시가 제한됩니다.</label>--}}
        </div>
    </div>

    <div class="comment_ok_wrap">
        <div class="comment_cnt"><span id="count">0</span><span>/</span><span id="max_count"></span></div>
        <div class="ok_button">
            댓글등록
        </div>
    </div>
</form>

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

        if (totalByte < (MAX_MESSAGE_BYTE - 2)) {
            countSpan.innerText = totalByte.toString();
            message = event.target.value;
        }else {
            alert((MAX_MESSAGE_BYTE - 2) + "자까지 입력 가능합니다.");
            event.target.value =  event.target.value.slice(0, MAX_MESSAGE_BYTE - 2);
            countSpan.innerText = count(message).toString();
            event.target.value = message;
        }
    }
</script>

