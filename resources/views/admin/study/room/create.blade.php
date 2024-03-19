@extends("layouts.admin")

@section("title")
    동아대 관리자 - 스터디룸 {{ isset($list) && $list->id ? '수정' : '등록' }}
@endsection

@push('scripts')
    <script src="/js/admin/study/room/create.js"></script>
@endpush

@section("content")


    <section id="board_section" class="list_wrapper">

        <article id="list_head">

            <div class="head-info">
                <h1>스터디룸 {{ isset($list) && $list->id ? '수정' : '등록' }}</h1>
            </div>


            <div class="table02">
                <h2>스터디룸 정보</h2>
                <form action="/{{ ADMIN_URL }}/study/room" method="post" name="forms">
                    @csrf
                    @if (isset($list))
                        @method("put")
                        <input type="hidden" name="id" value="{{ $list->id }}">
                    @endif
                    <table>
                        <tr>
                            <th>캠퍼스</th>
                            <td class="radio_button_wrap">
                                <input type="radio" id="campus-seunghak" name="campus_id" class="_vali radio_txtbox" value="1" data-title="캠퍼스"  {{ isset($list->campus_id) && $list->campus_id == 1 ? 'checked' : '' }}>
                                <label for="campus-seunghak" class="radio_button_txt">승학 캠퍼스</label>
                                <input type="radio" id="campus-bumin" name="campus_id" class="_vali radio_txtbox" value="2" data-title="캠퍼스" {{ isset($list->campus_id) && $list->campus_id == 2 ? 'checked' : '' }}>
                                <label for="campus-bumin" class="radio_button_txt">부민 캠퍼스</label>
                            </td>
                        </tr>
                        <tr>
                            <th>스터디룸 명</th>
                            <td>
                                <input type="text" class="_vali w50p" data-title="스터디룸" name="name" value="{{ $list->name ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>간단 설명</th>
                            <td>
                                <input type="text" class="_vali w100p" data-title="간단설명" name="info_desc" value="{{ $list->info_desc ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>장소</th>
                            <td>
                                <input type="text" class="_vali w50p" data-title="장소" name="location" value="{{ $list->location ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th>운영시간</th>--}}
{{--                            <td>--}}
{{--                                <input type="text" class="_vali w50p" data-title="운영시간" name="operating_time" value="{{ $list->operating_time ?? '' }}">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th>시간설정</th>
                            <td>
                                <input type="text" class="_vali w50p" data-title="시간설정" name="time" value="{{ $list->time ?? '' }}" maxlength="200" oninput="maxLengthCheck(this)">
                                <p>*,(콤마)로 구분해서 시간을 입력해주세요.</p>
                            </td>
                        </tr>
                        <tr>
                            <th>사용가능 여부</th>
                            <td class="radio_button_wrap">
                                <input type="radio" id="availability-possible" name="use" class="_vali radio_txtbox" data-title="사용가능여부" value="1" {{  isset($list->use) && $list->use == 1? 'checked' : '' }}>
                                <label for="availability-possible" class="radio_button_txt">가능</label>
                                <input type="radio" id="availability-impossible" name="use" class="_vali radio_txtbox" data-title="사용가능여부" value="0"  {{  isset($list->use) && $list->use == 0 ? 'checked' : '' }}>
                                <label for="availability-impossible" class="radio_button_txt">불가능</label>
                            </td>
                        </tr>
                        <tr>
                            <th>스터디룸 비밀번호</th>
                            <td class="txt_middle_wrap">
                                <input type="text" class="" data-title="스터디룸 비밀번호" name="room_password" value="{{ $list->room_password ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <th>수용인원</th>
                            <td class="txt_middle_wrap">
                                <input type="text" class="_vali" data-title="수용인원" name="max_personnel" value="{{ $list->max_personnel ?? '' }}">
                                <span>명</span>
                            </td>
                        </tr>
                        <tr>
                            <th>최소신청</th>
                            <td class="txt_middle_wrap">
                                <input type="text" class="_vali" data-title="최소신청" name="min_personnel" value="{{ $list->min_personnel ?? '' }}">
                                <span>명</span>
                            </td>
                        </tr>
                        <tr>
                            <th>사무기기</th>
                            <td>
                                <input type="text" class="_vali w50p" data-title="사무기기" name="office_equipment" value="{{ $list->office_equipment ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>스터디룸 IP</th>
                            <td>
                                <input type="text" class="_valiㅈ w50p" data-title="스터디룸 IP" name="room_ip" value="{{ $list->room_ip ?? '' }}" maxlength="30" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                    </table>

                    <div class="btn-wrap">
                        @if(isset($list))
                            <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                        @endif
                        <button type="button" data-name="취소" class="btn01 btn_cancel">취소</button>
                        <button type="button" data-name="{{ isset($list) && $list->id ? '수정' : '등록' }}" class="btn01 btn_submit">{{ isset($list) && $list->id ? '수정' : '등록' }}</button>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->
    </section>


@endsection



