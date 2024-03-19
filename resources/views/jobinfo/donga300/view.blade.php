
@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 동아 친화 기업 300
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@include('common')

@php
    $major_menu = "채용정보";
    $minor_menu = "동아친화기업300";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>동아 친화기업 300</h1>
        </div>

        <div class="board-wrap board-view">
            <div class="view-wrap">
                <div class="view-top">

                    <div class="view-title">
                        <div class="v-subject">{{ $list->subject ?? "" }}</div>

                        <div class="write_info_wrap">
                            <span class="v-name">관리자</span>
                            <span class="v-datetime">{{ date('Y-m-d', strtotime( $list->created_at )) }}</span>
                            <span class="v-hit">{{ $list->hit ?? "" }}</span>
                        </div>
                    </div>

                    <!---- 시작 pc버전 ---->
                    <div class="pc_version">
                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>취업자</th>
                                    <td>{{ $list->cnt_employed ?? "" }} 명</td>
                                </tr>
                                <tr>
                                    <th>URL</th>
                                    <td><a href="{{ $list->homepage ?? "" }}" target="_blank">{{ $list->homepage ?? "" }}</a></td>
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
                    <!---- 끝 pc버전 ---->


                    <!---- 시작 태블릿버전 ---->
                    <div class="tab_version">
                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>취업자</th>
                                    <td>{{ $list->cnt_employed ?? "" }} 명</td>
                                </tr>
                                <tr>
                                    <th>URL</th>
                                    <td><a href="{{ $list->homepage ?? "" }}">{{ $list->homepage ?? "" }}</a></td>
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
                                        <td>
                                            <a href="/storage/{{ $file->path }}" class="attachment_name" download>{{ $file->original_name . ' (' . formatSize($fileSizeValue) . ')' }}</a>
                                        </td>
                                    </tr>
                                @endforeach
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
                                        <li class="tit_wrap">취업자</li>
                                        <li>{{ $list->cnt_employed ?? "" }} <span>명</span></li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">홈페이지</li>
                                        <li><a href="{{ $list->homepage ?? "" }}">{{ $list->homepage }}</a></li>
                                    </td>
                                </tr>
                                <tr>
                                @foreach($files as $file)

                                    @if(!$file)
                                        @continue
                                    @endif

                                    @php
                                        $fileSizeValue = filesize('./storage/' . $file->path);
                                    @endphp

                                    <tr>
                                        <td>
                                            <li class="tit_wrap">첨부파일</li>
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
                    <!---- 끝 모바일버전 ---->

                <div class="view-mid">
                    <div class="view-content">
                        <div class="ck ck-editor__main" role="presentation">
                            <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline view" lang="ko" dir="ltr">
                                {!! dongaDomainChange(stripslashes($list->contents)) ?? "" !!}
                            </div>
                        </div>
                    </div>
                </div>{{-- //.view-mid end --}}

                <div class="view-bottom">
                    <div class="btn-others">
                        @if ($prev_list)
                            <a href="/jobinfo/donga300/{{ $prev_list->id }}/view" class="prev-view switch-view-page">
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
                            <a href="/jobinfo/donga300/{{ $next_list->id }}/view" class="next-view switch-view-page">
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
{{--                            <a href="" class="btn-del btn01">삭제</a>--}}
{{--                            <a href="" class="btn-copy btn01">복사</a>--}}
{{--                            <a href="" class="btn-modify btn01">수정</a>--}}
                            <?php if(session()->get('login_check')) { ?>
                                <a href="javascript:void(0)" class="btn-scrap btn01" onclick="__common.scrap({{ $list->id }}, '동아친화기업300', '{{ $list->subject }}') ">스크랩</a>
                            <?php } ?>

                            <a href="/jobinfo/donga300" class="btn-list btn01">목록</a>
                        </div>
                    </div>

                </div>{{-- //.view-bottom end --}}
            </div>{{-- //.view-wrap end --}}

        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
