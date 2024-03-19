@extends("layouts.admin")

@section("title")
    동아대 관리자 - 프로그램 {{ isset($list)? '수정' : '등록' }}
@endsection

@push("scripts")
    <script src="/lib/ckeditor5/build/ckeditor.js"></script>
    <script src="/js/UploadAdaptor.js"></script>
    <script defer src="/js/admin/board.js"></script>

@endpush

@section("content")
    @php
        $status_list = get_program_status_lists();
        $target_list = get_program_education_target_lists();
        $grade_list = get_program_student_grade_lists();
        $bank_list = get_bank_lists();
    @endphp

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>프로그램 등록</h1>
            </div>
        </article> <!-- article list_head end -->

        <div class="table02">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/support/program">
                @csrf
                @if (isset($list))
                    @method("put")
                    <input type="hidden" name="id" value="{{ $list->id }}">
                    <input type="hidden" name="hit" value="0">
                @endif

                <table>
                    <tr>
                        <th>강좌명</th>
                        <td>
                            <input type="text" name="subject" class="_vali subject_txtbox" data-title="강좌명"
                                   value="{{ $list->subject ?? '' }}">
                        </td>
                    </tr>


                    <tr>
                        <th>접수상태 자동여부</th>
                        <td class="radio_button_wrap">
                            @foreach(get_program_status_auto_lists() as $key => $value)
                                <input type="radio" id="status_auto_{{$key}}" class="_vali radio_txtbox"
                                       name="status_auto"
                                       value="{{ $key }}" {{ isset($list) && $list->status_auto == $key ? 'checked' : '' }}>
                                <label for="status_auto_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                            @endforeach
                        </td>
                    </tr>


                    <tr>
                        <th>접수상태</th>
                        <td class="radio_button_wrap">
                            @foreach($status_list as $key => $value)
                                <input type="radio" id="program_status_{{ $key }}" class="_vali radio_txtbox"
                                       value="{{ $key }}" data-title="접수상태"
                                       name="status" {{ isset($list) && $list->status == $key ? 'checked' : '' }}>
                                <label for="program_status_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>공개여부</th>
                        <td class="radio_button_wrap">
                            <input type="radio" id="program_open_1" class="_vali radio_txtbox" value="1"
                                   data-title="공개여부"
                                   name="open" {{ isset($list) && $list->open == 1 ? 'checked' : '' }}>
                            <label for="program_open_1" class="radio_button_txt">공개</label>
                            <input type="radio" id="program_open_2" class="_vali radio_txtbox" value="0"
                                   data-title="공개여부"
                                   name="open" {{ isset($list) && $list->open == 0 ? 'checked' : '' }}>
                            <label for="program_open_2" class="radio_button_txt">비공개</label>
                        </td>
                    </tr>
                    <tr>
                        <th>강사명</th>
                        <td>
                            <input type="text" name="teacher_name" class="" data-title="강사명"
                                   value="{{ $list->teacher_name ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <th>접수일시</th>
                        <td>
                            <input type="date" name="start_reception_date" class="" data-title="접수일시"
                                   value="{{ $list->start_reception_date ?? '' }}">
                            <input type="time" name="start_reception_time" class="" data-title="접수일시"
                                   value="{{ $list->start_reception_time ?? '' }}">
                            <span class="tilde">~</span>
                            <input type="date" name="end_reception_date" class="" data-title="접수일시"
                                   value="{{ $list->end_reception_date ?? '' }}">
                            <input type="time" name="end_reception_time" class="" data-title="접수일시"
                                   value="{{ $list->end_reception_time ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <th>수강일시</th>
                        <td>
                            <input type="date" name="start_course_date" class="" data-title="수강일시"
                                   value="{{ $list->start_course_date ?? '' }}">
                            <input type="time" name="start_course_time" class="" data-title="수강일시"
                                   value="{{ $list->start_course_time ?? '' }}">
                            <span class="tilde">~</span>
                            <input type="date" name="end_course_date" class="" data-title="수강일시"
                                   value="{{ $list->end_course_date ?? '' }}">
                            <input type="time" name="end_course_time" class="" data-title="수강일시"
                                   value="{{ $list->end_course_time ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <th>수강장소</th>
                        <td>
                            <input type="text" class="{{--_vali--}}" {{--data-title="수강장소"--}} name="location"
                                   value="{{ $list->location ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <th>수강인원</th>
                        <td class="txt_middle_wrap">
                            <input type="text" class="" data-title="수강인원" name="number_students"
                                   value="{{ $list->number_students ?? '' }}">
                            <span>명</span>
                        </td>
                    </tr>
                    <tr>
                        <th>대기인원</th>
                        <td class="txt_middle_wrap">
                            <input type="text" class="" data-title="대기인원" name="number_waiting"
                                   value="{{ $list->number_waiting ?? '' }}">
                            <span>명</span>
                        </td>
                    </tr>
                    <tr>
                        <th>교육대상</th>
                        <td class="radio_button_wrap">
                            @foreach($target_list as $key => $value)
                                <input type="radio" id="program_target_{{ $key }}" class="_vali radio_txtbox"
                                       value="{{ $key }}" data-title="교육대상"
                                       name="education_target" {{ isset($list) && $list->education_target == $key ? 'checked' : '' }}>
                                <label for="program_target_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>재학생</th>
                        <td class="radio_button_wrap">
                            @foreach($grade_list as $key => $value)
                                <input type="radio" id="program_grade_{{ $key }}" class="_vali radio_txtbox"
                                       value="{{ $key }}" data-title="재학생"
                                       name="student_grade" {{ isset($list) && $list->student_grade == $key ? 'checked' : '' }}>
                                <label for="program_grade_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>교재</th>
                        <td>
                            <input type="text" class="" {{--data-title="교재"--}} name="text_book"
                                   value="{{ $list->text_book ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <th>수강료</th>
                        <td class="txt_middle_wrap">
                            <input type="text" class="" {{--data-title="수강료"--}} name="tuition_fees"
                                   value="{{ $list->tuition_fees ?? '' }}">
                            <span>원</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="editor-wrap">
                            @include("_include.editor.ckeditor5",  [
                                "editor_name" => "contents",
                                "comment" => false,
                                "image" => true,
                                "path" => "program",
                                "contents" => $list->contents ?? ""
                            ])
                        </td>
                    </tr>

                    <tr>
                        <th>입금 마감일시</th>
                        <td>
                            <input type="date" class="{{--_vali--}}" {{--data-title="입금 마감일시"--}} name="deadline_date"
                                   value="{{ $list->deadline_date ?? '' }}">
                            <input type="time" class="{{--_vali--}}" {{--data-title="입금 마감일시"--}} name="deadline_time"
                                   value="{{ $list->deadline_time ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <th>은행명</th>
                        <td>
                            <select name="bank_name" id="">
                                @foreach($bank_list as $key => $value)
                                    <option value="{{ $key }}"
                                            class="{{--_vali--}}" {{--data-title="은행명"--}} {{ isset($list) && $list->bank_name == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>예금주</th>
                        <td>
                            <input type="text" class="{{--_vali--}}" {{--data-title="예금주"--}} name="account_holder"
                                   value="{{ $list->account_holder ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <th>계좌번호</th>
                        <td>
                            <input type="text" class="{{--_vali--}}" {{--data-title="계좌번호"--}} name="account_number"
                                   value="{{ $list->account_number ?? '' }}">
                        </td>
                    </tr>

                </table>

                <div class="btn-wrap">
                    @if(isset($list))
                        <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                    @endif

                    <button type="button" data-name="취소" class="btn01 btn_cancel">취소</button>

                    <?php if(session()->get('login_check')) { ?>
                    <button type="button" data-name="{{ isset($list)  ? '수정' : '등록' }}"
                            class="btn01 btn_submit">{{ isset($list)  ? '수정' : '등록' }}</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </section>


@endsection
