@extends("layouts.admin")

@section("title")
    동아대 관리자 - 면접교육 신청자 관리
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>
    <script defer src="/js/admin/support/interview/list.js"></script>
@endpush

@php
    use App\Models\Student;
    use App\Models\User;
@endphp

@section("content")
    <style>
        i {margin-left: 5px;}
        th {cursor: pointer}
    </style>

    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>신청자 관리</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-url="/download/support/interview">엑셀출력</button>
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
                            <option value="name" {{ isset($search) && $search['search'] == 'name' ? 'selected' : '' }}>이름</option>
                            <option value="user_id" {{ isset($search) && $search['search'] == 'account' ? 'selected' : '' }}>학번</option>
                            <option value="enterprise" {{ isset($search) && $search['search'] == 'company_name' ? 'selected' : '' }}>지원기업</option>
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
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/support/interview">
                <input type="hidden" name="orderBy" value="{{ $orderBy }}">
                <input type="hidden" name="column" value="{{ $column }}">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="8%">
                        <col width="8%">
                        <col width="40%">
                        <col width="8%">
                        <col width="15%">
                        <col width="5%">
                        <col width="8%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th class="sort_group">번호<i class="fas fa-sort"></i></th>
                        <th class="sort_group">이름<i class="fas fa-sort"></i></th>
                        <th class="sort_group">학번<i class="fas fa-sort"></i></th>
                        <th class="sort_group">지원기업<i class="fas fa-sort"></i></th>
                        <th>지원구분<i class="fas fa-sort"></i></th>
                        <th>지원사업부<i class="fas fa-sort"></i></th>
                        <th class="sort_group">상태<i class="fas fa-sort"></i></th>
                        <th class="sort_group">작성일<i class="fas fa-sort"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{ $lists->currentpage() * $loop->index + 1}}</td>
                            <td>
                                {{ Student::getStudent($list->user_id) ? Student::getStudent($list->user_id)->name : '-' }}
                            </td>
                            <td>{{ $list->user_id }}</td>
                            <td><a href="/{{Route::current()->uri . '/'. $list->id }}/edit">{{$list->enterprise}}</a></td>
                            <td>{{ get_interview_category($list->category) }}</td>
                            <td>{{ ($list->support_division) }}</td>
                            <td>
                                @if($list->status == 100)
                                    <a href="/mypage/interview/{{ $list->id }}/result">미입력</a>
                                @elseif($list->status == 200)
                                    <span>합격</span>
                                @elseif($list->status == 300)
                                    <span class="slip">불합격</span>
                                @endif
                            </td>
                            <td>{{ date('Y-m-d', strtotime($list->created_at)) }}</td>
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
