
@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 일반채용
@endsection

@push('scripts')

@endpush

@include('common')

@php
    $major_menu = "채용정보";
    $minor_menu = "일반채용";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
{{--        <div class="sub-content_title">--}}
{{--            <h1>일반 채용</h1>--}}
{{--        </div>--}}

        <div class="board-wrap board-view">
            <div class="view-wrap-two">
                <div class="view-top">
                    <div class="view-title">
                        <div class="v-subject-center">{{ $list->recruitment_field ?? "" }}</div>
                    </div>

                    <!----  시작 pc버전 ---->
                    <div class="pc_version">

                        <div class="view_info_td_half">
                            <table>
                                <tbody>
                                <tr>
                                    <th class="top_line_black">기업명</th>
                                    <td class="top_line_black">{{ $list->company_name ?? "" }}</td>
                                    <th class="top_line_black">접수방법</th>
                                    <td class="top_line_black">{{ get_recommend_screening_method_lists($list->screening_method) }}</td>
                                </tr>
                                <tr>
                                    <th>채용형태</th>
                                    <td>{{ get_recommend_recruitment_lists( $list->category ?? "" ) }}</td>
                                    <th>홈페이지</th>
                                    <td><a href="{{ $list->homepage ?? "" }}" target='_blank'>{{ $list->homepage ?? "" }}</a></td>
                                </tr>
                                <tr>
                                    <th>근무지역</th>
                                    <td>{{ get_work_area_lists($list->work_area) }}</td>
                                    <th>지원 마감일</th>
                                    <td>{{ $list->receipt_end_date.' '.$list->receipt_end_time }}</td>
                                </tr>
                                @foreach($files as $file)

                                    @if(!$file)
                                        @continue
                                    @endif

                                    @php
                                        $fileSizeValue = filesize('./storage/' . $file->path);
                                    @endphp
                                    <tr>
                                        <th>첨부파일</th>
                                        <td colspan="3">
                                            <a href="/storage/{{ $file->path }}" class="attachment_name" download>{{ $file->original_name . ' (' . formatSize($fileSizeValue) . ')' }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!----  끝 pc버전 ---->


                    <!----  시작 태블릿버전 ---->
                    <div class="tab_version">

                        <div class="view_info_td_half">
                            <table>
                                <tbody>
                                <tr>
                                    <th class="top_line_black">기업명</th>
                                    <td class="top_line_black">{{ $list->company_name ?? "" }}</td>
                               </tr>
                                <tr>
                                    <th>접수방법</th>
                                    <td>{{ $list->recruitment_field ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>채용형태</th>
                                    <td>{{ get_recommend_recruitment_lists($list->category) }}</td>
                                </tr>
                                <tr>
                                    <th>홈페이지</th>
                                    <td><a href="{{ $list->homepage ?? "" }}">{{ $list->homepage ?? "" }}</a></td>
                                </tr>
                                <tr>
                                    <th>근무지역</th>
                                    <td>{{ get_work_area_lists($list->work_area) }}</td>
                                </tr>
                                <tr>
                                    <th>지원 마감일</th>
                                    <td>{{ $list->receipt_end_date . ' '.$list->receipt_end_time  }}</td>
                                </tr>
                                @foreach($files as $file)

                                    @if(!$file)
                                        @continue
                                    @endif

                                    @php
                                        $fileSizeValue = filesize('./storage/' . $file->path);
                                    @endphp
                                    <tr>
                                        <th>첨부파일</th>
                                        <td colspan="3">
                                            <a href="/storage/{{ $file->path }}" class="attachment_name" download>{{ $file->original_name . ' (' . formatSize($fileSizeValue) . ')' }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!----  끝 태블릿버전 ---->


                    <!----  시작 모바일버전 ---->
                    <div class="m_version">
                        <div class="view_info_td_half">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="top_line_black">
                                        <li class="tit_wrap">기업명</li>
                                        <li>{{ $list->company_name ?? "" }}/li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">접수방법</li>
                                        <li>{{ get_recommend_screening_method_lists( $list->screening_method ) }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">채용형태</li>
                                        <li>{{ get_recommend_recruitment_lists( $list->category ) }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">홈페이지</li>
                                        <li><a href="{{ $list->homepage ?? "" }}">{{ $list->homepage ?? "" }}</a></li>
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
                                @foreach($files as $file)

                                    @if(!$file)
                                        @continue
                                    @endif

                                    @php
                                        $fileSizeValue = filesize('./storage/' . $file->path);
                                    @endphp

                                    <tr>
                                        <td>
                                            <li  class="tit_wrap">첨부파일</li>
                                            <li>
                                                <a href="/storage/{{ $file->path }}" class="attachment_name" download>{{ $file->original_name . ' (' . formatSize($fileSizeValue) . ')' }}</a>
                                            </li>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!----  끝 모바일버전 ---->

                </div>{{-- //.view-top end --}}

                <div class="view-mid">
                    <div class="view-content">
                        <div class="ck ck-editor__main" role="presentation">
                            <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline view" lang="ko" dir="ltr"  aria-label="리치 텍스트 편집기, main">
                       {!!  dongaDomainChange(stripslashes($list->contents)) ?? "" !!}
                            </div>
                        </div>
                    </div>
                </div>{{-- //.view-mid end --}}

                <div class="view-bottom">
                    <div class="btn-others">
                        @if ($prev_list)
                            <a href="/jobinfo/normal/{{ $prev_list->id }}/view" class="prev-view switch-view-page">
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
                            <a href="/jobinfo/normal/{{ $next_list->id }}/view" class="next-view switch-view-page">
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
                                <a href="javascript:void(0)" class="btn-scrap btn01" onclick="__common.scrap({{ $list->id }}, '일반채용', '{{ $list->recruitment_field }}') ">스크랩</a>
                            <?php } ?>
                            <a href="/jobinfo/normal" class="btn-list btn01">목록</a>
                        </div>
                    </div>

                </div>{{-- //.view-bottom end --}}
            </div>{{-- //.view-wrap end --}}

        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
