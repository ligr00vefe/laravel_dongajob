
@extends("layouts.layout")

@section("title")
    동아대 마이페이지 - 서류합격자 면접교육 접수
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@php
    $major_menu = "My Page";
    $minor_menu = "서류합격자 면접교육 접수";

@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>서류합격자 면접교육 접수</h1>
        </div>

        <div class="board-wrap board-list">
         {{--   <div class="search-box">
                <select name="search-cate" id="search-cate">
                    <option value="sch-all">전체</option>
                    <option value="sch-subject">강좌명</option>
                    <option value="sch-name">수강장소</option>
                </select>
                <input type="text" value="" class="input-search">
                <button class="btn-search">검색</button>
            </div>--}}

        <!------ 테이블 시작 ------>
            <div class="list-warp table01 table-interview list-interview">
                <form action="" method="post" name="memberUpdate">
                @csrf
                @method("put")

                <!------ pc버전 시작 ------>
                    <table class="member-list in-input table-2x-large">
                        <colgroup>
                            <col class="visible-pc" width="8%">
                            <col width="10%">
                            <col width="17%">
                            <col width="10%">
                            <col class="visible-pc" width="25%">
                            <col class="visible-pc" width="30%">
                            <col class="visible-tablet" width="20%">
                            <col class="col_datetime" width="10%">
                            <col class="visible-mobile" width="80%">
                            <col class="visible-all col_pass" width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="visible-pc">번호</th>
                                <th>다음전형</th>
                                <th>지원기업</th>
                                <th>구분</th>
                                <th class="visible-pc">지원사업부</th>
                                <th class="visible-pc">지원직무</th>
                                <th class="visible-tablet">지원사업부·지원직무</th>
                                <th>다음전형 일정</th>
                                <th class="visible-mobile">접수내역</th>
                                <th class="th_pass visible-all">합격여부</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($lists as $list)
                            <tr class="tr_info">
                                <td class="td_num visible-pc">{{ $list->id }}</td>
                                <td class="td_nextRound"><p>{{ get_interview_next_type($list->next_round) }}</p></td>
                                <td class="td_enterprise">
                                   <p>{{ $list->enterprise }}</p>
                                </td>
                                <td class="td_category">
                                    <p>{{ get_interview_category($list->category) }}</p>
                                </td>
                                <td class="td_supportDivision visible-pc">
                                    <p>{{ $list->support_division }}</p>
                                </td>

                                <td class="td_supportJob visible-pc">
                                    <p>{{ $list->support_job }}</p>
                                </td>

                                <td class="td_supportSummary visible-tablet">
                                    <span>
                                        <p>지원사업부 : {{ $list->support_division }}</p>
                                        <p>지원직무 : {{ $list->support_job }}</p>
                                    </span>
                                </td>

                                <td class="td_nextRoundSchedule">
                                    <p>{{ date('y-m-d', strtotime($list->created_at)) }}</p>
                                </td>

                                <td class="td_mobileSummary visible-mobile">
                                     <span>
                                        <p><b>다음전형 : </b>{{ $list->next_round }}</p>
                                        <p><b>지원기업 : </b>{{ $list->enterprise }}</p>
                                        <p><b>지원구분 : </b>{{ get_interview_category($list->category) }}</p>
                                        <p><b>지원사업부 : </b>{{ $list->support_division }}</p>
                                        <p><b>지원직무 : </b>{{ $list->support_job }}</p>
                                        <p><b>다음전형일정 : </b>{{ $list->next_round_schedule }}</p>
                                    </span>
                                </td>

                                <td class="td_pass visible-all">
                                    @if($list->status == 100)
                                        <a href="/mypage/interview/{{ $list->id }}/result">미입력</a>
                                    @elseif($list->status == 200)
                                        <span>합격</span>
                                    @elseif($list->status == 300)
                                        <span class="slip">불합격</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="tr_contents">
                                <td colspan="100" class="visible-all">
                                    <div class="full_contents">
                                        {!! $list->contents !!}
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="100">내역이 존재하지 않습니다.</td>
                            </tr>

                        @endforelse

                        </tbody>
                    </table>
                    <!------ pc버전 끝 ------>
                </form>
            </div>
            <!------ 테이블 끝 ------>

            <article id="list_bottom">
                {{ $lists->links("vendor.pagination.default") }}
            </article><!-- article list_bottom end -->

        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.list-interview table tbody .tr_info td').on('click', function(){
                var hasClassOn = $(this).parent().hasClass('on');
                var totalIndex = $(this).parent().children().length - 1;
                var thisIndex = $(this).index();
                // console.log(totalIndex);
                // console.log(thisIndex);

                if(totalIndex !== thisIndex) {
                    if(hasClassOn) {
                        $(this).parent().removeClass('on');
                    }else {
                        $(this).parent().addClass('on');
                        $(this).parent().siblings().removeClass('on');
                    }
                }
            });
        });
    </script>
@endsection


