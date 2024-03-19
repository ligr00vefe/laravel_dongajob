@extends("layouts.admin")

@section("title")
    환경설정 -  메뉴등록
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>
@endpush

@section("content")
    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>메뉴관리</h1>
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
        </article> <!-- article list_head end -->

        <!-- 승학 캠퍼스 -->
        <article id="seunghak" class="table03" data-campus="승학">
            <form action="/{{ Route::current()->uri  }}/delete_all" method="post" name="forms">
                @csrf
                @method("delete")
                <table>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>메뉴명</th>
                        <th>사용여부</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{ $list->id }}</td>
                            <td><a href="/{{ Route::current()->uri . '/' . $list->id }}/edit">{{ $list->name }}</a></td>
                            <td>{!! show_use_data($list->use, 'html') !!}</td>
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
