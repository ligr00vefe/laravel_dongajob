@extends('layouts.admin')

@section('title')
    동아대 관리자 - {{ $title }} {{ isset($list) ? '수정' : '등록' }}
@endsection

@push("scripts")
    <script src="/lib/ckeditor5/build/ckeditor.js"></script>
    <script src="/js/UploadAdaptor.js"></script>
    <script defer src="/js/admin/board.js"></script>
@endpush


@section('content')
    <style>
        label {
            line-height: 45px;
            cursor: pointer
        }

        .local_desc {
            margin: 10px 0 10px;
            padding: 10px 20px;
            border: 1px solid #f2f2f2;
            background: #f9f9f9
        }
    </style>



    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>{{ $title }} {{ isset($list) ? '수정' : '등록' }}</h1>
                <div class="local_desc">
                    <p>초기화면 접속 시 자동으로 뜰 팝업레이어를 설정합니다.</p>
                </div>
            </div>

            <div class="table02">
                <form action="" method="post" name="forms" data-route="/{{ ADMIN_URL }}/popup/info"
                      enctype="multipart/form-data">
                    @csrf
                    @if (isset($list))
                        @method("put")
                        <input type="hidden" name="id" value="{{ $list->id }}">
                    @endif

                    <table>
                        <tr>
                            <th>접속기기</th>
                            <td>
                                <p>※ 팝업레이어가 표시될 접속기기를 설정합니다.</p>
                                <select name="device" id="">
                                    <option value="all" {{ isset($list) && $list->device == 'all' ? 'selected' : '' }}>
                                        모두
                                    </option>
                                    <option value="pc" {{ isset($list) && $list->device == 'pc' ? 'selected' : '' }}>
                                        PC
                                    </option>
                                    <option
                                        value="mobile" {{ isset($list) && $list->device == 'mobile' ? 'selected' : '' }}>
                                        모바일
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>시간</th>
                            <td>
                                <p>※ 필수 고객이 다시 보지 않음을 선택할 시 몇 시간동안 팝업레이어를 보여주지 않을지 설정합니다.</p>
                                <input type="text" class="_vali" name="disable_hours" data-title="시간"
                                       value="{{ isset($list) ? $list->disable_hours : 24 }}" placeholder="24">
                            </td>
                        </tr>
                        <tr>
                            <th>시작일시</th>
                            <td>
                                <input type="text" name="start_time" class="_vali" data-title="시작일시"
                                       value="{{ $list->start_time ?? '' }}">
                                <input type="checkbox" value="{{ date('Y-m-d 00:00:00') }}" id="nw_begin_chk"
                                       onclick="this.previousElementSibling.value = this.value">
                                <label for="nw_begin_chk">시작일시를 오늘로</label>
                            </td>
                        </tr>
                        <tr>
                            <th>종료일시</th>
                            <td>
                                <input type="text" name="end_time" class="_vali" data-title="종료일시"
                                       value="{{ $list->end_time ?? '' }}">
                                <input type="checkbox"
                                       value="{{ date('Y-m-d 23:59:59', strtotime('+7 days', strtotime("Now"))) }}"
                                       id="nw_end_chk">
                                <label for="nw_end_chk">종료일시를 오늘로부터 7일 후로</label>
                            </td>
                        </tr>
                        <tr>
                            <th>팝업 좌측 위치(px)</th>
                            <td>
                                <input type="text" class="_vali" data-title="팝업 좌측 위치" name="left" placeholder="100"
                                       value="{{ $list->left ?? 100 }}">
                            </td>
                        </tr>
                        <tr>
                            <th>팝업 상단 위치(px)</th>
                            <td>
                                <input type="text" class="_vali" data-title="팝업 상단 위치" name="top" placeholder="100"
                                       value="{{ $list->top ?? 100 }}">
                            </td>
                        </tr>
                        <tr>
                            <th>팝업 넓이(px)</th>
                            <td>
                                <input type="text" class="_vali" data-title="팝업 높이" name="width" placeholder="450"
                                       value="{{ $list->width ?? 450 }}">
                            </td>
                        </tr>
                        <tr>
                            <th>팝업 높이(px)</th>
                            <td>
                                <input type="text" class="_vali" data-title="팝업 높이" name="height" placeholder="500"
                                       value="{{ $list->height ?? 500 }}">
                            </td>
                        </tr>

                        <tr>
                            <th>제목</th>
                            <td>
                                <input type="text" class="_vali subject_txtbox" data-title="제목" name="subject"
                                       value="{{ $list->subject ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="editor-wrap">
                                @include("_include.editor.ckeditor5", [
                                    "editor_name" => "contents",
                                    "comment" => false,
                                    "image" => true,
                                    "path" => "popup",
                                    "contents" => $list->contents ?? ""
                                ])
                            </td>
                        </tr>
                    </table>

                    <div class="btn-wrap">
                        @if(isset($list))
                            <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                        @endif
                        <button type="button" data-name="취소" class="btn01 btn_cancel">취소</button>
                        <button type="button" data-name="{{ isset($list)  ? '수정' : '등록' }}"
                                class="btn01 btn_submit">{{ isset($list)  ? '수정' : '등록' }}</button>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->
    </section>

    <script>
        function timeCollege(e) {
            e.target.previousElementSibling.value = e.target.checked ? e.target.value : '';
        }

        document.getElementById('nw_begin_chk').onclick = timeCollege;
        document.getElementById('nw_end_chk').onclick = timeCollege;
    </script>

@endsection
