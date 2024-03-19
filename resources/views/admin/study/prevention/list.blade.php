@extends("layouts.admin")

@section("title")
    동아대 관리자 - 스터디룸 예약금지날짜 관리
@endsection

@push('scripts')
    <script defer src="/js/admin/board.js"></script>
@endpush

@section("content")
    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>스터디룸 예약금지날짜 관리</h1>
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


        <article id="" class="table03">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/study/prevention">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="10%">
                        <col width="30%">
                        <col width="20%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="check_all" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>명칭</th>
                        <th>금지시작날짜</th>
                        <th>금지종료날짜</th>
                        <th>등록날짜</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                       <tr>
                           <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                           <td>{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() )  }}</td>
                           <td><a href="/{{ ADMIN_URL }}/study/prevention/{{ $list->id }}/edit">{{ $list->name }}</a></td>
                           <td>{{ $list->day }}</td>
                           <td>{{ $list->end_day }}</td>
                           <td>{{ date('Y-m-d', strtotime($list->created_at)) }}</td>
                       </tr>
                    @empty
                        <tr>
                            <td colspan="5">내역이 존재하지 않습니다.</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </form>

            <div class="paging-wrap">

            </div>

        </article> <!-- article list_contents end -->

    </section>
@endsection



