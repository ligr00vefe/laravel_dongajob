
@extends("layouts.layout")

@section("title")
    동아대 마이페이지 - 추천채용 지원내역
@endsection

@push('scripts')
    <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>
    <script>
        $(document).ready(function() {
            var fileTarget = $('.file-hidden');
            fileTarget.on('change', function () { // 값이 변경되면
                if (window.FileReader) { // modern browser
                    var filename = $(this)[0].files[0].name;
                } else { // old IE
                    var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
                } // 추출한 파일명 삽입
                // console.log(filename);
                $(this).siblings('.file-name').val(filename);
            });

            $('.tbl-file').on('click', function () {
                $(this).siblings('.file-hidden').click();
            });
        });
    </script>
@endpush

@php
    $major_menu = "My Page";
    $minor_menu = "추천채용 지원내역";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>[추천] 영업관리(거래처 관리)</h1>
        </div>

        <div class="board-wrap board-create">
            <form action="{{ route('mypage.recommend.write') }}" method="post" enctype="multipart/form-data">
                @csrf
{{--                @if(isset($edit))--}}
{{--                    @method("put")--}}
{{--                    <input type="hidden" name="id" value="{{ $list->id ?? "" }}">--}}
{{--                @endif--}}
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
                                        <img src="" alt="사용자 사진">
                                    </div>
                                    <div class="btn-photo">
                                        <input type="file" name="user-photo" id="user-photo" class="file-hidden">
                                        <label for="user-photo"><span>사진 등록/수정</span></label>
                                    </div>
                                </div>
                            </td>
                            <th class="w167">이름</th>
                            <td><p>김동아</p></td>
                        </tr>
                        <tr>
                            <th class="w167">생년월일</th>
                            <td><p>1990년 03월 14일</p></td>
                        </tr>
                        <tr>
                            <th class="w167">휴대번호</th>
                            <td><p>01012345678</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학번</th>
                            <td><p>2010365972</p></td>
                        </tr>
                        <tr>
                            <th class="w167">성별</th>
                            <td><p>여자</p></td>
                        </tr>
                        <tr>
                            <th class="w167">E-mail</th>
                            <td><p>abcde@naver.com</p></td>
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
                                <td><p>학사</p></td>
                            </tr>
                            <tr>
                                <th class="w167">학과(부)</th>
                                <td><p>경영학과</p></td>
                            </tr>
                            <tr>
                                <th class="w167">학년</th>
                                <td><p>4</p></td>
                            </tr>
                            <tr>
                                <th class="w167">계열/소속</th>
                                <td><p>경영대학</p></td>
                            </tr>
                            <tr>
                                <th class="w167">학적</th>
                                <td><p>재학</p></td>
                            </tr>
                            <tr>
                                <th class="w167">평균학점</th>
                                <td><p>3.5</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="table02-create table02 recommend-agree">
                    <div class="table-title">
                        <h1>개인정보 수집 및 이용동의</h1>
                    </div>

                    <table>
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
                                    <input type="checkbox" name="recommend-agree02" id="recommend-agree02" class="input-checkCircle">
                                    <label for="recommend-agree02">상기인은 개인정보수집동의서에 동의합니다.</label>
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
                                    <input type="checkbox" name="recommend-agree02" id="recommend-agree02" class="input-checkCircle">
                                    <label for="recommend-agree02">상기인은 개인정보수집동의서에 동의합니다.</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="board-create table02 employment-question">
                    <div class="table-title">
                        <h1>사전질문</h1>
                    </div>

                    <table>
                        <tbody>
                            <tr>
                                <th class="text-subject">1. 졸업(예정)일자 작성바랍니다. 예) 2021. 3.</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="recommend-question01" class="input-question">
                                </td>
                            </tr>

                            <tr>
                                <th class="text-subject">2. 공인어학성적 작성바랍니다. 예) 토익 850, 토익스피킹 150점</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="recommend-question02" class="input-question">
                                </td>
                            </tr>

                            <tr>
                                <th class="text-subject">3. 연락처 작성바랍니다. 예) 010-5555-6666</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="recommend-question03" class="input-question">
                                </td>
                            </tr>

                            <tr>
                                <th class="text-subject">4. E-mail 작성바랍니다. 예) job.donga.ac.kr</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="recommend-question04" class="input-question">
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
                                    <input type="file" id="attachment1" name="attachment1" class="file-hidden" readonly>
                                    <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" readonly>
                                    <label for="attachment1" class="btn-file btn01" onchange="javascript:document.getElementById('attachment1').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>

                                </td>
                            </tr>

                            <tr>
                                <th class="w167">첨부파일 1</th>
                                <td>
                                    <input type="file" id="attachment2" name="attachment2" class="file-hidden" readonly>
                                    <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" readonly>
                                    <label for="attachment2" class="btn-file btn01" onchange="javascript:document.getElementById('attachment2').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>

                                </td>
                            </tr>

                            <tr>
                                <th class="w167">첨부파일 2</th>
                                <td>
                                    <input type="file" id="attachment3" name="attachment3" class="file-hidden" readonly>
                                    <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" readonly>
                                    <label for="attachment3" class="btn-file btn01" onchange="javascript:document.getElementById('attachment3').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="btn-wrap">
                    <a href="/mypage/recommend" class="btn-prev btn02">이전으로</a>
                    <button class="btn-apply btn02">지원하기</button>
                </div>
            </form>
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
