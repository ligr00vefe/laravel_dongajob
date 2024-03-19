
@extends("layouts.layout")

@section("title")
    프로그램 참여후기
@endsection

@push('scripts')
    <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>
    <script defer src="/js/admin/board.js"></script>
    <script defer src="/js/archive.js"></script>
@endpush

@php
    $major_menu = "취업자료실";
    $minor_menu = "프로그램 참여후기";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>프로그램 참여후기 {{ isset($list) ? '수정' : '등록' }}</h1>
        </div>

        <div class="board-wrap board-create">
            <form action="/archive/reviewparticipate/{{ isset($list) ? $list -> id.'/update' : 'store' }}" method="post" onsubmit="return archive_validate(this);" enctype="multipart/form-data">
                @csrf
                @if(isset($list))
                    @method("put")
                    <input type="hidden" name="id" value="{{ $list->id ?? "" }}">
                    <input type="hidden" name="status_id" value="{{ $list->status_id ?? 0 }}">
                    <input type="hidden" name="hit" value="{{ $list->hit ?? "0" }}">
                @else
                    <input type="hidden" name="status_id" value="0">
                    <input type="hidden" name="hit" value="0">
                @endif
                <div class="table02-create table02">
                    <table>
                        <tbody>
{{--                        <tr>--}}
{{--                            <th class="w167">옵션</th>--}}
{{--                            <td>--}}
{{--                                <input type="checkbox" name="is_notice" class="tbl-checkbox" id="tbl-chk-option" value="1">--}}
{{--                                <label for="tbl-chk-option" class="tbl-chk-label"> <span>공지</span></label>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th class="w167">제목</th>
                            <td>
                                <input type="text" name="subject" class="tbl-input w950" value="{{ $list -> subject ?? '' }}" maxlength="100" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>

                        <tr>
{{--                            <th class="tbl-silence">내용</th>--}}
                            {{--                            <td colspan="2">--}}
                            {{--                                <textarea name="contents" id="" class="tbl-textarea" cols="30" rows="10"></textarea>--}}
                            {{--                            </td>--}}
                            <td class="editor-wrap" colspan="2">
                                @include("_include.editor.ckeditor5",  [
                                    "editor_name" => "contents",
                                    "comment" => false,
                                    "image" => true,
                                    "path" => "reviewparticipate",
                                    "contents" => $list->contents ?? ""
                                ])
                            </td>
                        </tr>

                        {{--                        <tr>--}}
                        {{--                            <th>URL</th>--}}
                        {{--                            <td>--}}
                        {{--                                <input type="text" name="url" class="tbl-input w500" placeholder="https://">--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}

                        @for($i = 1; $i <= 2; $i++)
                            @php
                                $attachment = 'attachment'.$i;
                            @endphp
                            <tr>
                                <th class="w167">첨부파일 {{ $i }}</th>
                                <td>
                                    <input type="file" id="attachment{{ $i }}" name="attachment{{ $i }}" class="file-hidden" readonly>
                                    <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" value="{{ getAttach($list->$attachment ?? "")->original_name ?? "" }}" readonly>
                                    <label for="attachment{{ $i }}" class="btn-file btn01" onchange="javascript:document.getElementById('attachment{{ $i  }}').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                                    {{--<span class="file-exist">{{ getAttach($list->$attachment ?? "")->original_name ?? "" }}</span>--}}
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}


                <div class="table02-create table02 table-agree">
                    <div class="table-title">
                        <h1>개인정보 수집 및 이용동의</h1>
                    </div>

                    <table>
                        <colgroup>
                            <col width="100%">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th class="text-subject">개인정보 수집·이용·제공 동의서</th>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-content">
                                    <p>
                                       1. 개인정보의 수집·이용 목적 : 프로그램후기 관련 개별 연락 및 확인, 통계자료 활용 <br/>
                                        2. 수집하려는 개인정보의 항목 : 성명, 대학/학부(과), 학번, 연락처 <br/>
                                        3. 개인정보의 보유 및 이용 기간 : 5년 <br/>
                                        4. 동의를 거부할 권리 및 거부에 따른 불이익 : 개인정보 수집·이용을 거부할 수 있으며, 동의를 거부할 경우 서비스이용이 불가함
                                    </p>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="agree01" id="agree01-01" class="input-checkCircle">
                                <label for="agree01-01">상기인은 개인정보수집동의서에 동의합니다.</label>
                                <input type="radio" name="agree01" id="agree01-02" class="input-checkCircle">
                                <label for="agree01-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-subject">개인정보 제3자 제공 동의</th>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-content">
                                    <p>
                                        1. 개인정보를 제공받는자: 귀하가 신청한 추천전형의 외부 기관<br/>
                                        2. 개인정보를 제공받는자의 이용목적: 평가를 통한 채용 <br/>
                                        3. 개인정보를 제공하는 항목: 성명, 대학/학부(과), 학번, 재학여부, 성별, 학년, 연락처 <br/>
                                        4. 개인정보를 제공받는자의 보유 및 이용기간: 채용 종료시까지<br/>
                                        5. 동의를 거부할 권리 및 거부에 따른 불이익: 개인정보 수집 이용을 거부할 수 있으며, 동의를 거부할 경우 상담접수가 불가능함
                                    </p>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="radio" name="agree02" id="agree02-01" class="input-checkCircle">
                                <label for="agree02-01">상기인은 개인정보수집동의서에 동의합니다.</label>
                                <input type="radio" name="agree02" id="agree02-02" class="input-checkCircle">
                                <label for="agree02-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="btn-wrap create-btn">
                    <a href="/archive/reviewparticipate" class="btn-cancel btn02">취소</a>
                    <button class="btn-register btn02" data-name="{{ isset($list)  ? '수정' : '등록' }}">
                        {{ isset($list)  ? '수정' : '등록' }}
                    </button>
                </div>
            </form>
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
