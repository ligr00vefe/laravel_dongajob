@extends("layouts.admin")

@section("title")
    동아대 관리자 - 공지사항 관리
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
                <h1>공지사항 관리</h1>
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
                            <input type="text" name="term" class="w319" value="{{ $search['term'] }}" placeholder="" style="margin-top: 5px">
                            <input type="date" name="from" class="schedule_box" value="{{$search['from']}}" style="width: 150px">
                            <input type="date" name="to" class="schedule_box" value="{{$search['to']}}" style="width: 150px">
                            <button data-name="검색" type="submit"  style="margin-top: 5px">검색</button>
                        </div>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->

        <article class="table03">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/notice">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="18%">
                        <col width="46%">
                        <col width="8%">
                        <col width="8%">
                        <col width="12%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>카테고리</th>
                        <th>제목</th>
                        <th>공지여부</th>
                        <th>작성자</th>
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
                            <td>{{get_notice_category($list->category_id)}}</td>
                            <td class="text_left_wrap"><a href="/{{Route::current()->uri . '/'. $list->id }}/edit">{{$list->subject}}</a></td>
                            <td>
{{--                                <select name="" id="" class="notice_select_box">--}}
{{--                                    @foreach($status_list as $key => $val)--}}
{{--                                        <option value="$key"  {{ $key == $list->status_id? 'selected' : '' }}>{{$val}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                {{ get_notice_status($list->status_id) }}
                            </td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->created_at}}</td>
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
                {{ $lists->appends(['subject' => $search['search'], 'term' => $search['term'], 'to' => $search['to'], 'from' => $search['from']])->links("vendor.pagination.default") }}
            </div>
        </article> <!-- article list_contents end -->
    </section>
@endsection
