@extends("layouts/layout")

@section("title")
    동아대 - 워크넷 직업/진로정보
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/course/employment/list.js"></script>

    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "1306dc8af308bd0";
        if(window.wcs) {
            wcs_do();
        }
    </script>



@endpush

@php
    $major_menu = "워크넷 직업/진로정보";
    $minor_menu = "채용정보";

    $first_area = get_worknet_first_area();
    $first_job = get_workent_first_job_code();
@endphp


@section("content")
    @if($lists->message)
        <script>alert('{{ $lists->message }}');</script>
    @endif

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>채용정보</h1>
        </div>

        <div class="board-wrap board-list worknet-list">
            <form action="/course/employment" method="post" class="search_form" name="search_form">
                @csrf
                <!------ 검색창 시작 ------>
                <div class="table02-create table02">
                    <table>
                        <tbody>

                        <tr>
                            <th class="w167">근무지역</th>
                            <td>
                                <select name="firstArea" class="tbl-select w200">
                                    @foreach($first_area as $key => $value)
                                        <option value="{{ $key }}" {{  $params['firstArea'] == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>

                                <select name="secondArea" class="tbl-select w200">
                                    <option value="">없음</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">희망직종</th>
                            <td>
                                <select name="occupation[]" class="firstJob tbl-select w250">
                                    <option value="">없음</option>
                                    @foreach($first_job as $key => $value)
                                        <option value="{{  $key }}" {{  $params['firstJob'] == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>

                                 <select name="occupation[]" class="secondJob tbl-select w250">
                                    <option value="">없음</option>
                                </select>

                                 <select name="occupation[]" class="thirdJob tbl-select w250">
                                    <option value="">없음</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">희망임금</th>
                            <td>
                                <div class="tbl-wbr">
                                    <input type="radio" name="salTp" class="tbl-radio" value="" id="salTp01"  {{ $params['salTp'] == '' ? 'checked' : '' }}>
                                    <label for="salTp01" class="tbl-chk-label">관계없음</label>

                                    <input type="radio" name="salTp" class="tbl-radio" value="Y" id="salTp02"  {{ $params['salTp'] == 'Y' ? 'checked' : '' }}>
                                    <label for="salTp02">연봉</label>

                                    <input type="radio" name="salTp" class="tbl-radio" value="M" id="salTp03"  {{ $params['salTp'] == 'M' ? 'checked' : '' }}>
                                    <label for="salTp03">월급</label>

                                    <input type="radio" name="salTp" class="tbl-radio" value="D" id="salTp04"  {{ $params['salTp'] == 'D' ? 'checked' : '' }}>
                                    <label for="salTp04">일급</label>
                                </div>
                                <div class="tbl-wbr">
                                    <input type="radio" name="salTp" class="tbl-radio" value="H" id="salTp05"  {{ $params['salTp'] == 'H' ? 'checked' : '' }}>
                                    <label for="salTp05">시급(</label>

                                    <input type="text" name="maxPay" class="tbl-input w100" value="{{ $params['maxPay'] }}" >
                                    <span class="tbl-span"> 만원이상</span>
                                    <input type="text" name="minPay" class="tbl-input w100" value="{{ $params['minPay'] }}">
                                    <span class="tbl-span"> 만원이하)</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th class="w167">학력</th>
                            <td class="education_td">
                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="" id="education08">
                                <label for="education08" class="tbl-chk-label">전체</label>

                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="01" {{ $params['education'] && in_array('01', $params['education']) ? 'checked' : '' }} id="education01">
                                <label for="education01" class="tbl-chk-label">초졸이하</label>

                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="02" {{ $params['education'] && in_array('02', $params['education']) ? 'checked' : '' }} id="education02">
                                <label for="education02" class="tbl-chk-label">중졸</label>

                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="03" {{ $params['education'] && in_array('03', $params['education']) ? 'checked' : '' }} id="education03">
                                <label for="education03" class="tbl-chk-label">고졸</label>

                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="04" {{ $params['education'] && in_array('04', $params['education']) ? 'checked' : '' }} id="education04">
                                <label for="education04" class="tbl-chk-label">대졸(2~3년)</label>

                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="05" {{ $params['education'] && in_array('05', $params['education']) ? 'checked' : '' }}  id="education05">
                                <label for="education05" class="tbl-chk-label">대졸(4년)</label>

                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="06" {{ $params['education'] && in_array('06', $params['education']) ? 'checked' : '' }}  id="education06">
                                <label for="education06" class="tbl-chk-label">석사</label>

                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="07" {{ $params['education'] && in_array('07', $params['education']) ? 'checked' : '' }}  id="education07">
                                <label for="education07" class="tbl-chk-label">박사</label>

                                <input type="checkbox" class="tbl-checkbox" name="education[]" value="00" {{ $params['education'] && in_array('00', $params['education']) ? 'checked' : '' }} id="education00">
                                <label for="education00" class="tbl-chk-label">학력무관</label>

                                {{-- 학력무관 체크시 다른 체크 불가하도록 해야합니다 --}}

                            </td>
                        </tr>
                        <tr>
                            <th class="w167">경력</th>
                            <td>
                                <div class="tbl-wbr">
                                    <input type="radio" name="career" class="tbl-checkbox" value="Z" id="career01"   {{ $params['career'] == 'Z' ? 'checked' : '' }}>
                                    <label for="career01">무관</label>

                                    <input type="radio" name="career" class="tbl-checkbox" value="N" id="career02"  {{ $params['career'] == 'N' ? 'checked' : '' }}>
                                    <label for="career02">신입</label>
                                </div>

                                <div class="tbl-wbr mobile-modify">
                                    <input type="checkbox" name="career" class="tbl-checkbox" value="E" id="career03"  {{ $params['career'] == 'E' ? 'checked' : '' }}>
                                    <label for="career03">경력</label>

                                    <input type="text" name="minCareerM" class="tbl-input w100" value="{{ $params['minCareerM'] }}">
                                    <span class="tbl-span"> 개월~</span>
                                    <input type="text" name="maxCareerM" class="tbl-input w100" value="{{ $params['maxCareerM'] }}">
                                    <span class="tbl-span"> 개월)</span>

                                    {{-- 경력을 선택할 경우 반드시 최소개월수 / 최대개월수를 입력해야합니다 --}}

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">우대조건</th>
                            <td>
                                <input type="radio" name="prefCd" class="tbl-radio" value="" id="prefCd01"  {{ $params['prefCd'] == '' ? 'checked' : '' }}>
                                <label for="prefCd01">전체</label>

                                <input type="radio" name="prefCd" class="tbl-radio" value="13" id="prefCd02"  {{ $params['prefCd'] == '13' ? 'checked' : '' }}>
                                <label for="prefCd02">청년층</label>

                                <input type="radio" name="prefCd" class="tbl-radio" value="B" id="prefCd03"  {{ $params['prefCd'] == 'B' ? 'checked' : '' }}>
                                <label for="prefCd03">고령자</label>

                                <input type="radio" name="prefCd" class="tbl-radio" value="12" id="prefCd04"  {{ $params['prefCd'] == '12' ? 'checked' : '' }}>
                                <label for="prefCd04">여성</label>
                            </td>

                            {{-- 우대조건과 장애인 채용희망은 값 확인이 필요합니다 --}}
                        </tr>
                        <tr>
                            <th class="w167">장애인 채용희망</th>
                            <td>
                                <input type="checkbox" name="pref" class="tbl-checkbox" value="Y" id="pref01"  {{ $params['pref'] && in_array('Y', $params['pref']) ? 'checked' : '' }}>
                                <label for="pref01">장애인 병행채용</label>

                                {{-- 장애인 우대 value 없음 --}}
                                <input type="checkbox" name="pref" class="tbl-checkbox" value="" id="pref02"  {{ $params['pref'] && in_array('', $params['pref']) ? 'checked' : '' }}>
                                <label for="pref02">장애인 우대</label>

                                <input type="checkbox" name="pref" class="tbl-checkbox" value="D" id="pref03"  {{ $params['pref'] && in_array('D', $params['pref']) ? 'checked' : '' }}>
                                <label for="pref03">장애인만 채용</label>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">등록기간</th>
                            <td>
                                <div class="tbl-wbr">
                                    {{-- 날짜 값 확인 필요--}}
                                    <input type="date" class="tbl-datepicker" name="regDt" value="{{ $params['regDt'] }}">
                                    <span class="tbl-tilde">~</span>
                                    <input type="date" class="tbl-datepicker" name="closeDt" value="{{ $params['closeDt']  }}">
                                </div>

                                <div class="tbl-block">
                                    <input type="radio" name="regDate" class="tbl-radio" value="" id="regDate01" {{ $params['regDate'] == '' ? 'checked' : '' }} >
                                    <label for="regDate01">전체</label>

                                    <input type="radio" name="regDate" class="tbl-radio" value="D-0" id="regDate02" {{ $params['regDate'] == 'D-0' ? 'checked' : '' }}>
                                    <label for="regDate02">오늘</label>

                                    <input type="radio" name="regDate" class="tbl-radio" value="D-3" id="regDate03" {{ $params['regDate'] == 'D-3' ? 'checked' : '' }}>
                                    <label for="regDate03">3일</label>

                                    <input type="radio" name="regDate" class="tbl-radio" value="W-1" id="regDate04" {{ $params['regDate'] == 'W-1' ? 'checked' : '' }}>
                                    <label for="regDate04">1주 이내</label>

                                    <input type="radio" name="regDate" class="tbl-radio" value="W-2" id="regDate05" {{ $params['regDate'] == 'W-2' ? 'checked' : '' }}>
                                    <label for="regDate05">2주 이내</label>

                                    <input type="radio" name="regDate" class="tbl-radio" value="M-1" id="regDate06" {{ $params['regDate'] == 'M-1' ? 'checked' : '' }}>
                                    <label for="regDate06">한달</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">검색키워드</th>
                            <td>
                                <input type="text" name="keyword" class="tbl-input w90p-100" value="{{ $params['keyword'] }}">
                                <input type="submit" class="btn01" id="search_btn" value="검색">
                                <small>예) 전략영업, 개발자, ERP</small>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>{{-- //.table-create.table02 end --}}
                <!------ 검색창 끝 ------>

                <div class="table-head">
                    <span class="list-count">
                        총 <strong>{{  number_format((int)$total) }}</strong>건 있습니다.
                    </span>
                    <select name="view_count" id="view-item-count">
                        <option value="10" {{ $view_count == 10 ? 'selected' : '' }}>10개씩</option>
                        <option value="20" {{ $view_count == 20 ? 'selected' : '' }}>20개씩</option>
                        <option value="30" {{ $view_count == 30 ? 'selected' : '' }}>30개씩</option>
                    </select>
                </div>
            </form>

            <!------ 테이블 시작 ------>
            <div class="list-table table01 list-review">
                <table>
                    <colgroup>
                        <col class="invisible-mobile" width="20%">
                        <col class="visible-all" width="45%">
                        <col class="visible-pc" width="12%">
                        <col class="visible-pc col_datetime" width="12%">
                        <col class="invisible-mobile" width="11%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="invisible-mobile">회사명</th>
                            <th class="invisible-mobile">채용제목/임금/근무지역</th>
                            <th class="visible-pc">학력/경력</th>
                            <th class="visible-pc">등록일</th>
                            <th class="invisible-mobile th_last">마감일</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($lists as $list)
                            @php
                                if($list->title == '')
                                    continue;
                            @endphp


                             <tr>
                            <td class="invisible-mobile">
                                <p>{{ $list->company }}</p>
                            </td>
                            <td class="visible-all td_summary">
                                <p class="visible-mobile">{{ $list->company }}</p>
                                <p><a href="/course/employment/{{$list->wantedAuthNo}}/view">{{ $list->title }}</a></p>
                                <p><a href="/course/employment/{{$list->wantedAuthNo}}/view">{{ $list->basicAddr }}</a></p>
                                <p><a href="/course/employment/{{$list->wantedAuthNo}}/view">{{ number_format((int)$list->minSal) }} /{{ number_format((int)$list->maxSal) }}</a></p>
                                <p class="visible-tablet visible-mobile">{{ $list->minEdubg }}</p>
                                <p class="visible-tablet visible-mobile">{{ $list->career }}</p>
                                <p class="visible-tablet visible-mobile">{{ $list->regDt }}</p>
                            </td>
                            <td class="visible-pc">
                                <p>{{ $list->minEdubg }}</p>
                                <p>{{ $list->career }}</p>
                            </td>
                            <td class="visible-pc">{{ $list->regDt }}</td>
                            <td class="invisible-mobile">{{ $list->closeDt }}</td>
                        </tr>
                        @endforeach

                        @if((count($lists) - 2) == 0)
                            <tr>
                                <td colspan="100">내역이 존재하지 않습니다.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>


                <div class="paging-wrap">
                    <x-WorknetPaging record="{{ (int)$total }}" page="{{ $page }}" firstArea="{{ $params['firstArea'] }}"
                                     secondArea="{{ $params['secondArea'] }}" firstJob="{{ $params['firstJob'] }}" secondJob="{{ $params['secondJob'] }}" thirdJob="{{ $params['thirdJob'] }}" salTp="{{ $params['salTp'] }}"
                                     minPay="{{ $params['minPay'] }}" maxPay="{{ $params['maxPay'] }}" education="{{ $params['education'] }}" prefCd="{{ $params['prefCd'] }}" pref="{{ $params['pref'] }}" career="{{ $params['career'] }}"
                                     regDt="{{ $params['regDt'] }}" minCareerM="{{ $params['minCareerM'] }}" maxCareerM="{{ $params['maxCareerM'] }}" closeDt="{{ $params['closeDt'] }}" regDate="{{ $params['regDate'] }}" keyword="{{ $params['keyword'] }}" viewCount="{{ (int)$view_count }}"/>
                </div>

            </div>
            <!------ 테이블 끝 ------>


        </div>
    </div>

@endsection
