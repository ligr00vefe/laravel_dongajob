@extends("layouts.admin")

@section("title")
    동아대 관리자 - 추천채용 관리
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>
@endpush

@section("content")

    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>추천채용 관리</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-url="/download/jobinfo/recommend">엑셀출력</button>
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
                        <select name="keyword" class="search-case" required="">
                            <option value="company_name" {{ isset($search) && $search['keyword'] == 'company_name' ? 'selected' : '' }}>기업명</option>
                            <option value="recruitment_field" {{ isset($search) && $search['keyword'] == 'recruitment_field' ? 'selected' : '' }}>모집분야</option>
                            {{--<option value="category" {{ isset($search) && $search['keyword'] == 'category' ? 'selected' : '' }}>채용형태</option>--}}
                            {{--<option value="work_area" {{ isset($search) && $search['keyword'] == 'work_area' ? 'selected' : '' }}>근무지역</option>--}}
{{--                            <option value="screening_method" {{ isset($search) && $search['keyword'] == 'screening_method' ? 'selected' : '' }}>접수방법</option>--}}
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
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/jobinfo/recommend">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="5%">
                        <col width="8%">
                        <col width="12%">
                        <col width="26%">
                        <col width="8%">
                        <col width="9%">
                        <col width="12%">
                        <col class="col_datetime" width="10%">
                        <col class="col_datetime" width="10%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>기업명</th>
                        <th>모집분야</th>
                        <th>채용형태</th>
                        <th>근무지역</th>
                        <th>접수방법</th>
                        <th>접수 시작일</th>
                        <th>접수 마감일</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</td>
                            <td>{{$list->company_name}}</td>
                            <td class="text_left_wrap"><a href="/{{Route::current()->uri . '/'. $list->id }}/edit">{{ $list->recruitment_field }}</a></td>
                            <td>{{ get_recommend_recruitment_lists($list->category) }}</td>
                            <td>{{ get_work_area_lists($list->work_area) }}</td>
                            <td>{{ get_recommend_screening_method_lists($list->screening_method) }}</td>
                            <td>{{ $list->receipt_start_date .' '. $list->receipt_start_time}}</td>
                            <td>{{ $list->receipt_end_date .' '. $list->receipt_end_time}}</td>
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
