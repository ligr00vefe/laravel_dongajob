@extends("layouts.admin")

@section("title")
    동아대 관리자 - 프로그램 및 신청자 관리
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>

@endpush

@section("content")
    <section id="board_section" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>프로그램 및 신청자 관리</h1>
            </div>
        </article> <!-- article list_head end -->

        <div class="table02">
            <h2>강좌정보</h2>
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/support/program">
                @csrf
                @if (isset($list))
                    @method("put")
                    <input type="hidden" name="id" value="{{ $list->id }}">
                @endif

                <table>
                    <tr>
                        <th>강좌명</th>
                        <td>{{ $list->subject ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>접수상태 자동여부</th>
                        <td>{{ get_program_status_auto_lists($list->status_auto) }}</td>
                    </tr>
                    <tr>
                        <th>접수상태</th>
                        <td>{{ get_program_status_lists($list->status)  }}</td>
                    </tr>
                    <tr>
                        <th>공개여부</th>
                        <td>{{ get_program_open_lists($list->open) }}</td>
                    </tr>
                    <tr>
                        <th>강사명</th>
                        <td>{{ $list->teacher_name }}</td>
                    </tr>
                    <tr>
                        <th>접수일시</th>
                        <td>{{date("y-m-d H:i", strtotime($list->start_reception_date .' '. $list->start_reception_time)) .' ~ '. date("y-m-d H:i", strtotime($list->end_reception_date.' '.$list->end_reception_time))}}</td>
                    </tr>
                    <tr>
                        <th>수강일시</th>
                        <td>{{ $list->start_course_date ? date("y-m-d H:i", strtotime($list->start_course_date .' '. $list->start_course_time)) .' ~ '. date("y-m-d H:i", strtotime($list->end_course_date.' '.$list->end_course_time)) : '-'}}</td>
                    </tr>
                    <tr>
                        <th>수강장소</th>
                        <td>{{ $list->location ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>수강인원</th>
                        <td>{{ $list->number_students ?? '' }} 명</td>
                    </tr>
                    <tr>
                        <th>대기인원</th>
                        <td>{{ $list->number_waiting ?? '' }} 명</td>
                    </tr>
                    <tr>
                        <th>교육대상</th>
                        <td>{{ get_program_education_target_lists($list->education_target) }}</td>
                    </tr>
                    <tr>
                        <th>재학생</th>
                        <td>{{ get_program_student_grade_lists($list->student_grade) }}</td>
                    </tr>
                    <tr>
                        <th>교재</th>
                        <td>{{ $list->text_book ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>수강료</th>
                        <td>{{ $list->tuition_fees ?? '-' }}원</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="content-box">
                            <div class="ck ck-editor__main" role="presentation">
                                <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline view" lang="ko" dir="ltr">
                                        {!! stripslashes($list->contents) ?? '' !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>


                <div class="head-info">
                    <h2 class="mgt30">입금수단</h2>
                </div>

                <table>
                    <tr>
                        <th>입금 마감일시</th>
                        <td>
                            {{ $list->deadline_date ?? '' }}
                            {{ $list->deadline_time ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>은행명</th>
                        <td>{{  get_bank_lists($list->bank_name) }}</td>
                    </tr>
                    <tr>
                        <th>예금주</th>
                        <td>{{ $list->account_holder ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>계좌번호</th>
                        <td>{{ $list->account_number ?? '' }}</td>
                    </tr>

                </table>

                <div class="btn-wrap">
                    <button type="button"  class="btn01 btn_modify"
                            onclick="location.href='/{{ ADMIN_URL }}/support/program/{{ $list->id }}/edit'">수정
                    </button>
                    <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                    <button type="button" data-name="목록" class="btn01 btn_submit"
                            onclick="location.href='/{{ ADMIN_URL }}/support/program'">목록
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>신청자 명단</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-url="/download/support/programlist?id={{ $list->id }}">엑셀출력</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnregister" data-name="등록">신규등록</button>
                        </li>
                    </ul>
                </div>
            </div>

        </article> <!-- article list_head end -->

        <article class="table03">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/support/applicant">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $list->id }}">
                <input type="hidden" name="status" value="{{ get_program_reservation_status_lists('신청자') }}">

                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="12%">
                        <col width="8%">
                        <col width="10%">
                        <col width="8%">
                        <col width="8%">
                        <col width="10%">
                        <col width="5%">
                        <col width="8%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>신청일시</th>
                        <th>이름</th>
                        <th>전화번호</th>
                        <th>학번</th>
                        <th>대학교</th>
                        <th>학부(과)</th>
                        <th>학년</th>
                        <th>학적</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($applicant_lists as $applicant_list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $applicant_list->id }}"></td>
                            <td>    {{ ($applicant_lists->total()-$loop->index)-(($applicant_lists->currentpage()-1) * $applicant_lists->perpage() ) }}</td>
                            <td>{{ $applicant_list->created_at }}</td>
                            <td>{{ $applicant_list->name }}</td>
                            <td>{{ $applicant_list->phone_number }}</td>
                            <td>{{ $applicant_list->account }}</td>
                            <td>{{ $applicant_list->university }}</td>
                            <td>{{ $applicant_list->department }}</td>
                            <td>{{ $applicant_list->grade }}</td>
                            <td>{{ $applicant_list->academic }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="100">내역이 존재하지 않습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </form>

            <div class="paging-wrap">
                {{ $applicant_lists->links("vendor.pagination.default") }}
            </div>
        </article> <!-- article list_contents end -->
    </section>

    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>대기자 명단</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-url="/download/support/programwaitlist?id={{ $list->id }}">엑셀출력</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnregister" data-name="등록">신규등록</button>
                        </li>
                    </ul>
                </div>
            </div>

        </article> <!-- article list_head end -->

        <article class="table03">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/support/waite">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $list->id }}">
                <input type="hidden" name="status" value="{{ get_program_reservation_status_lists('대기자') }}">

                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="12%">
                        <col width="8%">
                        <col width="10%">
                        <col width="8%">
                        <col width="8%">
                        <col width="10%">
                        <col width="5%">
                        <col width="8%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>신청일시</th>
                        <th>이름</th>
                        <th>전화번호</th>
                        <th>학번</th>
                        <th>대학교</th>
                        <th>학부(과)</th>
                        <th>학년</th>
                        <th>학적</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($waiting_lists as $waiting_list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $waiting_list->id }}"></td>
                            <td> {{ ($waiting_lists->total()-$loop->index)-(($waiting_lists->currentpage()-1) * $waiting_lists->perpage() ) }}</td>
                            <td>{{ $waiting_list->created_at }}</td>
                            <td>{{ $waiting_list->name }}</td>
                            <td>{{ $waiting_list->phone_number }}</td>
                            <td>{{ $waiting_list->account }}</td>
                            <td>{{ $waiting_list->university }}</td>
                            <td>{{ $waiting_list->department }}</td>
                            <td>{{ $waiting_list->grade }}</td>
                            <td>{{ $waiting_list->academic }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="100">내역이 존재하지 않습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </form>

            <div class="paging-wrap">
                {{ $waiting_lists->links("vendor.pagination.default") }}
            </div>
        </article> <!-- article list_contents end -->
    </section>
@endsection
