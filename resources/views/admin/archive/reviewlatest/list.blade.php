@extends("layouts.admin")

@section("title")
    동아대 관리자 - 최신 취업수기(최근5년) 관리
@endsection

@push("scripts")
    <script defer src="/js/admin/board.js"></script>
@endpush

@section("content")
    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>최신 취업수기(최근5년)</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btnmove" data-name="이동">선택이동</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-url="/download/archive/reviewlatest">엑셀출력</button>
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
                            <option value="subject" {{ isset($search) && $search['search'] == 'subject' ? 'selected' : '' }}>제목</option>
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
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/archive/reviewlatest">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="5%">
                        <col width="8%">
                        <col width="10%">
                        <col width="12%">
                        <col width="40%">
                        <col width="15%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>이름</th>
                        <th>학과(부)</th>
                        <th>제목</th>
                        <th>작성일</th>
                        <th>비고</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->dpt }}</td>
                            <td class="td_subject"><a href="/{{Route::current()->uri . '/'. $list->id }}/edit">{{$list->subject}}</a></td>
                            <td>{{ date('Y-m-d', strtotime( $list -> created_at )) }}</td>
                            <td><a href="/{{Route::current()->uri . '/'. $list->id }}/edit" class="btn-modified">수정</a></td>
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
