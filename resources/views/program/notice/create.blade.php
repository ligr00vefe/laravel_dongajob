
@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 공지사항
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "공지사항";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>공지사항</h1>
        </div>

        <div class="board-wrap board-list">
            <div class="search-box">
                <select name="search-cate" id="">
                    <option value="sch-all">전체</option>
                    <option value="sch-subject">제목</option>
                    <option value="sch-name">취업자</option>
                </select>
                <input type="text" value="" class="input-search">
                <button class="btn-search">검색</button>
            </div>

            <div class="table-head">
                <span class="list-count">
                    총 <strong>290</strong>건의 동아친화기업이 있습니다.
                </span>
                <select name="view-item-count" id="">
                    <option value="10">10개씩</option>
                    <option value="30">30개씩</option>
                    <option value="60">60개씩</option>
                </select>
            </div>

            <div class="list-warp table01">
                <form action="" method="post" name="memberUpdate">
                    @csrf
                    @method("put")
                    <table class="member-list in-input table-2x-large">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="check_all" name="check_all" value="1">
                                <label for="check_all"></label>
                            </th>
                            <th>번호</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일</th>
                            <th>조회</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $lists = 10; ?>
                        @for ($list = 0; $list < $lists; $list++ )
                            <tr>
                                <td class="td_chk">
                                    {{--                            <input type="hidden" name="target_key[{{$list->id}}]" value="{{ $helper->target_key }}">--}}
                                    <input type="checkbox" name="check[]" id="check_{ {$list }}" value="{{ $list }}" class="user_checked">
                                    <label for="check_{{ $list }}"></label>

                                    {{--                            <input type="checkbox" id="check_{{$i}}" name="id[]" value="{{$list->id}}">--}}
                                    {{--                            <label for="check_{{$i}}"></label>--}}
                                </td>
                                <td class="td_num">{{ $list }}</td>
                                <td class="td_subject">
                                    <a href="{{ ADMIN_URL }}/notice/view/{{ $list }}">
                                        {{ $list }}
                                    </a>
                                </td>
                                <td class="td_userId">
                                    <span>{{ $list }}</span>
                                </td>
                                <td class="td_createdAt">
                                    <span>{{ $list }}</span>
                                </td>
                                <td class="td_hit">
                                    <span>{{ $list }}</span>
                                </td>
                            </tr>
                        @endfor
                        {{--@if ($lists->isEmpty())--}}
                            {{--<tr>--}}
                                {{--<td colspan="17">데이터가 없습니다.</td>--}}
                            {{--</tr>--}}
                        {{--@endif--}}
                        </tbody>
                    </table>

                    <div class="btn-wrap create-btn">
                        <a href="/jobinfo/activity" class="btn-cancel btn02">취소</a>
                        <a href="/jobinfo/donga300/write" class="btn-register btn02">등록</a>
                    </div>

                </form>
            </div>{{-- //.table01 end --}}

            <article id="list_bottom">
                {!! pagination2(10, ceil($paging/15)) !!}
            </article> <!-- article list_bottom end -->

        </div>
    </div>

@endsection
