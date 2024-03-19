@extends("layouts.admin")

@section("title")
    동아대 관리자 - 프로그램 신청자 관리
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>
    <script defer src="/js/admin/support/program/list.js"></script>
@endpush

@php
    $open_list = get_program_open_lists();
@endphp


@section("content")
    <style>
        i {margin-left: 5px;}
        th {cursor: pointer}
    </style>

    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>프로그램 및 신청자 관리</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        {{--<li>--}}
                            {{--<button class="btn-black-middle" id="" data-name="수정">선택수정</button>--}}
                        {{--</li>--}}
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-url="/download/support/program">엑셀출력</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnregister" data-name="등록">신규등록</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="search-wrap">
                <form action="" method="get" name="search-form">
                    <div class="search-con search-date">
                        <select name="search" class="search-case" required="">
                            <option value="subject" {{ isset($search) && $search['search'] == 'subject' ? 'selected' : '' }}>강좌명</option>
                        </select>
                        <div class="search-input">
                            <input type="text" name="term" class="w319" value="{{ $search['term'] }}" placeholder="" style="margin-top: 5px">
                            <input type="date" name="from" class="schedule_box" value="{{$search['from']}}" style="width: 150px;margin-top: 5px">
                            <input type="date" name="to" class="schedule_box" value="{{$search['to']}}" style="width: 150px;margin-top: 5px">
                            <button data-name="검색" type="submit" style="margin-top: 5px">검색</button>
                        </div>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->

        <article class="table03">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/support/program">
                <input type="hidden" name="orderBy" value="{{ $orderBy }}">
                <input type="hidden" name="column" value="{{ $column }}">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="30%">
                        <col width="10%">
                        <col width="8%">
                        <col width="13%">
                        <col width="13%">
                        <col width="5%">
                        <col width="5%">
                        <col width="8%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호<i class="fas fa-sort"></i></th>
                        <th>강좌명<i class="fas fa-sort"></i></th>
                        <th>수강장소<i class="fas fa-sort"></i></th>
                        <th>수강인원<i class="fas fa-sort"></i></th>
                        <th>수강일시<i class="fas fa-sort"></i></th>
                        <th>접수일시<i class="fas fa-sort"></i></th>
                        <th>공개여부<i class="fas fa-sort"></i></th>
                        <th>자동여부<i class="fas fa-sort"></i></th>
                        <th>접수상태<i class="fas fa-sort"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{ $lists->currentpage() * $loop->index + 1}}</td>
                            <td class="text_left_wrap"><a href="/{{Route::current()->uri . '/'. $list->id }}/view">{{$list->subject}}</a></td>
                            <td>{{ $list->location }}</td>
                            <td>{{ $list->number_students }}명</td>
                            <td>{{date("y-m-d", strtotime($list->start_course_date)) .' ~ '. date("y-m-d", strtotime($list->end_course_date))}}</td>
                            <td>{{date("y-m-d", strtotime($list->start_reception_date)) .' ~ '. date("y-m-d", strtotime($list->end_reception_date))}}</td>
                            <td>
                                {{--<select name="open" id="" class="open_staus">--}}
                                    {{--<option class="" value="" {{ $list->open == 1? 'selected' : '' }}>공개</option>--}}
                                    {{--<option class="" value="" {{ $list->open == 0? 'selected' : '' }}>비공개</option>--}}
                                {{--</select>--}}
                                {{ get_program_open_lists($list->open) }}
                            </td>
                            <td>{{ get_program_status_auto_lists($list->status_auto) }}</td>
                            <td>
                                @if(is_program_status_auto($list->status_auto))
                                    <p class="status0{{get_status_type($list)}}">{{ get_program_status_lists(get_status_type($list)) }}</p>
                                @else
                                    <p class="status0{{$list->status}}">{{ get_program_status_lists($list->status) }}</p>
                                @endif
                            </td>
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
                {{ $lists->appends(['search' => $search['search'], 'term' => $search['term'], 'to' => $search['to'], 'from' => $search['from']])->links("vendor.pagination.default") }}
            </div>
        </article> <!-- article list_contents end -->
    </section>
@endsection
