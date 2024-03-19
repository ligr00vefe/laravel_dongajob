
@extends("layouts.layout")

@section("title")
    최신 취업수기
@endsection

@push('scripts')
    <script defer src="/js/board.js"></script>
    <script defer src="/js/comment/comment.js"></script>
@endpush

@include('common')
@php
    $major_menu = "취업자료실";
    $minor_menu = "최신 취업수기";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>최신 취업수기(최근 5년)</h1>
        </div>

        <div class="board-wrap board-view">
            <div class="view-wrap">
                <div class="view-top">

                    <div class="view-title">
                        <div class="v-subject">
                            {{ $list -> subject}}
                        </div>

                        <div class="write_info_wrap">
                            <span class="v-name">{{ $list->name }}</span>
                            <span class="v-major">{{ $list->dpt }}</span>
                            <span class="v-datetime">{{ date('y-m-d', strtotime($list -> created_at )) }}</span>
                            <span class="v-hit">{{ $list -> hit }}</span>
                        </div>
                    </div>

                    <!---- 시작 pc버전 ---->
                    <div class="pc_version">
                        <div class="view-info-table">
                            <table>
                                <tbody>
                                    {{--<tr>--}}
                                        {{--<th>URL</th>--}}
                                        {{--<td><a href="{{ $list->homepage ?? "" }}" target='_blank'>{{ $list->homepage ?? "" }}</a></td>--}}
                                    {{--</tr>--}}
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
                    <!---- 끝 pc버전 ---->


                    <!---- 시작 태블릿버전 ---->
                    <div class="tab_version">
                        <div class="view-info-table">
                            <table>
                                <tbody>
                                    {{--<tr>--}}
                                        {{--<th>URL</th>--}}
                                        {{--<td><a href="{{ $list->homepage ?? "" }}" target='_blank'>{{ $list->homepage ?? "" }}</a></td>--}}
                                    {{--</tr>--}}
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
                    <!---- 끝 태블릿버전 ---->


                    <!---- 시작 모바일버전 ---->
                    <div class="m_version">
                        <div class="view-info-table">
                            <table>
                                <tbody>
                                    {{--<tr>--}}
                                        {{--<td>--}}
                                            {{--<li class="tit_wrap">URL</li>--}}
                                            {{--<li>--}}
                                                {{--<a href="{{ $list->homepage ?? "" }}" target='_blank'>{{ $list->homepage ?? "" }}</a>--}}
                                            {{--</li>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
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
                    <!---- 끝 모바일버전 ---->

                </div>{{-- //.view-top end --}}

                <div class="view-mid">
                    <div class="view-content">
                        <div class="ck ck-editor__main" role="presentation">
                            <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline view" lang="ko" dir="ltr">
                                {!! dongaDomainChange(stripslashes($list->contents)) ?? "" !!}
                            </div>
                        </div>
                    </div>
                </div>{{-- //.view-mid end --}}

                <!------ 댓글 시작 ------>
                <div class="view_comment_wrap pdt50">
                    @include("_include.comment.comment",  [
                                'board_id' => $list->id,
                                'board_title' => $board_title
                             ])
                </div>
                <!------ 댓글 끝 ------>

                <div class="view-bottom">
                    <div class="btn-others">
                        @if ($prev_list)
                            <a href="/archive/reviewlatest/{{ $prev_list->id }}/view" class="prev-view switch-view-page">
                                <span class="prev-icon switch-view-icon"><img src="/img/prev_view_icon.png" alt="이전글 아이콘"><b>이전글</b></span>
                                <span class="switch-view-subject">{{ $prev_list->subject ?? "" }}</span>
                                <span class="switch-view-datetime">{{ date('y-m-d', strtotime($prev_list->created_at)) ?? "" }}</span>
                            </a>
                        @else
                            <a href="javascript:void(0)" class="prev-view end-view-page">
                                <span class="prev-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>이전글</b></span>
                                <span class="switch-view-subject">작성된 글이 없습니다</span>
                            </a>
                        @endif

                        @if ($next_list)
                            <a href="/archive/reviewlatest/{{ $next_list->id }}/view" class="next-view switch-view-page">
                                <span class="next-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>다음글</b></span>
                                <span class="switch-view-subject">{{ $next_list->subject ?? "" }}</span>
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
                            <form action="/archive/reviewlatest/{{ $list -> id }}/destroy" method="post" style="display: inline-block" onsubmit="if(!confirm('삭제하시겠습니까?')) { return false; }">
                                @csrf
                                @method("delete")

                                @if($writer_check)
                                    <button class="btn-del btn01">삭제</button>
                                @endif
                            </form>
                            @if($writer_check)
                                <a href="/archive/reviewlatest/{{ $list -> id }}/edit" class="btn-modify btn01">수정</a>
                            @endif
                                <a href="javascript:void(0)" class="btn-scrap btn01" onclick="__common.scrap({{ $list->id }}, '최신취업수기', '{{ $list->subject }}') ">스크랩</a>
                                <a href="/archive/reviewlatest" class="btn-list btn01">목록</a>
                            @if($login_check && !isStaffCheck(session()->get('donga_type')))
                                <a href="/archive/reviewlatest/create" class="btn-submit btn01 confirm-link">글쓰기</a>
                            @endif
                        </div>
                    </div>
                </div>{{-- //.view-bottom end --}}
            </div>{{-- //.view-wrap end --}}

        </div>{{-- //.board-wrap end --}}
    </div>

@endsection
