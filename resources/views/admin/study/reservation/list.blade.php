@extends("layouts/admin")

@section("title")
    동아대 관리자 - 스터디룸 예약리스트
@endsection

@push('scripts')
    <script src="/js/admin/board.js"></script>
@endpush

@section("content")
    @php
    //dd($_REQUEST);
    if($_REQUEST){
        $campus = ($_REQUEST['campus'] != 'undefined' && $_REQUEST['campus'] != '') ? '?campus='.$_REQUEST['campus'] : '?campus=';
        $room = ($_REQUEST['room'] != 'undefined' && $_REQUEST['room'] != '') ? '&room='.$_REQUEST['room'] : '&room=';
        $type = ($_REQUEST['type'] != 'undefined' && $_REQUEST['type'] != '') ? '&type='.$_REQUEST['type'] : '&type=';
        $date = ($_REQUEST['date'] != 'undefined' && $_REQUEST['date'] != '') ? '&date='.$_REQUEST['date'] : '&date=';
        $schedule_date = ($_REQUEST['schedule_date'] != 'undefined' && $_REQUEST['schedule_date'] != '') ? '&schedule_date='.$_REQUEST['schedule_date'] : '&schedule_date=';
        $schedule_end_date = ($_REQUEST['schedule_end_date'] != 'undefined' && $_REQUEST['schedule_end_date'] != '') ? '&schedule_end_date='.$_REQUEST['schedule_end_date'] : '&schedule_end_date=';
        $keyword = ($_REQUEST['keyword'] != 'undefined' && $_REQUEST['keyword'] != '') ? '&keyword='.$_REQUEST['keyword'] : '&keyword=';
        $term = ($_REQUEST['term'] != 'undefined' && $_REQUEST['term'] != '') ? '&term='.$_REQUEST['term'] : '&term=';
        $tata_type = '1';
    }else{
        $tata_type = '';
    }
    @endphp

    <section class="list_wrapper">

        <article id="list_head">

            <div class="head-info">
                <h1>스터디룸 예약리스트</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                        {{--<li>--}}
                            {{--<button class="btn-black-middle" id="btnedit">선택수정</button>--}}
                        {{--</li>--}}
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="스터디엑셀{{$tata_type}}"  data-url="/download/room/reservation{{$campus ?? ''}}{{$room ?? ''}}{{$type ?? ''}}{{$date ?? ''}}{{$schedule_date ?? ''}}{{$schedule_end_date ?? ''}}{{$keyword ?? ''}}{{$term ?? ''}}">엑셀출력</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnregister" data-name="등록">신규등록</button>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="table02">
                <form action="" name="search_form">
                <table>
                    <tr>
                        <th>캠퍼스</th>
                        <td class="radio_button_wrap">
                            <input type="radio" id="campus-all" name="campus" class="radio_txtbox" value="all" {{ $search['campus'] == ''? 'checked' : '' }}>
                            <label for="campus-all" class="radio_button_txt">전체</label>
                            <input type="radio" id="campus-seunghak" name="campus" class="radio_txtbox" value="1" {{ $search['campus'] == '1'? 'checked' : '' }}>
                            <label for="campus-seunghak" class="radio_button_txt">승학 캠퍼스</label>
                            <input type="radio" id="campus-bumin" name="campus" class="radio_txtbox" value="2" {{ $search['campus'] == '2'? 'checked' : '' }}>
                            <label for="campus-bumin" class="radio_button_txt">부민 캠퍼스</label>
                        </td>
                    </tr>
                    <tr>
                        <th>스터디룸</th>
                        <td>
                            <input type="text" class="serch_textbox" name="room" value="{{ $search['room'] }}">
                        </td>
                    </tr>
                    <tr>
                        <th>구분</th>
                        <td class="radio_button_wrap">
                            <input type="radio" id="category-all" name="type" class="radio_txtbox" value="all"  {{ $search['type'] == ''? 'checked' : '' }}>
                            <label for="category-all" class="radio_button_txt">전체</label>
                            <input type="radio" id="category-student" name="type" class="radio_txtbox" value="1"  {{ $search['type'] == 1? 'checked' : '' }}>
                            <label for="category-student" class="radio_button_txt">학생</label>
                            <input type="radio" id="category-manager" name="type" class="radio_txtbox" value="2"  {{ $search['type'] == 2? 'checked' : '' }}>
                            <label for="category-manager" class="radio_button_txt">관리자</label>
                        </td>
                    </tr>
                    <tr>
                        <th>일시</th>
                        <td class="serch_input_box">
                            <select name="date" id="" class="search-case">
                                <option value="application">신청일</option>
                                <option value="reservation">예약일</option>
                            </select>
                            <input type="date" name="schedule_date" class="schedule_box" value="{{ $search['schedule_date'] }}">~
                            <input type="date" name="schedule_end_date" class="schedule_box" value="{{ $search['schedule_end_date'] }}">
                        </td>
                    </tr>
                    <tr>
                        <th>키워드</th>
                        <td class="serch_input_box">
                            <div class="search-input">
                                <select name="keyword" id="" class="search-case">
                                    <option value="name" {{ $search['keyword'] == 'name'? 'selected' : '' }}>이름</option>
                                    <option value="account" {{ $search['keyword'] == 'account'? 'selected' : '' }}>학번</option>
                                </select>
                                <input type="text" name="term" class="serch_textbox" value="{{ $search['term'] }}">
                                <button type="submit" class="serch_button">검색</button>
                            </div>
                        </td>
                    </tr>
                </table>
                </form>
            </div>

        </article> <!-- article list_head end -->

        <article id="list_contents" class="table03" style="overflow-x: auto;">
            <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/study/reservation">
                @csrf
                @method("delete")
                <table class="member-list in-input table-2x-large">
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="10%">
                        <col width="18%">
                        <col width="10%">
                        <col width="15%">
                        <col width="5%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                        <col width="5%">
                        <col width="5%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="check_all" name="check_all" value="1">
                            <label for="check_all"></label>
                        </th>
                        <th>번호</th>
                        <th>캠퍼스</th>
                        <th>스터디룸</th>
                        <th>신청일시</th>
                        <th>예약일시</th>
                        <th>사용인원</th>
                        <th>이름</th>
                        <th>학번</th>
                        <th>학부(과)</th>
                        <th>입력자</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lists as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td><a href="/{{ ADMIN_URL }}/study/reservation/{{ $list->id }}/edit"> {{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</a></td>
                            <td><a href="/{{ ADMIN_URL }}/study/reservation/{{ $list->id }}/edit">{{ get_campus_name($list->campus_id) }}캠퍼스</a></td>
                            <td><a href="/{{ ADMIN_URL }}/study/reservation/{{ $list->id }}/edit">{{ $list->room_name }}</a></td>
                            <td><a href="/{{ ADMIN_URL }}/study/reservation/{{ $list->id }}/edit">{{ date('Y-m-d', strtotime($list->created_at)) }}</a></td>
                            <td><a href="/{{ ADMIN_URL }}/study/reservation/{{ $list->id }}/edit">{{ $list->reservatio_date }}</a></td>
                            <td>{{ $list->use_people ? str_replace('명', '', $list->use_people).'명' : '-' }}</td>
                            <td>{{ $list->student_name ?: '-' }}</td>
                            <td>{{ $list->account ?: '-' }}</td>
                            <td>{{ $list->department ?: '-' }}</td>
                            <td>{{ $list->target_type ?: '-' }}</td>
                            <td>{!! $list->status ?: '-' !!}</td>
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
                {{ $lists->appends([
                'campus' => $search['campus'],
                'room' => $search['room'],
                'type' => $search['type'],
                'date' => $search['date'],
                'schedule_date' => $search['schedule_date'],
                'schedule_end_date' => $search['schedule_end_date'],
                'keyword' => $search['keyword'],
                'term' => $search['term']
        ])->links("vendor.pagination.default") }}
            </div>

        </article> <!-- article list_contents end -->
    </section>

@endsection



