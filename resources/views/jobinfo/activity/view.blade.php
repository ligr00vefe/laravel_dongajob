@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 각종 활동
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@include('common')

@php
    $major_menu = "채용정보";
    $minor_menu = "각종활동";
@endphp

@section("content")
    <div class="sub-content">
{{--        <div class="sub-content_title">--}}
{{--            <h1>각종 활동</h1>--}}
{{--        </div>--}}

        <div class="board-wrap board-view activity-view">
            <div class="view-wrap-two">
                <div class="view-top">
                    <div class="view-title">
                        <div class="v-subject-center">{{ $list->recruitment_field ?? "" }}</div>
                    </div>

                    <!---- 회사정보 시작 pc버전 ---->
                    <div class="pc_version">
                        <div class="bullet_title">회사정보</div>

                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>기업명</th>
                                    <td>{{ $list->company_name ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td>{{ ($list->addr_field1 ?? "").' '.($list->addr_field2 ?? "") }}</td>
                                </tr>
                                <tr>
                                    <th>전화번호</th>
                                    <td>{{ $list->tel_field ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>휴대전화</th>
                                    <td>{{ $list->phone_field ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td>
                                        {{ $list->email_field1 ?? "" }}
                                        @php
                                            if(isset($list->email_field1) && isset($list->email_field2)) {
                                                echo '@';
                                            }
                                        @endphp
                                        {{ $list->email_field2 ?? "" }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 회사정보 끝 pc버전 ---->


                    <!---- 회사정보 시작 태블릿버전 ---->
                    <div class="tab_version">
                        <div class="bullet_title">회사정보</div>

                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <th>기업명</th>
                                    <td>{{ $list->company_name ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td>{{ ($list->addr_field1 ?? "") . ' ' . ($list->addr_field2 ?? "") }}</td>
                                </tr>
                                <tr>
                                    <th>전화번호</th>
                                    <td>{{ $list->tel_field ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>휴대전화</th>
                                    <td>{{ $list->phone_field ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td>
                                        {{ $list->email_field1 ?? "" }}
                                        @php
                                        if(isset($list->email_field1) && isset($list->email_field2)) {
                                            echo '@';
                                        }
                                        @endphp
                                        {{ $list->email_field2 ?? "" }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 회사정보 끝 태블릿버전 ---->


                    <!---- 회사정보 시작 모바일버전 ---->
                    <div class="m_version">
                        <div class="bullet_title">회사정보</div>

                        <div class="view-info-table">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">기업명</li>
                                        <li>{{ $list->company_name ?? "" }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">주소</li>
                                        <li>{{ ($list->addr_field1 ?? "") . ' ' . ($list->addr_field2 ?? "") }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">전화번호</li>
                                        <li>{{ $list->tel_field ?? "" }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">휴대전화</li>
                                        <li>{{ $list->phone_field ?? "" }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">E-mail</li>
                                        <li>
                                            {{ $list->email_field1 ?? "" }}
                                            @php
                                            if(isset($list->email_field1) && isset($list->email_field2)) {
                                                echo '@';
                                            }
                                            @endphp
                                            {{ $list->email_field2 ?? "" }}
                                        </li>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---- 회사정보 끝 모바일버전 ---->


                    <!---- 채용정보 시작 pc버전---->
                    <div class="pdt50 pc_version">
                        <div class="bullet_title">채용정보</div>

                        <div class="view_info_td_half">

                            <table>
                                <tbody>
                                <tr>
                                    <th>채용분야</th>
                                    <td colspan="3">{{ $list->recruitment_field  ?? ""}}</td>
                                </tr>
                                <tr>
                                    <th>근무기간</th>
                                    <td>{{ $list->workday_field ?? ""}}</td>
                                    <th>모집인원</th>
                                    <td>{{ $list->recruitment_number ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>근무지역</th>
                                    <td>{{ get_work_area_lists($list->work_area) ?? "" }}</td>
                                    <th>급여</th>
                                    <td>{{ $list->pay_field ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>성별/나이</th>
                                    <td>
                                        {{ get_activity_gender_lists($list->gender_field) ?? "" }}
                                        @php
                                        if(isset($list->gender_field) && isset($list->age_field)) {
                                            echo '/';
                                        }
                                        @endphp
                                        {{ $list->age_field ?? "" }}
                                    </td>
                                    <th>접수마감</th>
                                    <td>
                                        @php
                                            if($list->receipt_end_date == "0000-00-00") {
                                                echo '충원시';
                                            }else {
                                                echo ($list->receipt_end_date ?? "") .' '. ($list->receipt_end_time ?? "");
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <th>URL</th>
                                    <td>{{ $list->homepage ?? '' }}</td>
                                    <th>접수방법</th>
                                    <td>{{ $list->way_field ?? '' }}</td>
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
                    <!---- 채용정보 끝 pc버전---->


                    <!---- 채용정보 시작 태블릿버전---->
                    <div class="pdt50 tab_version">
                        <div class="bullet_title">채용정보</div>

                        <div class="view_info_td_half">

                            <table>
                                <tbody>
                                <tr>
                                    <th>채용분야</th>
                                    <td>{{ $list->recruitment_field ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>근무기간</th>
                                    <td>{{ $list->work_day ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>모집인원</th>
                                    <td>{{ $list->cnt_employed ?? "" }} <span class="num_cnt_unit">명</span></td>
                                </tr>
                                <tr>
                                    <th>근무지역</th>
                                    <td>{{ get_work_area_lists($list->work_area) ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>급여</th>
                                    <td>{{ $list->pay ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>성별/나이</th>
                                    <td>
                                        {{ get_activity_gender_lists($list->gender_field) ?? "" }}
                                        @php
                                        if(isset($list->gender_field) && isset($list->age_field)) {
                                            echo '/';
                                        }
                                        @endphp
                                        {{ $list->age_field ?? "" }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>접수마감</th>
                                    <td>
                                        @php
                                        if($list->receipt_end_date == "0000-00-00") {
                                            echo '충원시';
                                        }else {
                                            echo ($list->receipt_end_date ?? "") .' '. ($list->receipt_end_time ?? "");
                                        }
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <th>URL</th>
                                    <td>{{ $list->homepage ?? "" }}</td>
                                </tr>
                                <tr>
                                    <th>접수방법</th>
                                    <td>{{ $list->way_field ?? "" }}</td>
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
                    <!---- 채용정보 끝 태블릿버전---->


                    <!---- 채용정보 시작 모바일버전---->
                    <div class="pdt50 m_version">
                        <div class="bullet_title">채용정보</div>

                        <div class="view_info_td_half">

                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">채용분야</li>
                                        <li>{{ $list->recruitment_field ?? "" }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">근무기간</li>
                                        <li>{{ $list->work_day ?? "" }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">모집인원</li>
                                        <li>{{ $list->cnt_employed ?? "" }} 명</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">근무지역</li>
                                        <li>{{ get_work_area_lists($list->work_area) ?? "" }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">급여</li>
                                        <li>{{ $list->pay_field ?? "" }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">성별/나이</li>
                                        <li>
                                            {{ get_activity_gender_lists($list->gender_field) ?? "" }}
                                            @php
                                            if(isset($list->gender_field) && isset($list->age_field)) {
                                                echo '/';
                                            }
                                            @endphp
                                            {{ $list->age_field ?? "" }}
                                        </li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">접수마감</li>
                                        <li>
                                            @php

                                            @endphp
                                            {{ ($list->receipt_end_date ?? "") .' '. ($list->receipt_end_time ?? "") }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">URL</li>
                                        <li>{{ $list->homepage ?? "" }}</li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li class="tit_wrap">접수방법</li>
                                        <li>{{ $list->way_field ?? "" }}</li>
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
                    <!---- 채용정보 끝 모바일버전---->

                </div>{{-- //.view-top end --}}

                <div class="view-mid pdt50">
                    <div class="bullet_title">세부내용</div>
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
                            <a href="/jobinfo/activity/{{ $prev_list->id }}/view" class="prev-view switch-view-page">
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
                            <a href="/jobinfo/activity/{{ $next_list->id }}/view" class="next-view switch-view-page">
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
                                <a href="javascript:void(0)" class="btn-scrap btn01" onclick="__common.scrap({{ $list->id }}, '각종활동', '{{ $list->recruitment_field }}') ">스크랩</a>
                            <?php } ?>

                            <a href="/jobinfo/activity" class="btn-list btn01">목록</a>
                        </div>
                    </div>

                </div>{{-- //.view-bottom end --}}
            </div>{{-- //.view-wrap end --}}

        </div>{{-- //.board-wrap end --}}
    </div>

@endsection
