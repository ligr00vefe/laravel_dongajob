@extends("layouts.admin")

@section("title")
    동아대 관리자 - 스터디룸 예약리스트
@endsection

@push('scripts')
    <script defer src="/js/admin/study/reservation/create.js"></script>
@endpush

@section("content")
@php
    $time_list = study_room_time_range();
    $status_lists = get_room_status();
@endphp
    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>스터디룸 예약{{ isset($list) ? '수정' : '등록' }} (관리자)</h1>
            </div>


            <div class="table02">
                <h2>스터디룸 정보</h2>
                <form action="/{{ ADMIN_URL }}/study/reservation{{ isset($list) ? '/'.$list->id : '' }}" method="post" name="forms" >
                    @csrf
                    @if (isset($list))
                        @method("put")
                        <input type="hidden" name="id" value="{{ $list->id }}">
                    @endif

                    <input type="hidden" name="room_id" value="{{ $list->room_id ?? ''}}">
                    <input type="hidden" name="campus_name" value="{{ isset($list) ? get_campus_name($list->campus_id) : ''  }}">
                    <input type="hidden" name="study_room_name" value="{{ $room_info->name ?? '' }}">
                    <input type="hidden" name="location" value="{{ $list->location ?? '' }}">
                    <input type="hidden" name="office_equipment" value="{{ $list->office_equipment ?? '' }}">
                    <input type="hidden" name="max_personnel" value="{{ $room_info->max_personnel ?? 0 }}">
                    <input type="hidden" name="min_personnel" value="{{ $room_info->min_personnel ?? 0 }}">
                    <input type="hidden" name="student_check" value="{{ isset($list) ? 1 : 0 }}">
                    <input type="hidden" name="target_type" value="{{ isset($list) ? $list->target_type : '' }}">

                    <table>
                        <tr>
                            <th>예약날짜</th>
                            <td>
                                <input type="date" name="date" class="" value="{{ $list->date ?? date('y-m-d') }}">
                            </td>
                        </tr>
                        <tr>
                            <th>상태</th>
                            <td>
                                <select name="status" class="" required="">
                                    @foreach($status_lists as $key => $data)
                                        <option value="{{ $key }}" {{ isset($list) && $list->status == $key ? 'selected' : '' }}>{{ $data }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>캠퍼스</th>
                            <td class="radio_button_wrap">
                                <input type="radio" id="campus-seunghak" name="campus_id" class="_vali radio_txtbox"
                                       value="1"
                                       data-title="캠퍼스" {{ isset($list->campus_id) && $list->campus_id == 1 ? 'checked' : 'checked' }}>
                                <label for="campus-seunghak" class="radio_button_txt">승학 캠퍼스</label>
                                <input type="radio" id="campus-bumin" name="campus_id" class="_vali radio_txtbox"
                                       value="2"
                                       data-title="캠퍼스" {{ isset($list->campus_id) && $list->campus_id == 2 ? 'checked' : '' }}>
                                <label for="campus-bumin" class="radio_button_txt">부민 캠퍼스</label>
                            </td>
                        </tr>
                        <tr>
                            <th>스터디룸</th>
                            <td>
                                <select name="room" class="" required="">
                                    <option value="">스터디룸 선택</option>
                                    @foreach($room_list as $room)
                                        <option value={{ $room->id }} {{ isset($room_info) ? $room_info->id == $room->id ? 'selected' : '' : ''}} >{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>예약시간</th>
                            <td class="time_td">
                                <ul>
                                    <li class="checkbox_txt_wrap">

                                        @if(isset($times))
                                            @foreach($time_list as $key => $time)
                                                @php
                                                  if(isset($times) && !in_array($time, $times, true))
                                                     continue;
                                                @endphp
                                                <input type="checkbox" id="reservation_time_{{ $key }}" class="input_checkbox reservation_time" name="time[]" value="{{ $time }}" {{ isset($times) ? in_array($time, $times) ? 'checked'  : '' : ''}}>
                                                <label for="reservation_time_{{ $key }}" class="checkbox_txt"><span>{{ $time }}</span></label>
                                            @endforeach
                                            @else
                                            <p style="color: red">스터디룸 먼저 선택 바랍니다.</p>
                                        @endif
                                    </li>
                                </ul>
                            </td>
                        </tr>
                     {{--   <tr>
                            <th>최소인원</th>
                            <td>{{ isset($room_info) ? $room_info->min_personnel : 0 }}명</td>
                        </tr>
                        <tr>
                            <th>최대인원</th>
                            <td>{{ isset($room_info) ?  $room_info->max_personnel : 0 }}명</td>
                        </tr>--}}
                    </table>



                    <h2 class="mgt50">기본 정보</h2>
                    <table>
                        <tr>
                            <th>이름</th>
                            <td>
                                <input type="text" class="_vali" data-title="이름" name="name" value="{{ $booker->name ?? session()->get('name') }}" {{ isset($booker) && $booker->name ? 'readonly' : "" }} maxlength="15" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>학번</th>
                            <td>
                                <input type="text" class="_vali" data-title="학번" name="account" value="{{ $booker->account ?? session()->get('account') }}" maxlength="8" {{ isset($booker) && $booker->account ? 'readonly' : "" }} maxlength="15" oninput="maxLengthCheck(this)" >
                                <span id="student_confirm"></span>
                            </td>
                        </tr>

                        <tr>
                            <th>사용인원</th>
                            <td class="txt_middle_wrap">
                                <input type="text" class="_vali" data-title="사용인원" name="use_people" value="{{ $list->use_people ?? '' }}">
                                <span>명</span>
                            </td>
                        </tr>
                        <tr>
                            <th>사용목적</th>
                            <td>
                                <input type="text" class="_vali use_perpose_txtbox" data-title="사용목적" name="use_purpose" value="{{ $list->use_purpose ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        @if(isset($list))
                            <tr>
                                <th>신청일시</th>
                                <td>{{ date("y-m-d", strtotime($list->created_at)) ?? "" }}</td>
                            </tr>
                        @endif
                    </table>


                    <h2 class="mgt50">동반 사용자</h2>
                    <table class="companion_table">
                        <tr>
                            <th>학번</th>
                            <td>
                                <div>
                                    <input type="text" class="serch_textbox" maxlength="8">
                                    <button type="button" class="serch_button">추가</button>
                                </div>
                            </td>
                        </tr>
                        @if(isset($companions))
                            @for($i = 0; $i < count($companions); $i++)
                                <input type="hidden" name="original_companion_id[]" value="{{ $companions[$i]['info']->account }}">
                            <tr>
                                <th>학번{{ $i + 1 }}</th>
                                    <td>
                                        <div>
                                            <input type="text" name="companion_id[]" class="serch_textbox companion_id" value="{{ $companions[$i]['info']->account }}" readonly>
                                            <button type="button" class="btn01 btn-remove">삭제</button>
                                        </div>
                                    </td>
                            </tr>
                            @endfor
                        @endif
                    </table>

                    <div class="btn-wrap">
                        @if(isset($list))
                            <button type="button" id="btn_delete" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                        @endif
                        <button type="button" class="btn01 btn_cancel" onclick="location.href=move()">취소</button>
                        <button type="button" data-name="{{ isset($list)  ? '수정' : '등록' }}"
                                class="btn01 btn_submit">{{ isset($list)  ? '수정' : '등록' }}</button>
                    </div>
                </form>
            </div>


        </article> <!-- article list_head end -->
    </section>

<script>
    function move() {
        location.href = '/superviser/study/reservation/';
    }

</script>
@endsection



