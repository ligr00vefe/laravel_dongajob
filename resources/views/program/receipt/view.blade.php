@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 프로그램 접수
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/program/receipt/view.js"></script>
@endpush

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "프로그램 접수";
@endphp

@section("content")
    @php
        if(!$e_over)
        echo '<script>alert("마감된 공고 입니다.")</script>';
      else if($s_over)
          echo '<script>alert("접수시작이 아직되지 않은 공고 입니다.")</script>';
    @endphp

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>프로그램 접수</h1>
        </div>

        <form action="/program/receipt/add" method="get" name="forms">
            <input type="hidden" name="id" value="{{ $list->id }}">
            <input type="hidden" name="program_token" value="{{ $program_token }}">

            <div class="board-wrap board-view">
            <div class="table02-view table02 table-receipt view-receipt first-table">

                <div class="table-title">
                    <h1>강좌정보</h1>
                </div>

                <table class="lecture_table">
                    <tbody>
                    <tr>
                        <th class="w167">강좌명</th>
                        <td><p>{{ $list->subject }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">접수상태</th>
                        <td>
                            @if(is_program_status_auto($list->status_auto))
                                <p>{{ get_program_status_lists(get_status_type($list)) }}</p>
                            @else
                                <p>{{ get_program_status_lists($list->status) }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w167">강사명</th>
                        <td><p>{{ $list->teacher_name }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">접수일시</th>
                        <td><p>{{ date("y-m-d H:i", strtotime($list->start_reception_date . ' ' . $list->start_reception_time)) .' ~ ' . date("y-m-d H:i", strtotime($list->end_reception_date . ' ' . $list->end_reception_time))}}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">수강일시</th>
                        <td><p>{{ $list->start_course_date ? date("y-m-d H:i", strtotime($list->start_course_date . ' ' . $list->start_course_time)) .' ~ ' . date("y-m-d H:i", strtotime($list->end_course_date . ' ' . $list->end_course_time)) : '-'}}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">수강장소</th>
                        <td><p>{{ $list->location }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">수강인원</th>
                        <td><p>
                            @php
                                if($list->number_students) {
                                    echo number_format(filter_var($list->number_students));
                                }else {
                                    echo '-';
                                }
                            @endphp
                            <span class="num_cnt_unit">명</span>
                        </p></td>
                    </tr>
                    <tr>
                        <th class="w167">교육대상</th>
                        <td><p>{{ get_program_education_target_lists($list->education_target) }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">재학생</th>
                        <td><p>{{ get_program_student_grade_lists($list->student_grade) }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">교재</th>
                        <td><p>{{ $list->text_book ? $list->text_book : '-' }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">수강료</th>
                        <td><p>
                            <p>{{ $list->tuition_fees ? $list->tuition_fees : '-' }} <span class="num_cnt_unit">원</span></p>
                        </p></td>
                    </tr>
                    </tbody>
                </table>

            </div>

            <div class="view-content pdt30">
                <div class="ck ck-editor__main" role="presentation">
                    <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline view" lang="ko" dir="ltr">
                        {!! dongaDomainChange(stripslashes($list->contents)) ?? "" !!}
                    </div>
                </div>
            </div>{{-- //.view-content end --}}

            <div class="table02-view table02 table-receipt view-receipt">
                <div class="table-title">
                    <h1>입금수단</h1>
                </div>

                <table class="deadline_table">
                    <tbody>
                    <tr>
                        <th class="w167">입금 마감일시</th>
                        <td><p>{{ $list->deadline_date ? $list->deadline_date . ' ' . $list->deadline_time : '-'}}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">은행명</th>
                        <td><p>{{ $list->bank_name ? get_bank_lists($list->bank_name) : '-' }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">예금주</th>
                        <td><p>{{ $list->account_holder ? $list->account_holder : '-' }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">계좌번호</th>
                        <td><p>{{ $list->account_number ? $list->account_number : '-' }}</p></td>
                    </tr>
                </table>
            </div>

            <div class="apply-wrap">
                <button type="button" class="btn02 btn-application" {{ $result['disabled'] }}  data-type="{{ session()->get('donga_type') }}">
                    {{ $result['msg']  }}
                </button>
            </div>

            <div class="view-bottom">
                <div class="btn-others">
                    @if ($prev_list)
                        <a href="/program/receipt/{{ $prev_list->id }}/view" class="prev-view switch-view-page">
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
                        <a href="/program/receipt/{{ $next_list->id }}/view" class="next-view switch-view-page">
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
                        <a href="javascript:void(0)" class="btn-scrap btn01" onclick="__common.scrap({{ $list->id }}, '프로그램접수', '{{ $list->subject }}')">스크랩</a>
                        <a href="/program/receipt" class="btn-list btn01">목록</a>
                    </div>
                </div>
            </div>{{-- //.view-bottom end --}}

        </div>{{-- //.board-wrap end --}}
        </form>
    </div>{{-- //.sub-content end --}}

@endsection
