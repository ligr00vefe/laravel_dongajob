
@extends("layouts.layout")

@section("title")
    동아대 마이페이지 - 서류합격자 면접교육 결과
@endsection

@push('scripts')

@endpush

@php
    $major_menu = "My Page";
    $minor_menu = "서류합격자 면접교육 접수";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>서류합격자 면접교육 결과</h1>
        </div>

        <div class="board-wrap board-create">
            <form action="{{ route('mypage.interview.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($list))
                  @method("put")
                    <input type="hidden" name="id" value="{{ $list->id }}">
                @endif
                <div class="table02-view table02 table-interview first-table">

                    <table>
                        <tbody>
                            <tr>
                                <th class="w167">결과</th>
                                <td>
                                    <input type="radio" name="status" id="interview-result01" class="tbl-radio" {{ $list->status == 200 ? 'checked' : '' }} value="200">
                                    <label for="interview-result01"><span>합격</span></label>

                                    <input type="radio" name="status" id="interview-result02" class="tbl-radio" {{ $list->status == 300 ? 'checked' : '' }} value="300">
                                    <label for="interview-result02"><span>불합격</span></label>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="btn-wrap create-btn">
                    <a href="/mypage/interview" class="btn-cancel btn02">취소</a>
                    <button type="submit" class="btn-register btn02">저장</button>
                </div>
            </form>
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
