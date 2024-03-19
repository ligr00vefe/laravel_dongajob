
@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 취업컨설턴트 PICK 채용정보
@endsection

@push('scripts')
    <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>
    <script>
        $(document).ready(function() {
            var fileTarget = $('.file-hidden');
            fileTarget.on('change', function () { // 값이 변경되면
                if (window.FileReader) { // modern browser
                    var filename = $(this)[0].files[0].name;
                } else { // old IE
                    var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
                } // 추출한 파일명 삽입
                // console.log(filename);
                $(this).siblings('.file-name').val(filename);
            });

            $('.tbl-file').on('click', function () {
                $(this).siblings('.file-hidden').click();
            });
        });
    </script>
@endpush

@php
    $major_menu = "채용정보";
    $minor_menu = "취업컨설턴트PICK";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub_category_wrap">
            <h1>취업컨설턴트 PICK 채용정보</h1>
        </div>

        <div class="board-wrap board-create">
            <form action="{{ route('jobinfo.normal.write') }}" method="post" enctype="multipart/form-data">
                @csrf
{{--                @if(isset($edit))--}}
{{--                    @method("put")--}}
{{--                    <input type="hidden" name="id" value="{{ $list->id ?? "" }}">--}}
{{--                @endif--}}
                <div class="table-create table02">
                    <table>
                        <tr>
                            <th>옵션</th>
                            <td>
                                <input type="checkbox" name="is_notice" class="tbl-checkbox" id="tbl-chk-option">
                                <label for="tbl-chk-option" class="tbl-chk-label"> <span>공지</span></label>
                            </td>
                        </tr>
                        <tr>
                            <th>취업자</th>
                            <td>
                                <input type="text" name="cnt_employed" class="tbl-input w180"><span class="tbl-unit"> 명</span>
                            </td>
                        </tr>
                        <tr>
                            <th>제목</th>
                            <td>
                                <input type="text" name="subject" class="tbl-input w950">
                            </td>
                        </tr>

                        <tr>
                            <th class="tbl-silence">내용</th>
{{--                            <td colspan="2">--}}
{{--                                <textarea name="contents" id="" class="tbl-textarea" cols="30" rows="10"></textarea>--}}
{{--                            </td>--}}
                            <td class="editor-wrap " colspan="2">
                                @include("_include.editor.ckeditor5",  [
                                    "editor_name" => "content",
                                    "comment" => false,
                                    "image" => true,
                                    "content" => $list->content ?? "",
                                    "height" => "740"
                                ])
                            </td>
                        </tr>

                        <tr>
                            <th>URL</th>
                            <td>
                                <input type="text" name="url" class="tbl-input w500" placeholder="https://">
                            </td>
                        </tr>

                        <tr>
                            <th>첨부파일1</th>
                            <td>
                                <input type="file" id="attachment1" name="attachment1" class="file-hidden" readonly>
                                <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" readonly>
                                <label for="attachment1" class="btn-file btn01" onchange="javascript:document.getElementById('attachment1').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                            </td>
                        </tr>

                        <tr>
                            <th>첨부파일2</th>
                            <td>
                                <input type="file" id="attachment2" name="attachment2" class="file-hidden" readonly>
                                <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" readonly>
                                <label for="attachment2" class="btn-file btn01" onchange="javascript:document.getElementById('attachment2').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                            </td>
                        </tr>

                        <tr>
                            <th>첨부파일3</th>
                            <td>
                                <input type="file" id="attachment3" name="attachment3" class="file-hidden" readonly>
                                <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" readonly>
                                <label for="attachment3" class="btn-file btn01" onchange="javascript:document.getElementById('attachment3').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                            </td>
                        </tr>

                        <tr>
                            <th>첨부파일4</th>
                            <td>
                                <input type="file" id="attachment4" name="attachment4" class="file-hidden" readonly>
                                <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" readonly>
                                <label for="attachment4" class="btn-file btn01" onchange="javascript:document.getElementById('attachment4').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                            </td>
                        </tr>

                        <tr>
                            <th>첨부파일5</th>
                            <td>
                                <input type="file" id="attachment5" name="attachment5" class="file-hidden" readonly>
                                <input class="file-name tbl-file w400" placeholder="선택된 파일 없음" readonly>
                                <label for="attachment5" class="btn-file btn01" onchange="javascript:document.getElementById('attachment5').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                            </td>
                        </tr>

                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="btn-wrap create-btn">
                    <a href="/jobinfo/normal" class="btn-cancel btn02">취소</a>
                    <button class="btn-register btn02">등록</button>
                </div>
            </form>
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
