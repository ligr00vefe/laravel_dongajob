@extends("layouts.admin")

@section("title")
    동아대 관리자 - 지원자 관리
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>
@endpush

@section("content")

    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>지원자 관리</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-id="support"
                                    data-url="/download/jobinfo/support"
                                    data-from="{{$search['from']}}"
                                    data-to="{{$search['to']}}">엑셀출력</button>
                        </li>
{{--                        <li>--}}
{{--                            <button class="btn-black-middle" id="btnregister" data-name="등록">신규등록</button>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </div>

            <div class="search-wrap">
                <form action="" method="get" name="search-form">
                    <div class="search-con search-date">
                        <select name="search" class="search-case" required="">
                            <option value="company_name" {{ isset($search) && $search['search'] == 'company_name' ? 'selected' : '' }}>기업명</option>
                            <option value="name" {{ isset($search) && $search['search'] == 'name' ? 'selected' : '' }}>이름</option>
                            <option value="account" {{ isset($search) && $search['search'] == 'account' ? 'selected' : '' }}>학번</option>
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
            <form action="/{{ ADMIN_URL }}/jobinfo/support" method="post" name="forms" data-route="/{{ ADMIN_URL }}/jobinfo/support">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="7%">
                        <col width="12%">
                        <col width="16%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                        <col width="5%">
                        <col width="5%">
                        <col width="9%">
                        <col width="7%">
                        <col width="7%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                            </th>
                        <th>번호</th>
                        <th>신청일</th>
                        <th>기업명</th>
                        <th>모집분야</th>
                        <th>이름</th>
                        <th>휴대폰번호</th>
                        <th>학번</th>
                        <th>대학교</th>
                        <th>학년</th>
                        <th>전공</th>
                        <th>학적</th>
                        <th>자기소개서</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)

                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>  {{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</td>
                            <td>{{ date('y-m-d', strtotime($list->created_at)) }}</td>
                            <td>{{ $list->company_name }}</td>
                            <td class="text_left_wrap">
                                <a href="/{{ ADMIN_URL }}/jobinfo/support/{{ $list->id }}/edit">{{ $list->recruitment_field }}</a>
                            </td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->phone_number }}</td>
                            <td>{{ $list->account }}</td>
                            <td>{{ $list->university }}</td>
                            <td>{{ $list->grade }}학년</td>
                            <td>{{ $list->department }}</td>
                            <td>{{ $list->academic }}</td>
                            <td>
                                @if($list->attachment1)
                                    <a href="{{ asset('/storage/'. getAttach($list->attachment1)->path) }}" download>다운로드</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100">게시물이 존재하지 않습니다.</td>
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
