
@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 프로그램 접수
@endsection

@push('scripts')
    <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>
@endpush

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "프로그램 접수";
@endphp


@section("content")
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>프로그램 접수</h1>
        </div>

        <div class="board-wrap board-create">
            <form action="{{ route('program.receipt.write') }}" method="post" enctype="multipart/form-data">
                @csrf
{{--                @if(isset($edit))--}}
{{--                    @method("put")--}}
{{--                    <input type="hidden" name="id" value="{{ $list->id ?? "" }}">--}}
{{--                @endif--}}
                <div class="table02-view table02 table-receipt first-table result-receipt">
                    <div class="table-title">
                        <h1>신청 강좌정보</h1>
                    </div>

                    <table>
                        <tbody>
                            <tr>
                                <th class="w167">강좌명</th>
                                <td><p>{{ $list->lecture_title }}</p></td>
                            </tr>
                            <tr>
                                <th class="w167">접수상태</th>
                                <td><p>{{ $list->reception_status }}</p></td>
                            </tr>
                            <tr>
                                <th class="w167">강사명</th>
                                <td><p>{{ $list->instructor_name }}</p></td>
                            </tr>
                            <tr>
                                <th class="w167">접수일시</th>
                                <td><p>{{ $list->reception_datetime }}</p></td>
                            </tr>
                            <tr>
                                <th class="w167">수강일시</th>
                                <td><p>{{ $list->lecture_datetime }}</p></td>
                            </tr>
                            <tr>
                                <th class="w167">수강장소</th>
                                <td><p>{{ $list->location }}</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table02-result table02 table-receipt result-receipt">
                    <div class="table-title">
                        <h1>신청정보</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <th class="w167">신청일시</th>
                            <td><p>{{ $list->lecture_title }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">이름</th>
                            <td><p>{{ $list->lecture_title }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">대학</th>
                            <td><p>{{ $list->reception_status }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학부(과)</th>
                            <td><p>{{ $list->instructor_name }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학년</th>
                            <td><p>{{ $list->reception_datetime }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학번</th>
                            <td><p>{{ $list->lecture_datetime }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">학적</th>
                            <td><p>{{ $list->location }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">이메일</th>
                            <td><p>{{ $list->enrolled_count }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">휴대폰</th>
                            <td><p>{{ $list->edu_target }}</p></td>
                        </tr>
                        <tr>
                            <th class="w167">전화번호</th>
                            <td><p>{{ $list->target_grade }}</p></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="btn-wrap create-btn">
                    <a href="/program/receipt" class="btn-cancel btn02">목록</a>
                    <a href="/mypage/receipt" class="btn-register btn02">마이페이지</a>
                </div>
            </form>
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
