@extends("layouts.admin")

@section("title")
    동아대 관리자 - 일반채용 {{ isset($list)? '수정' : '등록' }}
@endsection

@push("scripts")
    <script src="/lib/ckeditor5/build/ckeditor.js"></script>
    <script src="/js/UploadAdaptor.js"></script>
    <script defer src="/js/admin/board.js"></script>

@endpush

@section("content")

    @php
        $recruitment_list = get_recommend_recruitment_lists();
        $area_list = get_work_area_lists();
        $screening_method_list = get_recommend_screening_method_lists();
    @endphp

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>일반채용 {{ isset($list)? '수정' : '등록' }}</h1>
            </div>
        </article> <!-- article list_head end -->

            <div class="table02">
                <form action="/{{ ADMIN_URL }}/jobinfo/normal/{{ isset($list) ? '{id}/update' : 'create' }}" method="post" name="forms" data-route="/{{ ADMIN_URL }}/jobinfo/normal" enctype="multipart/form-data">
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
                            <th>기업명</th>
                            <td>
                                <input type="text" name="company_name" class="_vali w300" data-title="기업명" value="{{ $list->company_name ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>모집분야</th>
                            <td>
                                <input type="text" name="recruitment_field" class="_vali w50p" data-title="모집분야" value="{{ $list->recruitment_field ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>채용형태</th>
                            <td class="radio_button_wrap">
                                @foreach($recruitment_list as $key => $value)
                                    <input type="radio" id="recommend_recruitment_{{ $key }}" class="_vail radio_txtbox" value="{{ $key }}"
                                           data-title="채용형태"
                                           name="category" {{ isset($list) && $list->category == $key ? 'checked' : '' }}>
                                    <label for="recommend_recruitment_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>홈페이지</th>
                            <td>
                                <input type="text" name="homepage" class="w300" value="{{ $list->homepage ?? '' }}" placeholder="https://" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>근무지역</th>
                            <td>
                                <select name="work_area" class="" required="">
                                    @foreach($area_list as $key => $value)
                                        <option value="{{ $key }}" {{ isset($list) && $list->work_area == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>전형방법</th>
                            <td class="radio_button_wrap">
                                @foreach($screening_method_list as $key => $value)
                                    <input type="radio" id="recommend_screening_{{ $key }}" class="_vail radio_txtbox" value="{{ $key }}"
                                           data-title="전형방법"
                                           name="screening_method" {{ isset($list) && $list->screening_method == $key ? 'checked' : '' }}>
                                    <label for="recommend_screening_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>접수 시작일</th>
                            <td>
                                <input type="date" name="receipt_start_date" class="_vali" data-title="접수 시작일" value="{{ $list->receipt_start_date ?? '' }}">
                                <input type="time" name="receipt_start_time" class="_vali" data-title="접수 시작시간" value="{{ $list->receipt_start_time ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <th>접수 마감일</th>
                            <td>
                                <input type="date" name="receipt_end_date" class="_vali" data-title="접수 마감일" value="{{ $list->receipt_end_date ?? '' }}">
                                <input type="time" name="receipt_end_time" class="_vali" data-title="접수 마감시간" value="{{ $list->receipt_end_time ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="editor-wrap" colspan="2">
                                @include("_include.editor.ckeditor5",  [
                                     "editor_name" => "contents",
                                     "comment" => false,
                                     "image" => true,
                                     "path" => "normal",
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
                        <button type="button" data-name="{{ isset($list)  ? '수정' : '등록' }}" class="btn01 btn_submit">{{ isset($list)  ? '수정' : '등록' }}</button>
                    </div>
                </form>
            </div>

    </section>

@endsection
