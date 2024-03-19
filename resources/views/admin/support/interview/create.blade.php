@extends("layouts.admin")

@section("title")
    동아대 관리자 - 서류합격자 면접교육 신청자 {{ isset($list)? '수정' : '등록' }}
@endsection

@push("scripts")
    <script src="/lib/ckeditor5/build/ckeditor.js"></script>
    <script src="/js/UploadAdaptor.js"></script>
    <script defer src="/js/admin/board.js"></script>
    <script defer src="/js/admin/support/interview/create.js"></script>

@endpush

@php
    use App\Models\Student;
@endphp

@section("content")
    @php
        $category_list = get_interview_category();
        $next_list = get_interview_next_type();
    @endphp

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>서류합격자 면접교육 신청자 {{ isset($list)? '수정' : '등록' }}</h1>
            </div>
        </article> <!-- article list_head end -->

        <div class="table02">
            <form action="/{{ ADMIN_URL }}/support/interview" method="post" name="forms" data-route="/{{ ADMIN_URL }}/support/interview">
                @csrf
                @if (isset($list))
                    @method("put")
                    <input type="hidden" name="id" value="{{ $list->id }}">
                @endif

                <table>
                    <tr>
                        <th>지원기업</th>
                        <td>
                            <input type="text" name="enterprise" class="_vali w300" data-title="지원기업" value="{{ $list->enterprise ?? '' }}" maxlength="100" oninput="maxLengthCheck(this)">
                        </td>
                    </tr>
                    <tr>
                        <th>지원구분</th>
                        <td class="radio_button_wrap">
                            @foreach($category_list as $key => $value)
                                <input type="radio" id="interview_category_{{ $key }}" class="_vail radio_txtbox" value="{{ $key }}" data-title="지원구분"
                                       name="category" {{ isset($list) && $list->category == $key ? 'checked' : '' }}>
                                <label for="interview_category_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>지원사업부</th>
                        <td>
                            <input type="text" name="support_division" class=" w50p" data-title="지원사업부"
                                   value="{{ $list->support_division ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                        </td>
                    </tr>
                    <tr>
                        <th>지원직무</th>
                        <td>
                            <input type="text" name="support_job" class="w50p" data-title="지원직무"
                                   value="{{ $list->support_job ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                        </td>
                    </tr>
                    <tr>
                        <th>다음전형</th>
                        <td class="radio_button_wrap">
                            @foreach($next_list as $key => $value)
                                <input type="radio" id="interview_next_{{ $key }}" class="_vail radio_txtbox" value="{{ $key }}" data-title="다음전형"
                                       name="next_round" {{ isset($list) && $list->next_round == $key ? 'checked' : '' }}>
                                <label for="interview_next_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>다음 전형 일정</th>
                        <td>
                            <input type="date" class="_vali" data-title="다음전형일정" name="next_round_schedule"
                                   value="{{ $list->next_round_schedule ?? '' }}">
                        </td>
                    </tr>
                </table>

                <table class="mgt30">
                    <tr>
                        <th>이름</th>
                        <td>
                            <input type="text" name="name" class="_vali w300" data-title="이름" value="{{ isset($list) ? Student::getStudent($list->user_id)->name : '' }}" {{ isset($list) ? 'readonly' : '' }} maxlength="15" oninput="maxLengthCheck(this)">
                        </td>
                    </tr>
                    <tr>
                        <th>학번</th>
                        <td>
                            <input type="text" name="user_id" class="_vali w300" data-tile="학번" value="{{ $list->user_id ?? '' }}" {{ isset($list) ? 'readonly' : '' }} maxlength="8" oninput="maxLengthCheck(this)">
                            <button type="button" class="btn01 student-confirm">학번확인</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 30px 0">
                            <table id="search_table" class="none">
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="editor-wrap">
                            @include("_include.editor.ckeditor5",  [
                             "editor_name" => "contents",
                             "comment" => false,
                             "image" => true,
                             "path" => "interview",
                             "contents" => $list->contents ?? ""
                         ])
                        </td>
                    </tr>
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

    </section>

@endsection
