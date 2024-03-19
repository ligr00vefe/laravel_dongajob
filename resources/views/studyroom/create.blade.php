@extends("layouts/layout")

@section("title")
    동아대 스터디룸 예약
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/studyroom.css">
    <script defer src="/js/studyroom/create.js"></script>
@endpush

@php
    $major_menu = "스터디룸 예약";
    $minor_menu = "스터디룸 예약";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>스터디룸 예약</h1>
        </div>

        <div class="body-wrap studyroom-form">
            <form action="/studyroom" name="forms" method="post">
                @csrf
                <input type="hidden" name="target_type" value="{{ get_manager_type_value(session()->get('donga_type')) }}">
                <input type="hidden" name="room_id" value="{{ $list->room_id }}">
                <input type="hidden" name="campus_id" value="{{ $list->campus_id }}">
                <input type="hidden" name="campus_name" value="{{ get_campus_name($list->campus_id) }}">
                <input type="hidden" name="study_room_name" value="{{ $list->name }}">
                <input type="hidden" name="location" value="{{ $list->location }}">
                <input type="hidden" name="office_equipment" value="{{ $list->office_equipment }}">
                <input type="hidden" name="max_personnel" value="{{ $list->max_personnel }}">
                <input type="hidden" name="min_personnel" value="{{ $list->min_personnel }}">
                <input type="hidden" name="reservation_date_info" value="{{ $list->date. ' '.get_time_range($list->times) }}">
                <input type="hidden" name="date" value="{{ $list->date }}">
                @foreach($list->times as $val)
                    <input type="hidden" name="time[]" value="{{ $val }}">
                @endforeach

                <div class="studyroom-table table02">
                    <div class="table-title">
                        <h1>스터디룸 정보</h1>
                    </div>
                    <table>
                        <tbody>
                        <tr>
                            <th class="w167">캠퍼스</th>
                            <td><p>{{ get_campus_name($list->campus_id) }} 캠퍼스</p></td>
                        </tr>
                        <tr>
                            <th class="w167">스터디룸</th>
                            <td><p>{{ $list->name }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">장소</th>
                            <td><p>{{ $list->location }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">수용인원</th>
                            <td>
                                <p>{{ $list->max_personnel }}명</p>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">사무기기</th>
                            <td><p>{{ $list->office_equipment }}</p></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="studyroom-table table02">
                    <div class="table-title">
                        <h1>기본 정보</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <th class="w167">이름</th>
                            <td><input type="text" name="name" class="w300" value="{{ $list->student_name }}" maxlength="15" readonly></td>
                        </tr>
                        <tr>
                            <th class="w167">학번</th>
                            <td><input type="text" name="account" class="w300" value="{{ $list->account }}" maxlength="15"  readonly></td>
                        </tr>
                        <tr>
                            <th class="w167">신청일</th>
                            <td><span>{{ date('Y-m-d') }}</span></td>
                        </tr>
                        <tr>
                            <th class="w167">예약일시</th>
                            <td><span>{{ $list->date. ' '.get_time_range($list->times) }}</span></td>
                        </tr>
                        <tr>
                            <th class="w167">사용인원</th>
                            <td><input type="text" name="use_people" class="w300" maxlength="255" oninput="maxLengthCheck(this)"></td>
                        </tr>
                        <tr>
                            <th class="w167">사용목적</th>
                            <td><textarea name="use_purpose" id="" cols="30" rows="10" class="w683"></textarea></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="studyroom-table table02">
                    <div class="table-title">
                        <h1>동반 사용자</h1>
                    </div>

                    <table class="companion_table">
                        <tbody>
                        <tr>
                            <th class="w167">학번</th>
                            <td>
                                <input type="text" class="search_account w300 input-add" maxlength="8">
                                <button type="button" class="btn02 btn-add">추가</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="studyroom-table table02">
                    <div class="table-title">
                        <h1>스터디룸 유의사항</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <th colspan="2" class="text-subject">예약시 유의사항</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span class="text-content">
                                    <p>
                                        1. 스튜디오는 당일부터 1주일 후까지만 예약가능 <br/>
                                        2. 스튜디오는 1주일 2회 대여를 원칙으로 하며 사용시간은 최대 3시간까지 사용가능<br/>
                                        3. 신청 후 무단 미사용(NO-SHOW) 3회시, 1개월간 사용불가<br/>
                                        - 불가피한 상황으로 사용이 불가할 경우, 마이페이지에서 반드시 취소하기 바람<br/>
                                        4. 사용일에 취업지원실을 방문하여 증빙서류 제출 후 이용(실제 기업면접 대상자 확인용)<br.>
                                        5. 주말 및 공휴일을 포함한 학교 휴무일 사용불가
                                    </p>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-subject">사용시 유의사항</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span class="text-content">
                                    <p>
                                       1. 안정 밑 도난 방지를 위한 24시간 CCTV 작동중<br>
                                        2. 물(생수)를 제외한 일체의 음식물 반입금지<br>
                                        3. 컴퓨터 내 무단 소프트웨어 및 파일 설치 금지<br>
                                        4. 퇴실시 문단속 및 뒷정리 철저
                                    </p>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="radio" name="agree01" id="agree01-01" data-title="유의사항" class="_vali studyroom-checkCircle">
                                <label for="agree01-01">
                                    위 스터디룸 유의사항을 숙지하고 <wbr>예약신청을 합니다.
                                </label>
                                <input type="radio" name="agree01" id="agree01-02" data-title="유의사항" class="_vali studyroom-checkCircle">
                                <label for="agree01-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="studyroom-table table02">
                    <div class="table-title">
                        <h1>개인정보 수집 및 이용동의</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <th colspan="2" class="text-subject">개인정보 수집·이용·제공 동의서</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span class="text-content">
                                    <p>
                                       1. 개인정보의 수집·이용 목적 : 스터디룸예약 관련 개별 연락 및 확인, 통계자료 활용 <br/>
                                        2. 수집하려는 개인정보의 항목 : 성명, 대학/학부(과), 학번, 연락처 <br/>
                                        3. 개인정보의 보유 및 이용 기간 : 5년 <br/>
                                        4. 동의를 거부할 권리 및 거부에 따른 불이익 : 개인정보 수집·이용을 거부할 수 있으며, 동의를 거부할 경우 스터디룸예약이 불가함
                                    </p>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="radio" name="agree02" id="agree02-01"
                                       data-title="개인정보수집동의서 동의" class="_vali studyroom-checkCircle">
                                <label for="agree02-01">상기인은 개인정보수집동의서에 동의합니다.</label>
                                <input type="radio" name="agree02" id="agree02-02"
                                       data-title="개인정보수집동의서 동의" class="_vali studyroom-checkCircle">
                                <label for="agree02-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="btn-wrap">
                    <a href="/studyroom" class="btn01 btn-cancel">취소</a>
                    <button type="button" class="btn01 btn-save">다음</button>
                </div>
            </form>
        </div>


    </div>{{-- //.sub-content end --}}

@endsection
