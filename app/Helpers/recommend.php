<?php

if (!function_exists('get_recommend_recruitment_lists')) {

    function get_recommend_recruitment_lists($id = null)
    {
        $list = [
            100 => '정규직',
            200 => '인턴직',
            300 => '계약직'
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }
}

if (!function_exists('get_work_area_lists')) {

    function get_work_area_lists($id = null)
    {
        $list = [
            100 => '서울특별시',
            200 => '부산광역시',
            300 => '대구광역시',
            400 => '인천광역시',
            500 => '광주광역시',
            600 => '대전광역시',
            700 => '울산광역시',
            800 => '세종특별자치시',
            900 => '경기도',
            1000 => '강원도',
            1100 => '충청북도',
            1200 => '충청남도',
            1300 => '전라북도',
            1400 => '전라남도',
            1500 => '경상북도',
            1600 => '경상남도',
            1700 => '제주특별자치도',
            1800 => '해외',
            1900 => '기타',
            2000 => '전국'
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }
}


if (!function_exists('get_recommend_screening_method_lists')) {

    function get_recommend_screening_method_lists($id = null)
    {
        $list = [
            100 => '홈페이지',
            200 => '이메일',
            300 => '우편',
            400 => '팩스',
            500 => '직접방문접수',
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }
}


if (!function_exists('get_recommend_alimi_lists')) {

    function get_recommend_alimi_lists($id = null)
    {
        $list = [
            100 => '생산/품질관리',
            200 => '설비기술',
            300 => '설계',
            400 => '연구개발(R&D)',
            500 => '안전(방재)',
            600 => '구매',
            700 => 'IT(SW개발 등)',
            800 => '전산',
            900 => '기술영업',
            1000 => '기타 사무직(이공)',
            1100 => '영업/영업관리',
            1200 => '해외영업',
            1300 => '재무회계',
            1400 => '마케팅',
            1500 => '기획',
            1600 => '인사(총무)',
            1700 => '경영지원',
            1800 => '은행 행원',
            1900 => '기타 사무직(인문)',
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }
}

if (!function_exists('get_support_path')) {
    function get_support_path($id = null)
    {
        $list = [
            100 => '평생지도교수',
            200 => '취업동아리',
            300 => '교직원',
            400 => '취업지원실 채용공지',
            500 => '단과대학(학과 홈페이지)',
            600 => '취업추천 오픈톡',
            700 => '기타'
        ];

        return isset($id) ? $list[$id] : $list;
    }
}


if (!function_exists('get_activity_gender_lists')) {

    function get_activity_gender_lists($id = null)
    {
        $list = [
            100 => '무관',
            200 => '남자',
            300 => '여자'
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }
}


//--- 시간지났는지 체크
function is_time_over($date): bool
{
    $now = strtotime(now());
    $date = strtotime($date);

    return $date > $now;
}

//--- 시간이 between 에 있는지 체크
function is_time_between($s_date, $e_date): bool
{
    return is_time_over($s_date) && is_time_over($e_date);

}


//-- 메인화면
function recommend_main_html($lists): string
{

    $html = '';
    foreach ($lists as $list) {
        $html .= '<li>
                      <a href="/jobinfo/recommend/' . $list->id . '/view">
                        <h3 class="m03-subject">' . $list->company_name . '</h3>
                            <span class="deadline-icon di02">마감일</span><p class="deadline-date">' . $list->receipt_end_date . '</p>
                      </a>
                  </li>';
    }


    if (empty($html))
        $html = '<div style="text-align: center; height: 150px">등록된 게시물이 없습니다.</div>';

    return $html;

}
