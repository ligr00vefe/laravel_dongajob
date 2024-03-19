@extends("layouts/layout")

@section("title")
    학과정보
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">

    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "fb86f492966d68";
        if(window.wcs) {
            wcs_do();
        }
    </script>


@endpush

@php

    $major_menu = "워크넷 직업/진로정보";
    $minor_menu = "학과정보";


@endphp

@section("content")
    <div class="sub-content majorsrch-content">
        <div class="sub-content_title">
            <h1>학과정보</h1>
        </div>

        <form action="">
            <div class="worknet-option">
                <div class="worknet-notion">
                    <div class="img-wr">
                        <img src="/img/student.png" alt="학과정보 아이콘">
                    </div>
                    <div class="text-wr">
                        <h1>대학의 학과 정보가 궁금하다면, 학과정보를 검색해 주세요</h1>
                        <p>학문에 대한 개괄적 소개와 해당학과에서 필요로 하는 적성 및 흥미를 확인할 수 있습니다</p>
                    </div>
                </div>

                <div class="worknet-search">
                    <ul>
                        <li>
                            <label for="keyword">키워드 검색</label>
                            <input type="text" name="keyword" id="keyword" class="worknet-input" placeholder="검색어 입력" value="{{ $keyword }}">
                        </li>
                    </ul>
                </div>
            </div>{{-- worknet-option end --}}

            <div class="btn-wrap">
                <button type="submit" class="btn-option">검색</button>
            </div>
        </form>

        <div class="board-wrap board-list worknet-list">

            <div class="list-warp table01">
                <form action="/majorsrch" method="post" name="forms">
                    @csrf
                    @method("delete")
                    <input type="hidden" name="id" value="">
                    <table class="majorsrch-table">
                        <colgroup>
                            <col width="85%">
                            <col class="col-btn" width="15%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="">학과명</th>
                                <th class="th-btn">보기</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($lists['list'] as $key => $value)
                            <tr>
                                <td class="td_subject">{{$value}}</td>
                                <td class="td-btn">
                                    <a href="{{ $major->getLink($value) ?: 'javascript:alert("정보가 제공되지 않습니다.")' }}"  {{ $major->getLink($value) ? 'target="_blank"' : ''  }} class="view-btn">보기</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </form>
            </div>{{-- //.table01 end --}}

            <div class="paging-wrap">
                <x-paging record="{{ $lists['count'] }}" page="{{ $page }}" keyword="{{ $keyword }}"/>
            </div>

        </div>{{-- //.body-reservation end --}}

    </div>{{-- //.sub-content.content-studyroom end --}}

@endsection
