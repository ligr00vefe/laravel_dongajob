@extends("layouts.admin")

@section("title")
    동아대 관리자 - 팝업 관리
@endsection

@push('scripts')
    <script src="/js/admin/board.js"></script>
@endpush

@section("content")
    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>팝업 관리</h1>
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


        <article class="table03">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/popup/info">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="5%">
                        <col width="5%">
                        <col width="20%">
                        <col width="8%">
                        <col width="15%">
                        <col width="15%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>제목</th>
                        <th>접속기기</th>
                        <th>시작일시</th>
                        <th>종료일시</th>
                        <th>시간</th>
                        <th>Left</th>
                        <th>Top</th>
                        <th>Width</th>
                        <th>Height</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{$list->id}}</td>
                            <td><a href="/{{ ADMIN_URL }}/{{ $path }}/{{ $list->id }}/edit">{{$list->subject}}</a></td>
                            <td>{{$list->device}}</td>
                            <td>{{$list->start_time}}</td>
                            <td>{{$list->end_time}}</td>
                            <td>{{$list->disable_hours}}</td>
                            <td>{{$list->left}}</td>
                            <td>{{$list->top}}</td>
                            <td>{{$list->height}}</td>
                            <td>{{$list->width}}</td>
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
                {{--{{ $lists->links("vendor.pagination.default") }}--}}
            </div>
        </article> <!-- article list_contents end -->

    </section>
@endsection
