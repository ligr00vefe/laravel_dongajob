@extends("layouts.admin")

@section("title")
    동아대 관리자 - 관리자 관리
@endsection

@push('scripts')
    <script src="/js/admin/board.js"></script>
    <script defer src="/js/admin/member/manager/list.js"></script>
@endpush

@php
    use App\Models\AccessLog;
    $accessLog = new AccessLog();
@endphp

@section("content")
    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>관리자 관리</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
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
                            <option value="account" {{  isset($search) && $search['search'] == 'account' ? 'selected' : '' }}>아이디</option>
                            <option value="name" {{  isset($search) && $search['search'] == 'name' ? 'selected' : '' }}>이름</option>
                        </select>
                        <div class="search-input">
                            <input type="text" name="term"  class="w319" value="{{ $search['term'] }}" placeholder="">
                            <button data-name="검색" type="submit">검색</button>
                        </div>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->

        <!-- 승학 캠퍼스 -->
        <article class="table03">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/member/manager">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="5%">
                        <col width="8%">
                        <col width="10%">
                        <col width="20%">
                        <col width="42%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>아이디</th>
                        <th>이름</th>
                        <th>사용가능메뉴</th>
                        <th>제한</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{$list->id}}</td>
                            <td><a href="/{{ ADMIN_URL }}/member/manager/{{ $list->id }}/edit">{{$list->account}}</a></td>
                            <td>{{$list->name}}</td>
                            <td>{{ get_admin_menu_list($list->menu) }}</td>
                            <td>
                                <select name="limit" id="" data-id="{{ $list->id }}">
                                    <option value="1" {{ $accessLog->isAccessCheck($list->account) ? '' : 'selected' }}>허용</option>
                                    <option value="2" {{ $accessLog->isAccessCheck($list->account) ? 'selected' : '' }}>제한</option>
                                </select>
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
                {{ $lists->links("vendor.pagination.default") }}
            </div>
        </article> <!-- article list_contents end -->

    </section>
@endsection



