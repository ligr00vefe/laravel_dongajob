@extends("layouts.admin")

@section("title")
    동아대 관리자 - 동아친화기업 300 {{ isset($list)? '수정' : '등록' }}
@endsection

@push("scripts")
    <script src="/lib/ckeditor5/build/ckeditor.js"></script>
    <script src="/js/UploadAdaptor.js"></script>
    <script defer src="/js/admin/board.js"></script>

@endpush

@section("content")

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>동아친화기업 300 {{ isset($list) ? '수정' : '등록' }}</h1>
            </div>
        </article> <!-- article list_head end -->

        <div class="table02">
            <form action="/{{ ADMIN_URL }}/jobinfo/donga300/{{ isset($list) ? '{id}/update' : 'create' }}" method="post" name="forms" data-route="/{{ ADMIN_URL }}/jobinfo/donga300" enctype="multipart/form-data">
                @csrf
                @if (isset($list))
                    @method("put")
                    <input type="hidden" name="id" value="{{ $list->id }}">
                    <input type="hidden" name="hit" value="{{ $list->hit ?? '0' }}">
                @else
                    <input type="hidden" name="hit" value="0">
                @endif

                <table>
                    <tr>
                        <th>공지여부</th>
                        <td class="checkbox_txt_wrap">
                            <input type="checkbox" id="status_id_01" name="status_id" class="input_checkbox" value="1"
                                   data-title="공지여부" {{ isset($list->status_id) && $list->status_id == 1 ? 'checked' : '' ?? ""}}>
                            <label for="status_id_01" class="checkbox_txt">공지</label>
{{--                                <input type="radio" id="status_id_03" name="status_id" class="radio_txtbox" value="0"--}}
{{--                                       data-title="기본" {{ isset($list->status_id) && $list->status_id == 0 ? 'checked' : '' ?? ""}}--}}
{{--                                    {{ !isset($list->status_id) ? 'checked' : '' ?? ""}}>--}}
{{--                                <label for="status_id_03" class="radio_button_txt">기본</label>--}}
                        </td>
                    </tr>
                    <tr>
                        <th>취업자 수</th>
                        <td class="txt_middle_wrap">
                            <input type="text" class=" employee_txtbox w300" name="cnt_employed" value="{{ $list -> cnt_employed ?? "" }}" maxlength="10" oninput="maxLengthCheck(this)"> <span>명</span>
                        </td>
                    </tr>
                    <tr>
                        <th>URL</th>
                        <td>
                            <input type="text" name="homepage" class="w50p" value="{{ $list->homepage ?? '' }}" placeholder="https://" maxlength="255" oninput="maxLengthCheck(this)">
                        </td>
                    </tr>
                    <tr>
                        <th>제목</th>
                        <td>
                            <input type="text" class="_vali subject_txtbox w50p" data-title="제목" name="subject" value="{{ $list->subject ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                        </td>
                    </tr>
                    <tr>
                        <td class="editor-wrap" colspan="2">
                            @include("_include.editor.ckeditor5",  [
                                "editor_name" => "contents",
                                "comment" => false,
                                "image" => true,
                                "path" => "donga300",
                                "contents" => $list->contents ?? ""
                            ])
                        </td>
                    </tr>

                    @for($i = 1; $i <= 5; $i++)
                        <tr>
                            <th>첨부파일 {{$i}}</th>
                            <td>
                                <input type="file" id="attachment{{ $i }}" name="attachment{{ $i }}" class="file-hidden" readonly>
                                <label for="attachment{{ $i }}" class="btn-file btn01" onchange="javascript:document.getElementById('attachment{{ $i }}').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                                <span class="file-exist">{{ $original_names[$i] ?? "" }}</span>
                            </td>
                        </tr>
                    @endfor
                </table>

                <div class="btn-wrap">
                    @if(isset($list))
                        <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                    @endif
                    <button type="button" data-name="취소" class="btn01 btn_cancel">취소</button>
                    <button type="button" data-name="{{ isset($list) ? '수정' : '등록' }}"
                            class="btn01 btn_submit">{{ isset($list) ? '수정' : '등록' }}</button>
                </div>
            </form>
        </div>
    </section>

@endsection
