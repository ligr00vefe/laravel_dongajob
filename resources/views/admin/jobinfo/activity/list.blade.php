@extends("layouts.admin")

@section("title")
    동아대 관리자 - 각종활동 관리
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>
@endpush

@section("content")

    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>각종활동 관리</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-url="/download/jobinfo/activity">엑셀출력</button>
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
                            <option value="company_name" {{ isset($search) && $search['search'] == 'company_name' ? 'selected' : '' }}>기업명</option>
                            <option value="recruitment_field" {{ isset($search) && $search['search'] == 'recruitment_field' ? 'selected' : '' }}>채용분야</option>
{{--                            <option value="work_area" {{ isset($search) && $search['search'] == 'work_area' ? 'selected' : '' }}>근무지역</option>--}}
                        </select>
                        <div class="search-input">
                            <input type="text" name="term" class="w319" value="{{ $search['term'] }}" placeholder="">
                            <button data-name="검색" type="submit">검색</button>
                        </div>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->

        <article class="table03">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/jobinfo/activity">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="18%">
                        <col width="34%">
                        <col width="8%">
                        <col width="10%">
                        <col class="col_datetime" width="12%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>기업명</th>
                        <th>채용분야</th>
                        <th>근무지역</th>
                        <th>성별/나이</th>
                        <th>접수 마감일</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td>
                                <input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}">
                            </td>
                            <td>{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</td>
                            <td>{{ $list -> company_name ?? "" }}</td>
                            <td class="text_left_wrap"><a href="/{{Route::current()->uri . '/'. $list->id ?? ""}}/edit">{{ $list -> recruitment_field ?? ""}}</a></td>
                            <td>{{ get_work_area_lists($list->work_area ?? "") }}</td>
                            <td>{{ get_activity_gender_lists($list->gender_field) . '/' . $list->age_field ?? ""}}</td>
                            <td>{{ $list->receipt_end_date ?? "" .' '. $list->receipt_end_time ?? "" }}</td>
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
                {{ $lists->links("vendor.pagination.default") }}
            </div>
        </article> <!-- article list_contents end -->
    </section>
@endsection
