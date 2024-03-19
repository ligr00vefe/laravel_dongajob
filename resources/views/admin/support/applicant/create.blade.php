@extends("layouts.admin")

@section("title")
    동아대 관리자 - 프로그램 및 신청자 {{ isset($list)? '수정' : '추가' }}
@endsection

@push("scripts")
    <script defer src="/js/admin/support/applicant/create.js"></script>

@endpush

@section("content")
    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>{{ $status == 1 ? '신청자' : '대기자' }} {{ isset($list)? '수정' : '추가' }}</h1>
            </div>
        </article> <!-- article list_head end -->

        <div class="table02">
            <form action="/{{ ADMIN_URL }}/support/applicant" method="post" name="forms" data-route="/{{ ADMIN_URL }}/support/applicant">
                @csrf
                <input type="hidden" name="redirect" value="{{ url()->previous() }}">
                <input type="hidden" name="program_id" value="{{ $program_id }}">
                <input type="hidden" name="status" value="{{ $status }}">

                @if (isset($list))
                    @method("put")
                    <input type="hidden" name="id" value="{{ $list->id }}">
                @endif

                <table>
                    <tr>
                        <th>이름</th>
                        <td>
                            <input type="text" name="name" class="_vali" data-title="이름"
                                   value="{{ $list->name ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <th>학번</th>
                        <td>
                            <input type="text" name="account" class="_vali" data-tile="학번"
                                   value="{{ $list->account ?? '' }}" maxlength="8">
                            <button type="button" class="btn01 student-confirm">학번확인</button>
                        </td>
                    </tr>
                </table>

                <table id="search_table" class="none">
                </table>

                <div class="btn-wrap">
                    @if(isset($list))
                        <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                    @endif
                    <button type="button" class="btn01 btn_cancel" onclick="location.href='{{ url()->previous() }}'">취소</button>
                    <button type="button" data-name="{{ isset($list)  ? '수정' : '추가' }}" data-success="0"
                            class="btn01 btn_submit">{{ isset($list)  ? '수정' : '추가' }}</button>
                </div>
            </form>
        </div>


    </section>

@endsection
