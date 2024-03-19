<div id="hd_pop">
    @foreach($lists as $list)
        @continue(Cookie::get('hd_pops_'.$list->id))
        <div id="hd_pops_{{ $list->id }}" class="hd_pops" style="top:{{ $list->top }}px;left:{{ $list->left }}px">
            <div class="hd_pops_con" style="width:{{ $list->width }}px;height:{{ $list->height }}px">
                {!! stripslashes($list->contents) !!}
            </div>
            <div class="hd_pops_footer">
                <button class="hd_pops_reject hd_pops_{{ $list->id }} {{ $list->disable_hours }}">
                    <strong>{{ $list->disable_hours }}</strong>시간 동안 다시 열람하지 않습니다.
                </button>
                <button class="hd_pops_close hd_pops_{{ $list->id }} ">닫기 <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    @endforeach
</div>

<script>
    $(function () {
        $(".hd_pops_reject").click(function () {
            var id = $(this).attr('class').split(' ');
            var ck_name = id[1];
            var exp_time = 60 * 60 * 1000 * parseInt(id[2]);
            $("#" + id[1]).css("display", "none");

            __common.getAjax('post', '/ajax/cookie', {key: ck_name, time: exp_time});

        });
        $('.hd_pops_close').click(function () {
            var idb = $(this).attr('class').split(' ');
            $('#' + idb[1]).css('display', 'none');
        });
        $("#hd").css("z-index", 1000);
    });
</script>
