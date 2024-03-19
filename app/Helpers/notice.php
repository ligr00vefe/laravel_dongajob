<?php

if (!function_exists('get_notice_category')) {

    function get_notice_category($id = null)
    {
        $list = [
            100 => '취업동아리',
            200 => '재직선배 교육',
            300 => '자격증 및 실무자양성',
            400 => '채용 설명회 및 박람회',
            500 => '특강',
            600 => '기타'
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }

    function get_main_notice_category($id = null)
    {
        $list = [
            10 => '전체',
            100 => '취업동아리',
            200 => '재직선배 교육',
            300 => '자격증 및 실무자양성',
            400 => '채용 설명회 및 박람회',
            500 => '특강',
            600 => '기타'
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }

}

if (!function_exists('get_notice_status')) {

    function get_notice_status($id = null)
    {

        $list = [
            0 => '기본',
            1 => '공지',
            2 => '모집',
        ];


        if (isset($id)) {
            return $list[$id];
        }else {
            return $list[0];
        }

        return $list;
    }

}

function get_notice_html($lists): string
{
    $html = '';
    foreach ($lists as $list) {
        $html .= '<li>
                    <a href="/program/notice/' . $list->id . '/view">
                        <span class="ml-cate">[' . get_notice_category($list->category_id) . ']</span>
                        <p>' . $list->subject . '</p>
                        <p class="ml-datetime">' . date('Y-m-d', strtotime($list->created_at)) . '</p>
                    </a>
                </li>';
    }

    if (!count($lists)) {
        $html = '<li style="text-align: center">등록된 게시물이 없습니다.</li>';
    }

    return $html;
}

function get_review_html($lists, $category): string
{
    $html = '';

    foreach ($lists as $list) {

        if (isAdminCheck($list->user_type)) {
            $user = \App\Models\User::getUser($list->account);
        } else if (isStudentCheck($list->user_type)) {
            $user = \App\Models\Student::getStudent($list->account);
        }


        $html .= '<li>
                    <a href="/archive/' . $category . '/' . $list->id . '/view">
                        <span class="ml-name">' . $user->name . '</span>
                        <p>' . $list->subject . '</p>
                        <p class="ml-datetime">' . date('Y-m-d', strtotime($list->created_at)) . '</p>
                    </a>
                </li>';
    }

    if (!count($lists)) {
        $html = '<li style="text-align: center">등록된 게시물이 없습니다.</li>';
    }

    return $html;
}


function get_normal_html($lists)
{
    $html = '';

    foreach ($lists as $list) {


        $html .= ' <li>
                         <a href="/jobinfo/normal/' . $list->id . '/view">
                            <h3 class="m03-subject">' . $list->company_name . '</h3>
                            <span class="deadline-icon di01">마감일</span><p class="deadline-date">' .  $list->receipt_end_date . '</p>
                        </a>
                    </li>';
    }

    if (empty($html)) {
        $html = '<div style="text-align: center">등록된 게시물이 없습니다.</div>';
    }


    return $html;
}


