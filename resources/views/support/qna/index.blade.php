
@extends("layouts/layout")

@section("title")
    동아대 취업지원실 - qna
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/qna.css">
@endpush

@php
    $major_menu = "취업지원실";
    $minor_menu = "Q&A";
@endphp

@section("content")

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>Q&A</h1>
        </div>

        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <img src="/img/sub1050_toppanner.png" alt="상단배너">
            </div>
            <div class="top_tab">
                <img src="/img/sub1050_toppanner_t.png" alt="">
            </div>
            <div class="top_m" style="background:url(/img/sub1050_toppanner_m.png) no-repeat center / auto 100%;">
                {{--<img src="/img/sub1050_toppanner_m.png" alt="">--}}
            </div>
        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">이용방법</div>
            </div>
            <div class="content_basic_txt_wrap">
                <div class="blue_line_box_wrap">
                    취업지원실 카카오톡 ID : <span class="blue_txt">jobdonga</span>
                </div>
            </div>

            <div class="content_basic_txt_wrap">
                <div class="dot_bullet_tit">
                    운영시간 내 카카오톡 활용 자유로운 Q&A 가능
                </div>
                <div class="gray_bg_box">
                    <p>- 취업준비 관련 간단한 질문(진료 / 취업상담, 자기소개서 첨삭 등은 취업상담 별도 신청)</p>
                    <p>- 취업지원실 프로그래 운영 관련 질문</p>
                    <p>- 신규 프로그램 개설 제안</p>
                    <p>- 기타 취업지원실 이용 시 필요한 내용 등</p>

                </div>
            </div>

            <div class="content_basic_txt_wrap pdt50">
                <div class="dot_bullet_tit">
                    질문양식 : 학과 / 학번 / 이름 필수 기입
                </div>
                <div class="gray_bg_box">
                    <table>
                        <tr>
                            <th>예시1</th>
                            <td>
                                [기계공학과/19***89/박**] <br />
                                2021년 리더스클럽,프론티어즈 선발은 언제하고 선발규모는 어떻게 될까요?
                            </td>
                        </tr>
                        <tr>
                            <th>예시2</th>
                            <td>
                                [경영학과/19***89/김**]<br />
                                취업지원실 스터티룸 예약하는 방법이 궁금한데 어디서 하면 될까요?
                            </td>
                        </tr>
                        <tr>
                            <th>예시3</th>
                            <td>
                                [수학과/19***89/이**] <br />
                                겨울방학 개설 예정인 양성과정은 어떤게 있나요?
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="time_cscenter_wrap">
                    <div class="half_wrap">
                        <div class="time_txt">
                            <p>운영시간</p>
                            <h3>학기 9시 ~ 17시 / 방학 10시 ~ 15시</h3>
                        </div>
                    </div>

                    <div class="half_wrap">
                        <div class="cs_txt">
                            <p>기타문의사항 : 취업지원실</p>
                            <h3 class="blue_txt">200 - 6222 ~ 4</h3>
                        </div>
                    </div>
                </div>


            </div>

        </div>



    </div>

@endsection
