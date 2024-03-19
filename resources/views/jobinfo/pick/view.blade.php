
@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 취업컨설턴트 PICK 채용정보
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@include('common')

@php
    $major_menu = "채용정보";
    $minor_menu = "취업컨설턴트PICK";
@endphp

@section("content")
    <div class="sub-content">
{{--        <div class="sub-content_title">--}}
{{--            <h1>취업컨설턴트 PICK</h1>--}}
{{--        </div>--}}

        <div class="board-wrap board-view">
            <div class="view-wrap-two">
                <div class="view-top">
                    <div class="view-title">
                        <div class="v-subject-center">{{ $list->recruitment_field ?? "" }}</div>
                    </div>
                    <!---- 시작 pc버전---->
                    <div class="pc_version">

                        <div class="view_info_td_half">

                            <table>
                                <tbody>
                                <tr>
                                    <th class="top_line_black">기업명</th>
                                    <td class="top_line_black">{{ $list->company_name ?? "" }}</td>
                                    <th class="top_line_black">홈페이지</th>
                                    <td class="top_line_black">{{ $list->homepage ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>근무지역</th>
                                    <td>{{ get_work_area_lists( $list->work_area ) }}</td>
                                    <th>지원 마감일</th>
                                    <td>{{ $list->receipt_end_date.' '.$list->receipt_end_time }}</td>
                                </tr>
                                @for($i = 1; $i <= 5; $i++)
                                    @php
                                        $property = 'attachment' . $i;
                                    @endphp

                                    @if(!$list->$property)
                                        @continue
                                    @endif

                                    @php
                                        $filePath = './storage/'. getAttach($list->$property)->path ;
                                        $fileSizeValue = filesize($filePath);
                                    @endphp

                                    <tr>
                                        <th>첨부파일</th>
                                        <td colspan="3"><a href="{{ asset('/storage/'. getAttach($list->$property)->path )}}" class="attachment_name" download>{{ getAttach($list->$property)->original_name . ' (' . formatSize($fileSizeValue) . ')' }}</a></td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 끝 pc버전---->


                    <!---- 시작 태블릿버전---->
                    <div class="pdt50 tab_version">

                        <div class="view_info_td_half">
                            <table>
                                <tbody>
                                <tr>
                                    <th class="top_line_black">기업명</th>
                                    <td class="top_line_black">{{ $list->company_name ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>홈페이지</th>
                                    <td>{{ $list->homepage ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>근무지역</th>
                                    <td>{{ get_work_area_lists($list->work_area) }}</td>
                                </tr>
                                <tr>
                                    <th>지원 마감일</th>
                                    <td>{{ $list->receipt_end_date.' '.$list->receipt_end_time }}</td>
                                </tr>
                                @for($i = 1; $i <= 5; $i++)
                                    @php
                                        $property = 'attachment' . $i;
                                    @endphp

                                    @if(!$list->$property)
                                        @continue
                                    @endif

                                    @php
                                        $filePath = './storage/'. getAttach($list->$property)->path ;
                                        $fileSizeValue = filesize($filePath);
                                    @endphp

                                    <tr>
                                        <th>첨부파일 </th>
                                        <td><a href="{{ asset('/storage/'. getAttach($list->$property)->path )}}" class="attachment_name" download>{{ getAttach($list->$property)->original_name . ' (' . formatSize($fileSizeValue) . ')' }}</a></td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 끝 태블릿버전---->


                    <!---- 시작 모바일버전---->
                    <div class="pdt50 m_version">

                        <div class="view_info_td_half">

                            <table>
                                <tbody>
                                <tr>
                                    <td class="top_line_black">
                                        <li class="tit_wrap">기업명</li>
                                        <li>{{ $list->company_name }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">홈페이지</li>
                                        <li>{{ $list->homepage }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">근무지역</li>
                                        <li>{{ get_work_area_lists( $list->work_area ) }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">지원 마감일</li>
                                        <li>{{ $list->receipt_end_date.' '.$list->receipt_end_time }}</li>
                                    </td>
                                </tr>
                                @for($i = 1; $i <= 5; $i++)
                                    @php
                                        $property = 'attachment' . $i;
                                    @endphp

                                    @if(!$list->$property)
                                        @continue
                                    @endif

                                    @php
                                        $filePath = './storage/'. getAttach($list->$property)->path ;
                                        $fileSizeValue = filesize($filePath);
                                    @endphp

                                    <tr>
                                        <td>
                                            <li class="tit_wrap">첨부파일</li>
                                            <li>
                                                <a href="{{asset('/storage/'. getAttach($list->$property)->path )}}" class="attachment_name" download>{{ getAttach($list->$property)->original_name . ' (' . formatSize($fileSizeValue) . ')' }}</a>
                                            </li>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 끝 모바일버전---->

                </div>{{-- //.view-top end --}}

                <div class="view-mid">
                    <div class="view-content">
                        <div class="ck ck-editor__main" role="presentation">
                            <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline" lang="ko" dir="ltr">
                                {!!  dongaDomainChange(stripslashes($list->contents)) ?? "" !!}
                            </div>
                        </div>
                    </div>
                </div>{{-- //.view-mid end --}}

                <div class="view-bottom">
                    <div class="btn-others">
                        @if ($prev_list)
                            <a href="/jobinfo/pick/{{ $prev_list->id }}/view" class="prev-view switch-view-page">
                                <span class="prev-icon switch-view-icon"><img src="/img/prev_view_icon.png" alt="이전글 아이콘"><b>이전글</b></span>
                                <span class="switch-view-subject">{{ $prev_list->recruitment_field ?? "" }}</span>
                                <span class="switch-view-datetime">{{ date('y-m-d', strtotime($prev_list->created_at)) ?? "" }}</span>
                            </a>
                        @else
                            <a href="javascript:void(0)" class="prev-view end-view-page">
                                <span class="prev-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>이전글</b></span>
                                <span class="switch-view-subject">작성된 글이 없습니다</span>
                            </a>
                        @endif

                        @if ($next_list)
                            <a href="/jobinfo/pick/{{ $next_list->id }}/view" class="next-view switch-view-page">
                                <span class="next-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>다음글</b></span>
                                <span class="switch-view-subject">{{ $next_list->recruitment_field ?? "" }}</span>
                                <span class="switch-view-datetime">{{ date('y-m-d', strtotime($next_list->created_at)) ?? "" }}</span>
                            </a>
                        @else
                            <a href="javascript:void(0)" class="next-view end-view-page">
                                <span class="next-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>다음글</b></span>
                                <span class="switch-view-subject">작성된 글이 없습니다</span>
                            </a>
                        @endif
                    </div>{{-- //.btn-others end --}}

                    <div class="btn-wrap">
                        <div class="btn-right">
{{--                            <a href="" class="btn-del btn01">삭제</a>--}}
{{--                            <a href="" class="btn-copy btn01">복사</a>--}}
{{--                            <a href="" class="btn-modify btn01">수정</a>--}}

                        <?php if(session()->get('login_check')) { ?>
                                <a href="javascript:void(0)" class="btn-scrap btn01" onclick="__common.scrap( $list->id, '취업컨설턴트PICK', '$list->recruitment_field')">스크랩</a>
                        <?php } ?>
                            <a href="/jobinfo/pick" class="btn-list btn01">목록</a>
                        </div>
                    </div>

                </div>{{-- //.view-bottom end --}}
            </div>{{-- //.view-wrap end --}}

        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
