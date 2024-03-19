@extends("layouts.admin")

@section("title")
    동아대 관리자 - 이전 취업수기 {{ isset($list)? '수정' : '등록' }}
@endsection

@push("scripts")
    <script defer src="/js/admin/board.js"></script>
    <script  src="/lib/ckeditor5/build/ckeditor.js"></script>
    <script  src="/js/UploadAdaptor.js"></script>


@endpush

@section("content")

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>이전 취업수기 {{ isset($list)? '수정' : '등록' }}</h1>
            </div>
        </article> <!-- article list_head end -->

        <div class="table02">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/archive/reviewbefore" enctype="multipart/form-data">
                @csrf
                @if (isset($list))
                    @method("put")
                    <input type="hidden" name="id" value="{{ $list->id }}">
                    <input type="hidden" name="hit" value="{{ $list->hit }}">
                @else
                    <input type="hidden" name="hit" value="0">
                @endif

                <table>
                    {{--<tr>--}}
                        {{--<th>이름</th>--}}
                        {{--<td>--}}
                            {{--<input type="text" name="name" class="_vali" data-tile="이름" value="">--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<th>학과</th>--}}
                        {{--<td>--}}
                            {{--<input type="text" name="department" class="_vali" data-tile="학과" value="">--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <th>제목</th>
                        <td>
                            <input type="text" name="subject" class="_vali w600" data-tile="제목" value="{{ $list->subject ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="editor-wrap">
                            @include("_include.editor.ckeditor5",  [
                                "editor_name" => "contents",
                                "comment" => false,
                                "image" => true,
                                "path" => "reviewbefore",
                                "contents" => $list->contents ?? ""
                            ])
                        </td>
                    </tr>
                    @for($i = 1; $i <= 5; $i++)
                        @php
                            $attachment = 'attachment'.$i;
                        @endphp
                        <tr>
                            <th>첨부파일 {{ $i }}</th>
                            <td>
                                <input type="file" id="attachment{{ $i }}" name="attachment{{ $i }}" class="file-hidden" readonly>
{{--                                <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" value="{{ getAttach($list->$attachment ?? "")->original_name ?? "" }}" readonly>--}}
                                <label for="attachment{{ $i }}" class="btn-file btn01" onchange="javascript:document.getElementById('attachment{{ $i }}').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                                <span class="file-exist">{{ getAttach($list->$attachment ?? "")->original_name ?? "" }}</span>
                            </td>
                        </tr>
                    @endfor
                </table>

                <div class="btn-wrap">
                    @if(isset($list))
                        <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                    @endif
                    <button type="button" data-name="취소" class="btn01 btn_cancel">취소</button>
                    <button type="button" data-name="{{ isset($list)  ? '수정' : '등록' }}" class="btn01 btn_submit">{{ isset($list)  ? '수정' : '등록' }}</button>
                </div>
            </form>
        </div>
    </section>

@endsection
