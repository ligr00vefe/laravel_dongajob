@extends("layouts.layout")

@section("title")
    동아대 - 워크넷 직업/진로정보
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@include('common')
@php
    $major_menu = "워크넷 직업/진로정보";
    $minor_menu = "채용정보";
    $worknet_url = 'https://www.work.go.kr/empInfo/empInfoSrch/detail/empDetailAuthView.do?searchInfoType=VALIDATION&callPage=detail&wantedAuthNo=';
@endphp

@section("content")
    @if($list->message)
        <script>
            alert('{{ $list->message }}');
            location.href = '/course/employment';
        </script>
    @endif


    <div class="sub-content">
        <div class="board-wrap board-view worknet-view">
            <div class="view-wrap-two">
                <div class="view-top">
                    <div class="view-title">
                        <div class="v-subject-center">{{ $list->wantedInfo->wantedTitle[0] }}</div>
                    </div>

                    <!---- 기본 정보 시작 ---->
                    <div class="table04">
                        <div class="view_info_td_half">

                            <table>
                                <tbody>
                                <tr>
                                    <th class="top_line_black">회사명</th>
                                    <td class="top_line_black">{{$list->corpInfo->corpNm ?: '-'}}</td>

                                    <th class="top_line_black">업종</th>
                                    <td class="top_line_black">{{$list->corpInfo->indTpCdNm  ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>대표자명</th>
                                    <td>{{$list->corpInfo->reperNm  ?: '-'}}</td>

                                    <th>사원수</th>
                                    <td>{{$list->corpInfo->totPsncnt  ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>자본금</th>
                                    <td>{{$list->corpInfo->capitalAmt  ?: '-'}}</td>

                                    <th>연매출액</th>
                                    <td>{{$list->corpInfo->yrSalesAmt  ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>주요사업내용</th>
                                    <td>{{$list->corpInfo->busiCont  ?: '-'}}</td>

                                    <th>홈페이지</th>
                                    <td><a href="{{ $worknet_url.$list->wantedAuthNo }}"
                                           target="_blank">워크넷 접속</a></td>
                                </tr>
                                <tr>
                                    <th>회사주소</th>
                                    <td colspan="3">{{$list->corpInfo->corpAddr  ?: '-'}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 기본 정보 끝 ---->

                    <!---- 모집요강 시작 ---->
                    <div class="table04">
                        <div class="bullet_title">모집요강</div>

                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>모집직종</th>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th>관련직종</th>
                                    <td>{{ empty($list->wantedInfo->relJobsNm) ? '-' : $list->wantedInfo->relJobsNm }}</td>
                                </tr>
                                <tr>
                                    <th>직무내용</th>
                                    <td>{!!  $list->wantedInfo->jobCont ?: '-' !!}</td>
                                </tr>
                                <tr>
                                    <th>접수마감일</th>
                                    <td>{{$list->wantedInfo->receiptCloseDt ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>고용형태</th>
                                    <td>{{$list->wantedInfo->empTpNm ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>모집인원</th>
                                    <td>{{$list->wantedInfo->collectPsncnt ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>임금조건</th>
                                    <td>{{$list->wantedInfo->salTpNm ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>경력조건</th>
                                    <td>{{$list->wantedInfo->enterTpNm ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>학력</th>
                                    <td>{{$list->wantedInfo->eduNm ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>키워드</th>
                                    <td>{{$list->keywordList->srchKeywordNm ?: '-'}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 모집요강 끝 ---->

                    <!---- 우대사항 시작 ---->
                    <div class="table04">
                        <div class="bullet_title">우대사항</div>

                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>외국어능력</th>
                                    <td>{{ empty($list->wantedInfo->forLang) ? '-' : $list->wantedInfo->forLang }}</td>
                                </tr>
                                <tr>
                                    <th>전공</th>
                                    <td>{{ empty($list->wantedInfo->major) ? '-' : $list->wantedInfo->major }}</td>
                                </tr>
                                <tr>
                                    <th>자격면허</th>
                                    <td>{{ empty($list->wantedInfo->certificate) ? '-' : $list->wantedInfo->certificate }}</td>
                                </tr>
                                <tr>
                                    <th>병역특례채용희망</th>
                                    <td>{{ empty($list->wantedInfo->mltsvcExcHope) ? '-' : $list->wantedInfo->mltsvcExcHope }}</td>
                                </tr>
                                <tr>
                                    <th>컴퓨터활용능력</th>
                                    <td>{{ empty($list->wantedInfo->compAbl) ? '-' : $list->wantedInfo->compAbl }}</td>
                                </tr>
                                <tr>
                                    <th>우대조건</th>
                                    <td>{{ empty($list->wantedInfo->pfCond) ? '-' : $list->wantedInfo->pfCond }}</td>
                                </tr>
                                <tr>
                                    <th>장애인 채용희망</th>
                                    <td>{{ empty($list->wantedInfo->mltsvcExcHope) ? '-' : $list->wantedInfo->mltsvcExcHope }}</td>
                                </tr>
                                <tr>
                                    <th>기타 우대사항</th>
                                    <td>{{ empty($list->wantedInfo->etcPfCond) ? '-' : $list->wantedInfo->etcPfCond }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 우대사항 끝 ---->

                    <!---- 전형방법 시작 ---->
                    <div class="table04">
                        <div class="bullet_title">전형방법</div>

                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>전형방법</th>
                                    <td>{{$list->wantedInfo->selMthd ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>접수방법</th>
                                    <td>{{$list->wantedInfo->rcptMthd ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>제출서류양식 첨부</th>
                                    <td>{{$list->corpAttachList->attachFileUrl ?: '-'}}</td>
                                </tr>
                                <tr>
                                    <th>제출서류 준비물</th>
                                    <td>{{$list->wantedInfo->submitDoc ?: '-'}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 전형방법 끝 ---->

                    <!---- 근무환경 및 복리후생 시작 ---->
                    <div class="table04">
                        <div class="bullet_title">근무환경 및 복리후생</div>

                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>근무예정지</th>
                                    <td>{{ empty($list->wantedInfo->workRegion) ? '-' : $list->wantedInfo->workRegion }}</td>
                                </tr>
                                <tr>
                                    <th>소속산업단지</th>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th>인근전철역</th>
                                    <td>{{ empty($list->wantedInfo->nearLine) ? '-' : $list->wantedInfo->nearLine }}</td>
                                </tr>
                                <tr>
                                    <th>근무시간/형태</th>
                                    <td>{{ empty($list->wantedInfo->workdayWorkhrCont) ? '-' : $list->wantedInfo->workdayWorkhrCont }}</td>
                                </tr>
                                <tr>
                                    <th>연금4대보험</th>
                                    <td>{{ empty($list->wantedInfo->fourIns) ? '-' : $list->wantedInfo->fourIns }}</td>
                                </tr>
                                <tr>
                                    <th>퇴직금</th>
                                    <td>{{ empty($list->wantedInfo->retirepay) ? '-' : $list->wantedInfo->retirepay }}</td>
                                </tr>
                                <tr>
                                    <th>기타복리후생</th>
                                    <td>{{ empty($list->wantedInfo->etcWelfare) ? '-' : $list->wantedInfo->etcWelfare }}</td>
                                </tr>
                                <tr>
                                    <th>장애인편의시설</th>
                                    <td>{{ empty($list->wantedInfo->disableCvntl) ? '-' : $list->wantedInfo->disableCvntl }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 근무환경 및 복리후생 끝 ---->

                </div>{{-- //.view-top end --}}

                <div class="view-mid">
                    <div class="bullet_title title_etc">기타</div>
                    <div class="view-content">
                        {!! empty($list->wantedInfo->etcHopeCont) ? '-' : $list->wantedInfo->etcHopeCont  !!}
                    </div>

                    <!---- 채용담당자 시작 ---->
                    <div class="table04">
                        <div class="bullet_title">채용담당자</div>

                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>부서/담당자</th>
                                    <td>{{ empty($list->wantedInfo->empChargerDpt) ? '-' : $list->wantedInfo->empChargerDpt }}</td>
                                </tr>
                                <tr>
                                    <th>전화번호</th>
                                    <td>{{ empty($list->wantedInfo->contactTelno) ? '-' : $list->wantedInfo->contactTelno }}</td>
                                </tr>
                                <tr>
                                    <th>팩스번호</th>
                                    <td>{{ empty($list->wantedInfo->chargerFaxNo) ? '-' : $list->wantedInfo->chargerFaxNo }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 근무환경 및 복리후생 끝 ---->
                </div>{{-- //.view-mid end --}}

                <div class="view-bottom">
                    <div class="btn-others">
                        {{--                        @if ($prev_list)--}}
                        {{--                            <a href="/jobinfo/recommend/{{ $prev_list->id }}/view" class="prev-view switch-view-page">--}}
                        {{--                                <span class="prev-icon switch-view-icon"><img src="/img/prev_view_icon.png" alt="이전글 아이콘"><b>이전글</b></span>--}}
                        {{--                                <span class="switch-view-subject">{{ $prev_list->recruitment_field ?? "" }}</span>--}}
                        {{--                                <span class="switch-view-datetime">{{ date('y-m-d', strtotime($prev_list->created_at)) ?? "" }}</span>--}}
                        {{--                            </a>--}}
                        {{--                        @else--}}
                        {{--                            <a href="javascript:void(0)" class="prev-view end-view-page">--}}
                        {{--                                <span class="prev-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>이전글</b></span>--}}
                        {{--                                <span class="switch-view-subject">작성된 글이 없습니다</span>--}}
                        {{--                            </a>--}}
                        {{--                        @endif--}}

                        {{--                        @if ($next_list)--}}
                        {{--                            <a href="/jobinfo/recommend/{{ $next_list->id }}/view" class="next-view switch-view-page">--}}
                        {{--                                <span class="next-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>다음글</b></span>--}}
                        {{--                                <span class="switch-view-subject">{{ $next_list->recruitment_field ?? "" }}</span>--}}
                        {{--                                <span class="switch-view-datetime">{{ date('y-m-d', strtotime($next_list->created_at)) ?? "" }}</span>--}}
                        {{--                            </a>--}}
                        {{--                        @else--}}
                        {{--                            <a href="javascript:void(0)" class="next-view end-view-page">--}}
                        {{--                                <span class="next-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>다음글</b></span>--}}
                        {{--                                <span class="switch-view-subject">작성된 글이 없습니다</span>--}}
                        {{--                            </a>--}}
                        {{--                        @endif--}}
                    </div>{{-- //.btn-others end --}}

                    <div class="btn-wrap">
                        <div class="btn-right">
                            <a href="/course/employment" class="btn-list btn01">목록</a>
                        </div>
                    </div>

                </div>{{-- //.view-bottom end --}}
            </div>{{-- //.view-wrap end --}}

        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
