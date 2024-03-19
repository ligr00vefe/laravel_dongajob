@extends("layouts/layout")

@section("title")
    정보수정
@endsection

@push('scripts')
@endpush

@section("content")
    <div class="member-content">
        <h3>회원정보</h3>

        <form action="">
            <table class="table02">
                <tbody>
                <tr>
                    <th>아이디</th>
                    <td>test10</td>
                    <th>비밀번호</th>
                    <td><input type="text" class="input"></td>
                </tr>

                <tr>
                    <th>담당자명</th>
                    <td><input type="text" class="input"></td>
                    <th>업체명</th>
                    <td><input type="text" class="input"></td>
                </tr>

                <tr>
                    <th>사업자등록번호</th>
                    <td><input type="text" class="input"></td>
                    <th>사업자등록증</th>
                    <td><input type="file" class="input">
                        <button class="btn01">파일선택</button>
                        <div class="file-info">
                            <input id="file-name" type="checkbox"> <label for="file-name" class="file-name">바램인터렉티브_사업자등록증.pdf(53.7M)
                                파일 삭제</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>연락처</th>
                    <td>
                        <input type="text" class="input w80"><span class="hipen">-</span>
                        <input type="text" class="input w80"><span class="hipen">-</span>
                        <input type="text" class="input w80">
                    </td>
                    <th>휴대전화</th>

                    <td>
                        <input type="text" class="input w80"><span class="hipen">-</span>
                        <input type="text" class="input w80"><span class="hipen">-</span>
                        <input type="text" class="input w80">
                    </td>
                </tr>

                <tr>
                    <th>이메일</th>
                    <td colspan="3">
                        <input type="text" class="input w150"><span class="hipen">@</span>
                        <input type="text" class="input w150">
                        <select name="" id="" class="w150">
                            <option value="">naver.com</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>업체주소</th>
                    <td colspan="3">
                        <input type="text" id="sample6_postcode" class="input w100p" placeholder="우편번호">
                        <input type="button" class="w100 btn01" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                        <input type="text" class="input w500" id="sample6_address" placeholder="주소"><br>
                        <input type="text" id="sample6_detailAddress" class="input w500" placeholder="상세주소">
                    </td>
                </tr>

                </tbody>
            </table>

            <div class="confirm-box">
                <button type="button" class="" onclick="location.href='/confirm'">취소</button>
                <button type="button">확인</button>
            </div>
        </form>
    </div>

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        function sample6_execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        //document.getElementById("sample6_extraAddress").value = extraAddr;

                    } else {
                        //document.getElementById("sample6_extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('sample6_postcode').value = data.zonecode;
                    document.getElementById("sample6_address").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById("sample6_detailAddress").focus();
                }
            }).open();
        }
    </script>
@endsection
