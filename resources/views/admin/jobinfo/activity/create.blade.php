@extends("layouts.admin")

@section("title")
    동아대 관리자 - 각종활동 {{ isset($list)? '수정' : '등록' }}
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
        $gender_list = get_activity_gender_lists();
    @endphp

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>각종활동 {{ isset($list)? '수정' : '등록' }}</h1>
            </div>
        </article> <!-- article list_head end -->

            <div class="table02">
                <h2>회사정보</h2>
                <form action="/{{ ADMIN_URL }}/jobinfo/activity/{{ isset($list) ? '{id}/update' : 'create' }}" method="post" name="forms" data-route="/{{ ADMIN_URL }}/jobinfo/activity" enctype="multipart/form-data">
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
                            <th>주소</th>
                            <td>
                                <input type="text" name="zip_field" id="zip_field" class="w300" value="{{ $list->zip_field ?? '' }}">
                                <button type="submit" class="postal_code_bt" onclick="sample4_execDaumPostcode(); return false">우편번호 찾기</button>
                                <br>
                                <input type="text" name="addr_field1" id="addr_field1" class="w50p" value="{{ $list->addr_field1 ?? '' }}">
                                <input type="text" name="addr_field2" id="addr_field2" class="w50p" value="{{ $list->addr_field2 ?? '' }}" placeholder="상세주소">
                            </td>
                        </tr>
                        <tr>
                            <th>전화번호</th>
                            <td>
                                <input type="text" name="tel_field" class="w50p" value="{{ $list->tel_field ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <th>휴대전화</th>
                            <td>
                                <input type="text" name="phone_field" class="w50p" value="{{ $list->phone_field ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <th>이메일</th>
                            <td class="txt_middle_wrap">
                                <input type="text" name="email_field1" class="w16p" id="email_field1" value="{{ $list->email_field1 ?? '' }}">
                                <span>@</span>
                                <input type="text" name="email_field2" class="w16p" id="email_field2" value="{{ $list->email_field2 ?? '' }}">
                                <select name="email_area" class="w16p" required="" onchange="$('#email_field2').val($(this).val())">
                                    <option value="1" selected>선택하세요</option>
                                    <option value="naver.com">naver.com</option>
                                    <option value="daum.net">daum.net</option>
                                    <option value="hanmail.net">hanmail.net</option>
                                    <option value="gmail.com">gmail.com</option>
                                    <option value="nate.com">nate.com</option>
                                </select>
                            </td>
                        </tr>
                    </table>

                    <h2 class="mgt50">채용정보</h2>

                    <table>
                        <tr>
                            <th>채용분야</th>
                            <td>
                                <input type="text" name="recruitment_field" class="_vali w90p" data-tile="채용분야" value="{{ $list->recruitment_field ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                            <th>모집인원</th>
                            <td class="txt_middle_wrap">
                                <input type="text" name="recruitment_number" class="_vali w90p" data-title="모집인원"  value="{{ $list->recruitment_number ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>근무지역</th>
                            <td>
                                <select name="work_area" class="w90p" required="">
                                    @foreach($area_list as $key => $value)
                                        <option value="{{ $key }}" {{ isset($list) && $list->work_area == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <th>근무기간</th>
                            <td>
                                <input type="text" name="workday_field" class="w90p" value="{{ $list->workday_field ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>성별</th>
                            <td>
                                <select name="gender_field" class="_vali w90p" data-title="성별" required="">
                                    @foreach($gender_list as $key => $value)
                                        <option value="{{ $key }}" {{ isset($list) && $list->gender_field == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <th>나이</th>
                            <td>
                                <input type="text" name="age_field" class="w90p" value="{{ $list->age_field ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>접수방법</th>
                            <td>
                                <input type="text" name="way_field" class="w90p" value="{{ $list->way_field ?? '' }}">
                            </td>
                            <th>접수마감</th>
                            <td>
                                <input type="date" name="receipt_end_date" class="" {{--data-title="접수 마감일"--}} value="{{ $list->receipt_end_date ?? '' }}">
                                <input type="time" name="receipt_end_time" class="" {{--data-title="접수 마감시간"--}} value="{{ $list->receipt_end_time ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <th>급여</th>
                            <td class="txt_middle_wrap">
                                <input type="text" name="pay_field" class="w90p" value="{{ $list->pay_field ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                            <th>URL</th>
                            <td>
                                <input type="text" name="homepage" class="w90p" value="{{ $list->homepage ?? '' }}" placeholder="http://" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>

                        <tr>
                            <td class="editor_wrap" colspan="4">
                                @include("_include.editor.ckeditor5",  [
                                      "editor_name" => "contents",
                                      "comment" => false,
                                      "image" => true,
                                      "path" => "activity",
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

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
    function sample4_execDaumPostcode() {

        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                // if(extraRoadAddr !== ''){
                //     extraRoadAddr = ' (' + extraRoadAddr + ')';
                // }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('zip_field').value = data.zonecode;
                document.getElementById("addr_field1").value = roadAddr;
                // document.getElementById("sample4_jibunAddress").value = data.jibunAddress;

                // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                // if(roadAddr !== ''){
                //     document.getElementById("sample4_extraAddress").value = extraRoadAddr;
                // } else {
                //     document.getElementById("sample4_extraAddress").value = '';
                // }
                //
                // var guideTextBox = document.getElementById("guide");
                // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                // if(data.autoRoadAddress) {
                //     var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                //     guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
                //     guideTextBox.style.display = 'block';
                //
                // } else if(data.autoJibunAddress) {
                //     var expJibunAddr = data.autoJibunAddress;
                //     guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
                //     guideTextBox.style.display = 'block';
                // } else {
                //     guideTextBox.innerHTML = '';
                //     guideTextBox.style.display = 'none';
                // }
            }
        }).open();
    }
</script>
