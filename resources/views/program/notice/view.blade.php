@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 공지사항
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/board.js"></script>
    <script defer src="/js/board.js"></script>
@endpush

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "공지사항";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>공지사항</h1>
        </div>

        <div class="board-wrap board-view">
            <div class="view-wrap">
                <div class="view-top">

                    <div class="view-title">
                        <div class="v-subject">
                            <span class="v-category">  {{ '['. get_notice_category($list->category_id) .']' }}</span>
                            {{ $list->subject }}
                        </div>

                        <div class="write_info_wrap">
                            <span class="v-name">{{ $list->user_id }}</span>
                            <span class="v-datetime">{{ date('y-m-d', strtotime($list->created_at)) }}</span>
                            <span class="v-hit">{{ $list->hit }}</span>
                        </div>
                    </div>

                    <!---- 시작 pc버전 ---->
                    <div class="pc_version">
                        <div class="view-info-table">
                            <table>
                                <tbody>

                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $property = 'attachment' . $i;
                                        @endphp


                                        @if(!$list->$property)
                                            @continue
                                        @endif
                                        <tr>
                                            <th>첨부파일 </th>
                                            <td> <a href="{{ asset('/storage/'. getAttach($list->$property)->path )}}" download>{{ getAttach($list->$property)->original_name }}</a></td>
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
                                <tr>
                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $property = 'attachment' . $i;
                                        @endphp


                                        @if(!$list->$property)
                                            @continue
                                        @endif

                                        <th>첨부파일</th>
                                        <td> <a href="{{asset('/storage/'. getAttach($list->$property)->path )}}" download>{{ getAttach($list->$property)->original_name }}</a></td>
                                    @endfor
                                </tr>

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
                                <tr>
                                    <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $property = 'attachment' . $i;
                                        @endphp


                                        @if(!$list->$property)
                                            @continue
                                        @endif

                                        <li class="tit_wrap">첨부파일</li>
                                        <li><a href="{{asset('/storage/'. getAttach($list->$property)->path )}}" download>{{ getAttach($list->$property)->original_name }}</a></li>
                                        @endfor
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 끝 모바일버전 ---->

                </div>{{-- //.view-top end --}}

                <div class="view-mid">
                    <div class="view-content">
                        <p>
                        <div class="ck ck-editor__main" role="presentation">
                            <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline view" lang="ko" dir="ltr"  aria-label="리치 텍스트 편집기, main">
                            {!! dongaDomainChange(stripslashes($list->contents)) ?? "" !!}
                            </div>
                        </div>
                        </p>
                    </div>
                </div>{{-- //.view-mid end --}}

                <div class="view-bottom">
                    <div class="btn-others">
                        @if ($prev_list)
                            <a href="/program/notice/{{ $prev_list->id }}/view" class="prev-view switch-view-page">
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
                            <a href="/program/notice/{{ $next_list->id }}/view" class="next-view switch-view-page">
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
                            <a href="javascript:void(0)" class="btn-scrap btn01" onclick="__common.scrap({{ $list->id }}, '공지사항', '{{ $list->subject }}') ">스크랩</a>
                            <a href="/program/notice" class="btn-list btn01">목록</a>
                        </div>
                    </div>

                </div>{{-- //.view-bottom end --}}
            </div>{{-- //.view-wrap end --}}

        </div>{{-- //.board-wrap end --}}
    </div>

@endsection
