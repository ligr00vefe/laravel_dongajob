
@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 주요 일정
@endsection

@push('scripts')
    <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>
    <script defer src="/js/archive.js"></script>
@endpush

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "주요일정";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>주요일정</h1>
        </div>

        <div class="board-wrap board-create">
            <form action="{{ route('program.receipt.write') }}" method="post" enctype="multipart/form-data">
                @csrf
{{--                @if(isset($edit))--}}
{{--                    @method("put")--}}
{{--                    <input type="hidden" name="id" value="{{ $list->id ?? "" }}">--}}
{{--                @endif--}}
                <div class="table02-create table02 table-receipt first-table">
                    <div class="table-title">
                        <h1>신청정보</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <th class="w167">이름</th>
                            <td><p>{{ $list->lecture_title }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">대학</th>
                            <td><p>{{ $list->reception_status }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학부(과)</th>
                            <td><p>{{ $list->instructor_name }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학년</th>
                            <td><p>{{ $list->reception_datetime }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학번</th>
                            <td><p>{{ $list->lecture_datetime }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학적</th>
                            <td><p>{{ $list->location }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">이메일</th>
                            <td><p>{{ $list->enrolled_count }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">휴대폰</th>
                            <td><p>{{ $list->edu_target }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">전화번호</th>
                            <td><p>{{ $list->target_grade }}</p></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table02-create table02 receipt-agree">
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
                                       1. 개인정보의 수집·이용 목적 : 스터디룸예약 관련 개별 연락 및 확인, 통계자료 활용 <br/>
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
                                <label for="agree01-01">상기인은 개인정보수집동의서에 동의합니다.</label>
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
                                <label for="agree02-01">상기인은 개인정보수집동의서에 동의합니다.</label>
                                <input type="radio" name="agree02" id="agree02-02" class="input-checkCircle">
                                <label for="agree02-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="btn-wrap create-btn">
                    <a href="/program/receipt" class="btn-cancel btn02">취소</a>
                    <button class="btn-register btn02">강좌신청</button>
                </div>
            </form>
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
