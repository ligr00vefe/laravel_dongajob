@extends("layouts.admin")

@section("title")
    동아대 관리자 - 공지사항 {{ isset($list)? '수정' : '등록' }}
@endsection

@push("scripts")
    <script src="/lib/ckeditor5/build/ckeditor.js"></script>
    <script src="/js/UploadAdaptor.js"></script>
    <script defer src="/js/admin/board.js"></script>
@endpush

@section("content")
    @php
        $category_list = get_notice_category();
    @endphp

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>공지사항 {{ isset($list) ? '수정' : '등록' }}</h1>
            </div>

            <div class="table02">
                <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/notice" enctype="multipart/form-data">
                    @csrf
                    @if (isset($list))
                        @method("put")
                        <input type="hidden" name="id" value="{{ $list->id }}">
                    @endif
                    <input type="hidden" name="hit" value="0">

                    <table>
                        <tr>
                            <th>공지여부</th>
                            <td class="radio_button_wrap">
                                <input type="radio" id="status_id_01" name="status_id" class="radio_txtbox" value="1"
                                       data-title="공지여부" {{ isset($list->status_id) && $list->status_id == 1 ? 'checked' : '' }}>
                                <label for="status_id_01" class="radio_button_txt">공지</label>
                                <input type="radio" id="status_id_02" name="status_id" class="radio_txtbox" value="2"
                                       data-title="모집여부" {{ isset($list->status_id) && $list->status_id == 2 ? 'checked' : '' }}>
                                <label for="status_id_02" class="radio_button_txt">모집</label>
                                <input type="radio" id="status_id_03" name="status_id" class="radio_txtbox" value="0"
                                       data-title="기본" {{ isset($list->status_id) && $list->status_id == 0 ? 'checked' : '' }}
                                    {{ !isset($list->status_id) ? 'checked' : '' }}>
                                <label for="status_id_03" class="radio_button_txt">기본</label>
                            </td>
                        </tr>
                        <tr>
                            <th>카테고리</th>
                            <td>
                                <select name="category_id" class="category_box" required="">
                                    @foreach($category_list as $key => $value)
                                        <option value="{{$key}}" {{ isset($list) && $key == $list->category_id ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>달력노출일</th>
                            <td>
                                <input type="date" name="schedule_date" class=""
                                       value="{{ $list->schedule_date ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <th>제목</th>
                            <td>
                                <input type="text" class="_vali subject_txtbox" data-title="제목" name="subject" value="{{ $list->subject ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="editor-wrap">
                                @include("_include.editor.ckeditor5", [
                                    "editor_name" => "contents",
                                    "comment" => false,
                                    "image" => true,
                                    "path" => "notice",
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
{{--                                    <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" value="{{ getAttach($list->$attachment ?? "")->original_name ?? "" }}" readonly>--}}
                                    <label for="attachment{{ $i }}" class="btn-file btn01" onchange="javascript:document.getElementById('attachment{{ $i  }}').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
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
                        <button type="button" data-name="{{ isset($list)  ? '수정' : '등록' }}"
                                class="btn01 btn_submit">{{ isset($list)  ? '수정' : '등록' }}</button>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->
    </section>

@endsection
