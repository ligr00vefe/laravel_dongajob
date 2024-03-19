@extends("layouts/layout")

@section("title")

@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/course/jobsrch/list.js"></script>

    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "1306dcd4db917f0";
        if(window.wcs) {
            wcs_do();
        }
    </script>

@endpush

@php
    $major_menu = "워크넷 직업/진로정보";
    $minor_menu = "직업정보";
@endphp

@section("content")
    <div class="sub-content jobsrch-content">
        <div class="sub-content_title">
            <h1>직업정보</h1>
        </div>


        <form action="" method="get" name="forms">
            <input type="hidden" name="page" value="{{ $page }}">
            <div class="worknet-option">
                <div class="worknet-notion">
                    <div class="img-wr">
                        <img src="/img/job_letter.png" alt="직업정보 아이콘">
                    </div>
                    <div class="text-wr">
                        <h1>우리나라 대표 직업정보 찾기</h1>
                        <p>한국고용정보원에서 매년 실시하는 재직자조사를 바탕으로 우리나라 대표 직업들의 수행직무, 직무특성, 일자리 전망 등을 검색할 수 있습니다.</p>
                    </div>
                </div>

                <div class="worknet-search">
                    <ul>
                        <li>
                            <label for="keyword">키워드 검색</label>
                            <input type="text" name="keyword" id="keyword" class="worknet-input" placeholder="검색어 입력" value="{{ $keyword ?? '' }}">
                        </li>
                        <li>
                            <label for="firstCategory">직종 분류</label>
                            <select name="firstCategory" id="firstCategory" class="worknet-select">
                                <option value="">1차선택</option>
                                @foreach($first_category_list as $key => $val)
                                    <option value="{{ $key }}" @if($key == $first_category) {{ 'selected' }} @endif>{{ $val }}</option>
                                @endforeach
                            </select>
                            <select name="secondCategory" id="secondCategory" class="worknet-select">
                                <option value="">2차선택</option>
                                @if($first_category)
                                    @foreach($second_category_list as $key => $val)
                                        <option value="{{ $key }}" @if($key == $second_category) {{ 'selected' }} @endif>{{ $val }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </li>
                        <li>
                            <label for="salary">조건별 검색</label>
                            <select name="salary" id="salary" class="worknet-select">
                                <option value="" selected disabled>평균연봉</option>
                                <option value="1">3,000만원 미만</option>
                                <option value="2">3,000만원 ~4,000만원 미만</option>
                                <option value="3">4,000만원 ~5,000만원 미만</option>
                                <option value="4">5,000만원이상</option>
                            </select>
                            <select name="jobView" id="jobView" class="worknet-select">
                                <option value="" selected disabled>직업전망</option>
                                <option value="1">매우밝음 (상위10%이상)</option>
                                <option value="2">밝음 (상위20%이상)</option>
                                <option value="3">보통 (중간이상)</option>
                                <option value="4">전망안좋음 (감소예상직업)</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>{{-- worknet-option end --}}

            <div class="btn-wrap">
                <button type="submit" class="btn-option">검색</button>
            </div>
        </form>

        <div class="search-nav">
            <img src="/img/search_nav_icon.png" alt="검색 경로 아이콘" class="list-nav-icon">
        </div>

        <div class="board-wrap board-list worknet-list">

            <div class="list-warp table01">
                    <table class="jobsrch-table">
                        <colgroup>
                            <col class="visible-pc" width="30%">
                            <col class="visible-pc" width="55%">
                            <col class="visible-tablet visible-mobile" width="90%">
                            <col class="col-btn" width="15%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="visible-pc">직업명</th>
                            <th class="visible-pc">상세 직업명</th>
                            <th class="visible-tablet visible-mobile">직업정보</th>
                            <th class="th-btn">보기</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($post['list'] as $list)
                            @if($list == null)
                                @break
                            @endif
                            <tr>
                                <td class="td_subject visible-pc">{{ $list->jobClcdNM }}</td>
                                <td class="td_subject visible-pc">{{ $list->jobNm }}</td>
                                <td class="td_summary visible-tablet visible-mobile">
                                    <p>{{ $list->jobClcdNM }}</p>
                                    <p>{{ $list->jobNm }}</p>
                                </td>
                                <td class="td-btn">
                                    <a href="{{ url()->current() }}/{{ $list->jobCd }}/view?page={{ $page }}" class="view-btn">보기</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>{{-- //.table01 end --}}

            <div class="paging-wrap">
                <x-paging record="{{ $post['count'] }}" page="{{ $page }}" keyword="{{ $keyword }}"/>
            </div> <!-- article list_bottom end -->

            <div class="jobsrch-tab-link">
                <ul>
                    <li><a href="https://www.work.go.kr/consltJobCarpa/srch/jobInfoSrch/expSpecialGetList.do?pageIndex=1&pageUnit=10&pageSize=10">눈길 끄는 이색직업</a></li>
                    <li><a href="https://www.work.go.kr/consltJobCarpa/srch/getExpTheme.do?pageIndex=1&pageUnit=10">테마별 직업여행</a></li>
                    <li><a href="https://www.work.go.kr/consltJobCarpa/srch/korJobProspect/korJobProspectSrchByJobClList.do">직업전망</a></li>
                </ul>
            </div>

        </div>{{-- //.worknet-list end --}}

    </div>{{-- //.sub-content.jobsrch-content end --}}



@endsection
