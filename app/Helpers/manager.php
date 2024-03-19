<?php

/**
 * 관리자 메뉴 리스트들
 * 인자로 $menu_id를 넣으면 해당 key값 반환합니다. ex) $menu_id : 1,2,3
 */
if (!function_exists("get_admin_menu_list")) {

    function get_admin_menu_list($menu_id = null)
    {

        $list = [
            100 => '회원관리',
            200 => '채용정보',
            300 => '공지사항',
//            400 => '온라인 컨텐츠 관리',
            500 => '취업지원실 프로그램 관리',
            600 => '취업자료실',
            700 => '스터디룸 예약',
            800 => '통계',
            900 => '로그'
        ];

        $menus = [];
        if (isset($menu_id)) {
            $ids = explode(',', $menu_id);

            foreach ($ids as $no) {
                if($no == '') {
                    $menus[] = '';
                    continue;
                }

                $menus[] = $list[$no];
            }
        }

        return isset($menu_id) ? implode(',', $menus) : $list;

    }

    function get_admin_menu_table($menu_id): string
    {
        $list = [
            200 => 'board_recommends',
            300 => 'board_notices',
        ];

        return $list[$menu_id];
    }


    function get_admin_menu_route($key): string
    {
        $route = '';
        switch ($key) {
            case 200:
                $route = '/jobinfo/recommend';
                break;
            case 300:
                $route = '/notice';
                break;
            case 500:
                $route = '/support/program';
                break;
            case 600:
                $route = '/archive/reviewlatest';
                break;
            case 700:
                $route = '/study/reservation';
                break;
            case 800:
                $route = '/statistics';
                break;
            case 900:
                $route = '/auth';
                break;
        }

        return $route;
    }
}


// 로그페이지 - 수행업무가 관리자변경인지
function isLogAuthority($val): bool
{
    $list = [
        '관리자생성',
        '관리자수정',
        '관리자삭제',
    ];

    return in_array($val, $list);
}
