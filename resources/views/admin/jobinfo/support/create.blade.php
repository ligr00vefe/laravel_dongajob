@extends("layouts.admin")

@section("title")
    동아대 관리자 - 추천채용 관리
@endsection

@push("scripts")
    <script defer src="/js/admin/board.js"></script>
@endpush

@section("content")
    @php
        $category_list = get_notice_category();
    @endphp

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>추천채용 지원자 관리</h1>
            </div>

            <div class="table02">
                <form action="/superviser/jobinfo/support" method="post" name="forms"
                      data-route="/superviser/jobinfo/support" enctype="multipart/form-data">
                    @csrf
                    @if (isset($list))
                        @method("put")
                        <input type="hidden" name="id" value="{{ $list->id }}">
                        <input type="hidden" name="hit" value="{{ $list->hit ?? '0' }}">
                    @else
                        <input type="hidden" name="hit" value="0">
                    @endif

                    <input type="hidden" name="recommend_id" value="{{ $list->id }}">
                    <table>
                        <tr>
                            <th>신청일</th>
                            <td>
                                {{ date('Y-m-d', strtotime($reservation->created_at)) }}
                            </td>
                        </tr>
                        <tr>
                            <th>채용명</th>
                            <td>
                                {{ $list->recruitment_field }}
                            </td>
                        </tr>
                    </table>

                    <h2 class="mgt30">학생정보</h2>

                    <table>
                        <tr>
                            <th rowspan="6" class="id_photo_wrap">
                                <div class="id_photo">
                                    <img
                                        src="{{ isset($reservation->proof_photo) ? '/storage/'.getAttach($reservation->proof_photo)->path : '/img/recommend_empty_img.png' }}"
                                        alt="사용자 사진" style="width: 100%;height: 100%;">
                                </div>
                            </th>
                            <th>성명</th>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>생년월일</th>
                            <td>
                                {{ $user->year }}
                            </td>
                        </tr>
                        <tr>
                            <th>휴대번호</th>
                            <td>
                                {{ $user->phone_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>학번</th>
                            <td>
                                {{ $user->account }}
                            </td>
                        </tr>
                        <tr>
                            <th>성별</th>
                            <td>
                                {{ get_gender_list($user->gender) }}
                            </td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                    </table>


                    <h2 class="mgt30">학사정보</h2>

                    <table>
                        <tr>
                            <th>구분</th>
                            <td>
                                {{ $user->type }}
                            </td>
                        </tr>
                        <tr>
                            <th>학과(부)</th>
                            <td>
                                {{ $user->department }}
                            </td>
                        </tr>
                        <tr>
                            <th>학년</th>
                            <td>
                                {{ $user->grade }}
                            </td>
                        </tr>
                        <tr>
                            <th>계열/소속</th>
                            <td>
                                {{ $user->line }}
                            </td>
                        </tr>
                        <tr>
                            <th>학적</th>
                            <td>
                                {{ $user->academic }}
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <th>평균학점</th>
                            <td>
                                {{ $user->grade_score }}
                            </td>
                        </tr>
                    </table>


                    <h2 class="mgt30">개인정보 수집 및 이용동의</h2>

                    <table>
                        <tr>
                            <th>개인정보 수집·이용·제공 동의서</th>
                            <td>
                                동의
                            </td>
                        </tr>
                        <tr>
                            <th>개인정보 제3자 제공 동의</th>
                            <td>
                                동의
                            </td>
                        </tr>
                    </table>

                    <h2 class="mgt30">사전질문</h2>

                    <table>

                        <!-- 추천채용지원경로 -->
                        <tr>
                            <th>1. 추천채용지원경로 작성바랍니다.</th>
                        </tr>
                        <tr>
                            <td class="radio_button_wrap">
                                @foreach(get_support_path() as $key => $val)
                                    <input type="radio" id="q6-{{ $key }}" class="radio_txtbox" name="question6"
                                           {{ $reservation->question6 == $key ? 'checked' : '' }} readonly>
                                    <label class="radio_button_txt" for="q6-{{ $key }}"><span>{{ $val }}</span></label>
                                @endforeach

                                <input type="text" name="question7" class="_vali w50p"
                                       value="{{ $reservation->question7 ?? '' }}"
                                    readonly>

                            </td>
                        </tr>
                        <!-- end 추천채용지원경로 -->


                        <!-- 취업동아리여부 -->
                        <tr>
                            <th>2. 취업동아리여부 작성바랍니다.</th>
                        </tr>
                        <tr>
                            <td class="radio_button_wrap">
                                <input type="radio" name="question5" id="q5-100" value="100"
                                       class="radio_txtbox" {{ isset($reservation->question5) && $reservation->question5 == 100 ? 'checked' : '' }}>
                                <label for="q5-100" class="radio_button_txt">경험 있음</label>
                                <input type="radio" name="question5" id="q5-200" value="200"
                                       class="radio_txtbox" {{ isset($reservation->question5) && $reservation->question5 == 200 ? 'checked' : '' }}>
                                <label for="q5-200" class="radio_button_txt">경험 없음</label>

                                <br>

                                <input type="text" id="question9" name="question9"
                                       class="w50p"
                                       value="{{ $reservation->question9 ?? ''  }}"
                                       placeholder="동아리명"
                                       readonly>
                            </td>
                        </tr>
                        <!-- end 취업동아리여부 -->

                        <tr>
                            <th>3. 졸업(예정)일자 작성바랍니다. 예) 2021. 3.</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="question1" class="_vali w50p"
                                       data-tile="1. 졸업(예정)일자 작성바랍니다. 예) 2021. 3."
                                       value="{{ $reservation->question1 ?? '' }}"
                                       readonly>
                            </td>
                        </tr>

                        <tr>
                            <th>4. 연락처 작성바랍니다. 예) 010-5555-6666</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="question3" class="_vali w50p"
                                       data-tile="3. 연락처 작성바랍니다. 예) 010-5555-6666"
                                       value="{{ $reservation->question3 ?? '' }}"
                                       readonly>
                            </td>
                        </tr>

                        <tr>
                            <th>5. E-mail 작성바랍니다. 예) job.donga.ac.kr</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="question3" class="_vali w50p"
                                       data-tile="4. E-mail 작성바랍니다. 예) job.donga.ac.kr"
                                       value="{{ $reservation->question4 ?? '' }}"
                                       readonly>
                            </td>
                        </tr>


                        <tr>
                            <th>6. 출신고교 작성바랍니다.</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="question8" class="_vali w50p"
                                       value="{{ $reservation->question8 ?? '' }}"
                                       readonly>
                            </td>
                        </tr>


                        @if($reservation->question2)
                            <tr>
                                <th>5. 공인어학성적 작성바랍니다. 예) 토익 850, 토익스피킹 150점</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="question2" class="_vali w50p"
                                           data-tile="2. 공인어학성적 작성바랍니다. 예) 토익 850, 토익스피킹 150점"
                                           value="{{ $reservation->question2 ?? '' }}"
                                           readonly>
                                </td>
                            </tr>
                        @endif


                    </table>


                    <h2 class="mgt30">첨부파일</h2>
                    <table>
                        @for($i = 1; $i <= 3; $i++)
                            @php
                                $property = 'attachment'.$i;

                                if(!$reservation->$property)
                                    continue;

                                $title = '자기소개';
                                if($i > 1)
                                    $title = '첨부파일'.$i;
                            @endphp
                            <tr>
                                <th>{{ $title }}</th>
                                <td>
                                    <input type="file" id="attachment{{ $i }}" name="attachment{{ $i }}"
                                           class="file-hidden" value="" readonly>
                                    <label for="attachment{{ $i }}" class="btn-file btn01"
                                           onchange="javascript:document.getElementById('attachment{{ $i }}').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                                    <span class="file-exist">
                                        <a href="{{ asset('/storage/'. getAttach($reservation->$property)->path) }}"
                                           download>{{ getAttach($reservation->$property)->original_name }}</a>
                                    </span>
                                </td>
                            </tr>
                        @endfor
                    </table>

                    <div class="btn-wrap">
                        @if(isset($list))
                            <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                        @endif
                        <button type="button" data-name="취소" class="btn01 btn_submit"
                                onclick="location.href='/{{ ADMIN_URL }}/jobinfo/support/'">목록
                        </button>

                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->
    </section>

@endsection
