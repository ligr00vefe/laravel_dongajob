
@extends("layouts.layout")

@section("title")
    동아대 온라인 취업컨텐츠 - 토익 토익스피킹 할인접수
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/toeic.css">
@endpush

@php
    $major_menu = "온라인 취업컨텐츠";
    $minor_menu = "토익 토익스피킹 할인접수";
@endphp

@section("content")

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>토익 / 토익스피킹 할인접수</h1>
        </div>

        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>TOEIC/TOEIC SPEAKING 정기시험 응시료 할인</h2>
                <p>한국토익위원회와의 협약체결을 통하여 TOEIC／TOEIC SPEAKING 정기시험</p>
                <p>응시료 할인혜택을 동아대학교 학생들에게 제공합니다.</p>
            </div>
            <div class="top_tab">
                <h2>TOEIC/TOEIC SPEAKING 정기시험 응시료 할인</h2>
                <p>한국토익위원회와의 협약체결을 통하여 TOEIC／TOEIC SPEAKING 정기시험
                    응시료 할인혜택을 동아대학교 학생들에게 제공합니다.</p>
            </div>
            <div class="top_m">
                <h2>TOEIC/TOEIC SPEAKING 정기시험 응시료 할인</h2>
                <p>한국토익위원회와의 협약체결을 통하여 TOEIC／TOEIC SPEAKING 정기시험
                    응시료 할인혜택을 동아대학교 학생들에게 제공합니다.</p>
            </div>
        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">개요</div>
            </div>
            <div class="content_table scroll_table_box pdt30">
                <table class="top_gray_table">
                    <tr>
                        <th class="wd15">대상</th>
                        <th colspan="2">강의 시간</th>
                    </tr>
                    <tr>
                        <td class="centertxt" rowspan="2">본교 재·휴학생</td>
                        <td class="centertxt ">TOEIC</td>
                        <td class=" noneright ">매달 추가접수기간 접수비 할인 (52,800원 ▶ 48,000원)</td>
                    </tr>
                    <tr>
                        <td class="centertxt ">TOEIC Speaking</td>
                        <td class=" noneright">응시료 10%할인(77,000원 ▶ 70,000원)</td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">기타사항</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p class="dot_bullet_wrap">접수 시 학번입력을 통해 본교 학생임을 확인하며, 기타 접수 및 결재방법 등은 동일함</p>
                <p class="dot_bullet_wrap">한국토익위원회에서 실시하는 정기시험이며, 할인혜택이 적용되는 것 외에 차이가 없음</p>
                <p class="dot_bullet_wrap">본 할인혜택은 한국토익위원회와 협약이 종료되기 전까지 상시 이용가능</p>
            </div>

            <div class="personal_info_wrap pdt30">
                <div class="blue_txt">개인정보 수집 · 이용 제공 동의서</div>
                <div class="gray_bg_wrap">
                    <p>1. 개인정보 수집 · 이용 목적 : 토익, 토익스피킹 할인 접수 관련 개별 연락 및 확인 통계자료 활용</p>
                    <p>2. 개인정보 수집 항목 : 성멸, 대학 / 학부(과) 학번, 재학여부, 성별, 학년, 연락처</p>
                    <p>3. 개인정보 보유 및 이용기간 : 5년</p>
                    <p>4. 동의를 거부할 권리 및 거부에 따른 불이익 : 개인정보 수집 이용을 거부할 수 있으며, 동의를 거부할 경우 할인 접수가 불가능</p>
                </div>
                <div class="personal_info_check01">
                    <input type="radio" name="agree1" id="agree1-1" class="agree_chk">
                    <label for="agree1-1">
                        <span>상기인은 개인정보수집 동의서에 동의합니다.</span>
                    </label>
                    <input type="radio" name="agree1" id="agree1-2" class="agree_chk">
                    <label for="agree1-2">
                        <span>동의하지 않습니다.</span>
                    </label>
                </div>
            </div>

            <div class="personal_info_wrap pdt30">
                <div class="blue_txt">개인정보 제 3자 제공 동의</div>
                <div class="gray_bg_wrap">
                    <p>1. 개인정보를 제공받는자 : 귀하가 신청한 프로그램의 외부기관</p>
                    <p>2. 개인정보를 제공받는자의 이용목적 : 토익, 토익스피킹 할인적용</p>
                    <p>3. 개인정보를 제공하는 항목 : 성명, 대학/학부(과). 학번, 재학여부, 성별, 학년, 연락처</p>
                    <p>4. 개인정보를 제공받는자의 보유 및 이용기간 : 할인 접수 적용 후 1년</p>
                    <p>5. 동의를 거부할 권리 및 거부에 따른 불이익: 개인정보 수집 이용을 거부할 수 있으며, 동의를 거부할 경우 상담접수가 불가능함</p>
                </div>
                <div class="personal_info_check01">
                    <input type="radio" name="agree2" id="agree2-1" class="agree_chk">
                    <label for="agree2-1">
                        <span>상기인은 개인정보수집 동의서에 동의합니다.</span>
                    </label>

                    <input type="radio" name="agree2" id="agree2-2" class="agree_chk">
                    <label for="agree2-2">
                        <span>동의하지 않습니다.</span>
                    </label>
                </div>
            </div>


            <form name="theFrom" id="theFrom" method="post" target="_blank">
                <input type="hidden" name="step" value="2">
            </form>

            <div class="register_button_wrap">
                <button class="blue_bg_button btn-send" data-num="1">TOEIC SPEAKING <wbr> 할인 접수</button>
                <button class="blue_line_button btn-send" data-num="2">TOEIC <wbr> 할인 접수</button>
            </div>

        </div>

    </div>
    <script>

        $('.btn-send').off().on('click', function(e){
            var loginCheck = '{{ session()->get('login_check') }}';
            console.log('loginCheck: ', loginCheck);

            if(loginCheck) {
                    if ($('#agree1-1').prop('checked') && $('#agree2-1').prop('checked')) {
                        var num = $(this).data('num');
                        var actionUrl = "";
                        // console.log('num:', num);
                        if (num == "1") {
                            actionUrl = "http://appexam.ybmsisa.com/toeicswt/applink.asp?exam_type=toeicswt&com_type=dongauniv";
                        } else {
                            actionUrl = "http://appexam.ybmsisa.com/appexamlink.asp?examtype=toeic&comtype=dongaunivn";
                        }
                        // console.log('actionUrl:', actionUrl);

                        window.open(actionUrl);
                    } else {
                        alert("개인정보제공에 모두 동의 하셔야 접수가 가능합니다.");
                        $('#agree01-1').focus();
                        return;
                    }
            }else {
                var loginYes = confirm('로그인 후 이용 가능합니다. 로그인 페이지로 이동하시겠습니까?');

                if(loginYes) {
                    location.href="/login";
                }
            }
        });
    </script>
@endsection


