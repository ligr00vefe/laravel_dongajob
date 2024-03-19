<?php

use App\Models\Alimi;
use App\Models\BoardCategory;
use Illuminate\Support\Facades\DB;

class StudentAlimi
{

    private Alimi $alimi;


    public function __construct()
    {
        $this->alimi = new Alimi();
    }


    public function getRecommendCategory($val = false)
    {
        $category = [
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
            1900 => '기타 사무직(인문)'
        ];

        return $val ? $category[$val] : $category;
    }

    public function getNoticeCategory($val = false)
    {
        $category = [
            100 => '취업동아리',
            200 => '재직선배교육',
            300 => '자격증 및 실무자 양성과정',
            400 => '채용설명회 및 박람회',
            500 => '특강',
            600 => '기타'
        ];

        return $val ? $category[$val] : $category;
    }


    public function getCategoryList($account): array
    {
        return [
            array_search('채용정보', get_admin_menu_list(), true) => $this->alimi->getData($account, array_search('채용정보', get_admin_menu_list(), true)),
            array_search('공지사항', get_admin_menu_list(), true) => $this->alimi->getData($account, array_search('공지사항', get_admin_menu_list(), true))
        ];
    }

    public function getColum($menu_id)
    {
        switch ($menu_id) {
            case  array_search('채용정보', get_admin_menu_list(), true):
                return "board_recommends.*";
                break;

            case  array_search('공지사항', get_admin_menu_list(), true):

                break;
        }


    }


    public function getLists($menu_id, $categories): array
    {
        $data = '';
        $paging = '';
        $table = get_admin_menu_table($menu_id);
        $boardCategory = new BoardCategory();

        $category = [];
        foreach ($categories as $val) {
            $category['category_id'][] = $val->category_id;
            $category['date'][$val->category_id] = $val->updated_at;
        }


        if (!$category['category_id']) {

            $data = '<td colspan="8">알림 내역이 존재하지 않습니다.</td>';

        } else {

            $lists = $boardCategory->getData($menu_id, $table, $category['category_id']);
            $paging = $lists->links("vendor.pagination.default") ;

            foreach ($lists as $list) {
                $data .= $this->getHtml($menu_id, $list, $category['date']);
            }

        }


        return [
            'data' => $data,
            'page' => $paging
        ];

    }

    private function getHtml($menu_id, $list, $category): string
    {
        $data = '';

        switch ($menu_id) {
            case  array_search('채용정보', get_admin_menu_list(), true):

                $data .= '<tr>';
                $data .= '<td><input type="checkbox" name="chk[]" class="_chk" value="' . $list->id . '"></td>';
                $data .= ' <td class="visible-pc">' . $list->company_name . '</td>';
                $data .= '<td class="visible-pc td_subject"><a href="/jobinfo/recommend/' . $list->id . '/view">' . $list->recruitment_field . '</td>';
                $data .= '<td class="visible-pc">' . get_recommend_recruitment_lists($list->category) . '</td>';
                $data .= '<td class="visible-pc">' . get_recommend_screening_method_lists($list->screening_method) . '</td>';
                $data .= '<td class="visible-pc">' . get_work_area_lists($list->work_area) . '</td>';
                $data .= '<td class="visible-tablet td_summary">';
                $data .= '<p>' . $list->company_name . '</p>';
                $data .= '<p>' . $list->recruitment_field . '</p>';
                $data .= '<p class="visible-mobile">' . $list->created_at . '</p>';
                $data .= '</td>';
                $data .= '<td class="td_deadline invisible-mobile">' . $list->created_at . '</td>';
                $data .= '<td class="visible-pc">' . $list->hit . '</td>';
                break;

            case  array_search('공지사항', get_admin_menu_list(), true):

                break;
        }

        return $data;
    }







}

