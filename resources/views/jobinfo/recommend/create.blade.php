@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 추천 채용
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/jobinfo/recommend/create.js"></script>
    <script defer src="/js/archive.js"></script>
@endpush

@php
    $major_menu = "채용정보";
    $minor_menu = "추천채용";
@endphp

@section("content")

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>{{ $list->recruitment_field }}</h1>
        </div>

        <div class="board-wrap board-create">
            <form
                action="{{ isset($reservation) ? route('jobinfo.recommend.update') : route('jobinfo.recommend.write') }}"
                method="post" name="forms" enctype="multipart/form-data">
                @csrf

                @if(isset($reservation))
                    @method('put')
                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                @endif

                <input type="hidden" name="recommend_id" value="{{ $list->id }}">
                <div class="table02-create table02 create-employment create-recommend first-table">
                    <div class="table-title">
                        <h1>학생정보</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <td rowspan="6" class="td_userPhoto">
                                <div class="recommend-photo">
                                    <div class="img-wrap">
                                        <img
                                            src="{{ isset($reservation->proof_photo) ? '/storage/'.getAttach($reservation->proof_photo)->path : '/img/recommend_empty_img.png' }}"
                                            alt="사용자 사진">
                                    </div>
                                    <div class="btn-photo">
                                        <input type="file" name="proof_photo" id="user-photo" class="file-hidden">
                                        <label for="user-photo"><span>사진 등록/수정</span></label>
                                    </div>
                                </div>
                            </td>
                            <th class="w167">이름</th>
                            <td><p>{{ $user->name }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">생년월일</th>
                            <td><p>{{ $user->year }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">휴대번호</th>
                            <td><p>{{ $user->phone_number }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학번</th>
                            <td><p>{{ $user->account }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">성별</th>
                            <td><p>{{ get_gender_list($user->gender) }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">E-mail</th>
                            <td><p>{{ $user->email }}</p></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="info-note"><p>&#8251; 인적사항이 변동될 경우 마이페이지에서 수정해주시기 바랍니다.</p></div>
                </div>

                <div class="table02-create table02 create-employment">
                    <div class="table-title">
                        <h1>학사정보</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <th class="w167">구분</th>
                            <td><p>{{ $user->type }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학과(부)</th>
                            <td><p>{{ $user->department }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학년</th>
                            <td><p>{{ $user->grade }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">계열/소속</th>
                            <td><p>{{ $user->line }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학적</th>
                            <td><p>{{ $user->academic }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">평균학점</th>
                            <td><p>{{ $user->grade_score }}점</p></td>
                        </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="table02-create table02 table-agree">
                    <div class="table-title">
                        <h1>개인정보 수집 및 이용동의</h1>
                    </div>

                    <table>
                        <colgroup>
                            <col width="100%">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th class="text-subject">개인정보 수집·이용·제공 동의서</th>
                        </tr>
                        <tr>
                            <td>
                                    <span class="text-content">
                                        <p>
                                           1. 개인정보의 수집·이용 목적 : 추천채용 관련 개별 연락 및 확인, 통계자료 활용 <br/>
                                            2. 수집하려는 개인정보의 항목 : 성명, 대학/학부(과), 학번, 연락처 <br/>
                                            3. 개인정보의 보유 및 이용 기간 : 5년 <br/>
                                            4. 동의를 거부할 권리 및 거부에 따른 불이익 : 개인정보 수집·이용을 거부할 수 있으며, 동의를 거부할 경우 서비스이용이 불가함
                                        </p>
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="agree01" id="agree01-01" class="input-checkCircle">
                                <label for="agree01-01">동의합니다.</label>
                                <input type="radio" name="agree01" id="agree01-02" class="input-checkCircle">
                                <label for="agree01-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-subject">개인정보 제3자 제공 동의</th>
                        </tr>
                        <tr>
                            <td>
                                    <span class="text-content">
                                        <p>
                                            1. 개인정보를 제공받는자: 귀하가 신청한 추천전형의 외부 기관<br/>
                                            2. 개인정보를 제공받는자의 이용목적: 평가를 통한 채용 <br/>
                                            3. 개인정보를 제공하는 항목: 성명, 대학/학부(과), 학번, 재학여부, 성별, 학년, 연락처 <br/>
                                            4. 개인정보를 제공받는자의 보유 및 이용기간: 채용 종료시까지<br/>
                                            5. 동의를 거부할 권리 및 거부에 따른 불이익: 개인정보 수집 이용을 거부할 수 있으며, 동의를 거부할 경우 상담접수가 불가능함
                                        </p>
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="radio" name="agree02" id="agree02-01" class="input-checkCircle">
                                <label for="agree02-01">동의합니다.</label>
                                <input type="radio" name="agree02" id="agree02-02" class="input-checkCircle">
                                <label for="agree02-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="board-create table02 employment-question">
                    <div class="table-title">
                        <h1>사전질문</h1>
                    </div>

                    <table class="questions_table">
                        <tbody>

                        <!-- 공인어학성적 -->
                        @if(isset($reservation->question2))
                            <tr>
                                <th class="text-subject">공인어학성적 작성바랍니다. 예) 토익 850, 토익스피킹 150점</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="question2" class="input-question"
                                           value="{{ isset($reservation->question2) ? $reservation->question2 : '' }}">
                                </td>
                            </tr>
                        @endif
                        <!-- end 공인어학성적 -->


                        <!-- 추천채용지원경로 -->
                        <tr>
                            <th class="text-subject">1. 추천채용지원경로 작성바랍니다.</th>
                        </tr>
                        <tr>
                            <td class="support-td">
                                @foreach(get_support_path() as $key => $val)
                                    <input type="radio" name="question6" id="q6-{{ $key }}" value="{{ $key }}"
                                           class="input-checkCircle" {{ isset($reservation->question6) && $reservation->question6 == $key? 'checked' : '' }}>
                                    <label for="q6-{{ $key }}">{{ $val }}</label>
                                @endforeach

                                <input type="text" id="question7" name="question7"
                                       class="input-question {{ isset($reservation->question7) ? '' : 'display_none' }}"
                                       value="{{ isset($reservation->question7) ? $reservation->question7 : '' }}">
                            </td>
                        </tr>
                        <!-- end 추천채용지원경로 -->


                        <!-- 취업동아리여부 -->
                        <tr>
                            <th class="text-subject">2. 취업동아리여부 작성바랍니다.</th>
                        </tr>
                        <tr>
                            <td class="support-td2">
                                <input type="radio" name="question5" id="q5-100" value="100"
                                       class="input-checkCircle" {{ isset($reservation->question5) && $reservation->question5 == 100 ? 'checked' : '' }}>
                                <label for="q5-100">경험 있음</label>
                                <input type="radio" name="question5" id="q5-200" value="200"
                                       class="input-checkCircle" {{ isset($reservation->question5) && $reservation->question5 == 200 ? 'checked' : '' }}>
                                <label for="q5-200">경험 없음</label>


                                <input type="text" id="question9" name="question9"
                                       class="input-question {{ isset($reservation->question9) ? '' : 'display_none' }}"
                                       value="{{ isset($reservation->question9) ? $reservation->question9 : '' }}"
                                       placeholder="동아리명">
                            </td>
                        </tr>
                        <!-- end 취업동아리여부 -->

                        <!-- 졸업일자 -->
                        <tr>
                            <th class="text-subject">3. 졸업일자 작성바랍니다.</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="question1" class="input-question"
                                       value="{{ isset($reservation->question1) ? $reservation->question1 : '' }}">
                            </td>
                        </tr>
                        <!-- end 졸업일자 -->

                        <!-- 연락처 -->
                        <tr>
                            <th class="text-subject">4. 연락처 작성바랍니다. 예) 010-5555-6666</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="question3" class="input-question"
                                       value="{{ isset($reservation->question3) ? $reservation->question3 : '' }}">
                            </td>
                        </tr>
                        <!-- end 연락처 -->

                        <tr>
                            <th class="text-subject">5. E-mail 작성바랍니다. 예) test@naver.com</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="question4" class="input-question"
                                       value="{{ isset($reservation->question4) ? $reservation->question4 : '' }}">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-subject">6. 출신고교 작성바랍니다.</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="question8" class="input-question"
                                       value="{{ isset($reservation->question8) ? $reservation->question8 : '' }}"
                                placeholder="이름(지역)">
                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="table02-create table02 recommend-agree">
                    <div class="table-title">
                        <h1>파일첨부</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <th class="w167">자기소개서</th>
                            <td>
                                <input type="file" id="attachment1" name="attachment1" class="file-hiddens file-hidden"
                                       value="" readonly>
                                <input class="file-name tbl-file w400"
                                       value="{{ isset($reservation->attachment1) ? getAttach($reservation->attachment1)->original_name : '' }}"
                                       placeholder="선택된 파일 없음" readonly>
                                <label for="attachment1" class="btn-file btn01"
                                       onchange="javascript:document.getElementById('attachment1').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                            </td>
                        </tr>

                        <tr>
                            <th class="w167">첨부파일 1</th>
                            <td>
                                <input type="file" id="attachment2" name="attachment2" class="file-hiddens file-hidden"
                                       value="" readonly>
                                <input class="file-name tbl-file w400"
                                       value="{{ isset($reservation->attachment2) ? getAttach($reservation->attachment2)->original_name : '' }}"
                                       placeholder="선택된 파일 없음" readonly>
                                <label for="attachment2" class="btn-file btn01"
                                       onchange="javascript:document.getElementById('attachment2').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                            </td>
                        </tr>

                        <tr>
                            <th class="w167">첨부파일 2</th>
                            <td>
                                <input type="file" id="attachment3" name="attachment3" class="file-hiddens file-hidden"
                                       value="" readonly>
                                <input type="hidden" class="file-hiddens file-hidden"
                                       value="{{ isset($reservation) ? $reservation->attachment3 : '' }}">
                                <input class="file-name tbl-file w400"
                                       value="{{ isset($reservation->attachment3) ? getAttach($reservation->attachment3)->original_name : '' }}"
                                       placeholder="선택된 파일 없음" readonly>
                                <label for="attachment3" class="btn-file btn01"
                                       onchange="javascript:document.getElementById('attachment3').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="btn-wrap">
                    <a href="javascript:history.back()" class="btn-prev btn02">이전으로</a>
                    <button type="button"
                            class="btn-apply btn02" {{ $result['disabled'] }}>{{ $result['msg'] }}</button>
                </div>
            </form>
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection


