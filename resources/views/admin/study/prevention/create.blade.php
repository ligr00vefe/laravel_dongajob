@extends("layouts.admin")

@section("title")
    동아대 관리자 - 스터디룸 예약리스트
@endsection

@push('scripts')
@endpush

@section("content")
    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>스터디룸 예약 금지 {{ isset($list) ? '수정' : '등록' }} (관리자)</h1>
            </div>


            <div class="table02">
                <h2>설정</h2>
                <form action="/prevention" method="post" name="forms">
                    @csrf
                    @if (isset($list))
                        @method("put")
                        <input type="hidden" name="id" value="{{ $list->id }}">
                    @endif

                    <table>
                        <tr>
                            <th>명칭</th>
                            <td>
                                <input type="text" class="_vali w50p" data-title="명칭" name="name"
                                       value="{{ $list->name ?? '' }}" maxlength="255" oninput="maxLengthCheck(this)"
                                       placeholder="ex)석가탄신일">
                            </td>
                        </tr>
                        <tr>
                            <th>금지날짜</th>
                            <td>
                                <input type="date" class="_vali w50p" data-title="날짜" name="day"
                                       value="{{ $list->day ?? '' }}">
                                <span> ~ </span>
                                <input type="date" class="_vali w50p" data-title="날짜" name="end_day"
                                       value="{{ $list->end_day ?? '' }}">
                            </td>
                        </tr>
                    </table>


                    <div class="btn-wrap">
                        @if(isset($list))
                            <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                        @endif
                        <button type="button" data-name="취소" class="btn01 btn_cancel">취소</button>
                        <button type="submit" data-name="{{ isset($list) && $list->id ? '수정' : '등록' }}"
                                class="btn01 btn_submit">{{ isset($list) && $list->id ? '수정' : '등록' }}</button>
                    </div>
                </form>
            </div>


        </article> <!-- article list_head end -->
    </section>


@endsection



