@extends("layouts/admin")

@section("title")
    동아대 관리자 - 로그 내역
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>
@endpush

@section("content")
    @php
        //dd($category);
         if($_REQUEST['category']){
     //        var_dump(1);
             $data_type = '?data_type=3';
         }else{
     //        var_dump(2);
             $data_type = '?data_type=';
             //$campus = ($_REQUEST['campus'] != 'undefined' && $_REQUEST['campus'] != '') ? '&campus='.$_REQUEST['campus'] : '&campus=';
         }
            // $term = ($_REQUEST['term'] != 'undefined' && $_REQUEST['term'] != '') ? '&term='.$_REQUEST['term'] : '';
         //dd($url);
    @endphp

    <section class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>로그</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀"
                                    data-url="/download/log/{{$category}}{{$data_type}}"
                                    data-from="{{$from}}"
                                    data-to="{{$to}}">엑셀출력
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="campus_info">
                <span class="{{ $category == ''  || $category == 'all'? 'active' : '' }}"
                      onclick="location.href='?category=all&from={{$from}}&to={{$to}}'">전체</span>
                <span class="{{ $category == 'connect'? 'active' : '' }}"
                      onclick="location.href='?category=connect&from={{$from}}&to={{$to}}'">관리자 접속기록</span>
                <span class="{{ $category == 'change'? 'active' : '' }}"
                      onclick="location.href='?category=change&from={{$from}}&to={{$to}}'">관리자 권한변경로그</span>
                <span class="{{ $category == 'excel'? 'active' : '' }}"
                      onclick="location.href='?category=excel&from={{$from}}&to={{$to}}'">엑셀 다운로드기록</span>
            </div>

            <form method="get">
                <input type="hidden" name="category" value="{{$category}}">
                <div style="float: right">
                    <input type="date" name="from" class="schedule_box" value="{{$from}}">
                    <input type="date" name="to" class="schedule_box" value="{{$to}}">
                    <button type="submit" id="" class="search_btn">검색</button>
                </div>
            </form>
        </article> <!-- article list_head end -->

        <article id="list_contents" class="table03" style="overflow-x: auto;">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/study/reservation">
                @csrf
                @method("put")
                <table class="member-list in-input table-2x-large">
                    <colgroup>
                        <col width="5%">
                        <col width="13%">
                        <col width="13%">
                        <col width="16%">
                        <col width="16%">
                        <col width="16%">
                        <col width="15%">
                        @if($category == 'change')
                            <col width="15%">
                        @endif
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="check_all" name="check_all" value="1">
                            <label for="check_all"></label>
                        </th>
                        <th>수행업무</th>
                        @if($category == 'change')
                            <th>작업자ID(이름)</th>
                        @endif
                        @if($category == 'connect')

                        @endif
                        <th>대상자ID(이름)</th>
                        @if($category == 'change')
                            <th>변경전 권한</th>
                            <th>변경후 권한</th>
                        @elseif($category == 'excel')
                            <th>사유</th>
                        @else
                            <th>처리한정보주체</th>
                        @endif
                        <th>로그값(출력사유)</th>
                        @if($category != 'change')
                            <th>IP</th>
                        @endif
                        <th>작업일시</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($lists as $list)
                        @php

                            $before_menu = '-';
                            $after_menu = '-';


                          if(isLogAuthority($list->action)) {



                              if($category == 'change' && $list->keyword) {
                                  $menu = explode('/', $list->keyword);


                                  $before_menu = [];
                                  foreach (explode(',', $menu[0]) as $val) {
                                      $before_menu[] = get_admin_menu_list($val);
                                  }

                                  $after_menu = [];
                                  foreach (explode(',', $menu[1]) as $val) {
                                      $after_menu[] = get_admin_menu_list($val);
                                  }

                                 $before_menu = implode(',', $before_menu);
                                 $after_menu = implode(',', $after_menu);
                              } else {
                                  $list->keyword = '';
                              }
                          }

                        @endphp

                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>
                                {{ $list->action ?: '-'}}
                            </td>
                            @if($category == 'change')
                                <td>
                                    {{   App\Models\User::find($list->user_id) ? App\Models\User::find($list->user_id)->account .'(' . App\Models\User::find($list->user_id)->name .')' : $list->user_id .'(-)'  }}
                                </td>
                            @endif
                            <td>
                                {{  App\Models\User::getExists($list->target) ? $list->target .'(' . App\Models\User::getUser($list->target)->name .')' : $list->target .'(-)' }}
                            </td>

                            @if($category == 'change')
                                <td title="{{ $before_menu }}">
                                    {{ $before_menu }}
                                </td>
                                <td title="{{ $after_menu }}">
                                    {{$after_menu }}
                                </td>
                            @else
                                <td>
                                    {{ $list->keyword ?: '-' }}
                                </td>
                            @endif

                            <td title="{{  $list->comment }}">
                                {{ $list->comment ?: '-'}}
                            </td>

                            @if($category != 'change')
                                <td>
                                    {{ $list->ip }}
                                </td>
                            @endif

                            <td>
                                {{ date("Y-m-d H:i:s", strtotime($list->created_at)) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100">내역이 존재하지 않습니다.</td>
                        </tr>
                    @endforelse
                </table>
            </form>


            <div class="paging-wrap">
                {{ $lists->appends(['category' => $category, 'to' => $to, 'from' => $from])->links("vendor.pagination.default") }}
            </div>

        </article> <!-- article list_contents end -->
    </section>

@endsection
