@extends("layouts.admin")

@section("title")
    동아대 관리자 - 동아친화기업 300 관리
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>

@endpush

@section("content")
    @php
      $status_list = get_notice_status();
    @endphp
    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>동아친화기업 300 관리</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        {{--<li>--}}
                            {{--<button class="btn-black-middle" id="btnedit">선택수정</button>--}}
                        {{--</li>--}}
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
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/jobinfo/donga300">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="5%">
                        <col width="8%">
                        <col width="57%">
                        <col width="9%">
                        <col width="9%">
                        <col width="12%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>제목</th>
                        <th>공지여부</th>
                        <th>취업자</th>
                        <th>작성일</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>
                                @if(1 <= $list->status_id )
                                    <p>{{ get_notice_status($list->status_id) }}</p>
                                @else
                                    {{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}
                                @endif
                            </td>
                            <td class="text_left_wrap"><a href="/{{Route::current()->uri . '/'. $list->id }}/edit">{{ $list -> subject }}</a></td>
                            <td>
{{--                                <select name="" id="" class="notice_select_box">--}}
{{--                                    @foreach($status_list as $key => $val)--}}
{{--                                        <option value="$key"  {{ $key == $list->status_id ? 'selected' : '' }}>{{$val}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                {{ $list->status_id == 1 ? '공지' : '비공지' }}
                            </td>
                            <td>{{ $list->cnt_employed }} <span>명</span></td>
                            <td>{{ date('y-m-d', strtotime( $list -> created_at )) }}</td>
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
