<?php

use App\Models\ProgramReservation;

if (!function_exists('get_program_status_lists')) {

    function get_program_status_lists($key = null)
    {
        $list = [
            0 => '접수대기',
            1 => '접수중',
            2 => '접수마감',
            3 => '대기접수중',
            4 => '대기접수 마감'
        ];


        if (isset($key)) {
            return $list[$key];
        }

        return $list;
    }

}

if (!function_exists('get_program_status_auto_lists')) {
    function get_program_status_auto_lists($key = null)
    {
        $list = [
            100 => '자동',
            200 => '수동'
        ];

        if (isset($key)) {
            return $list[$key];
        }

        return $list;
    }
}

if (!function_exists('is_program_status_auto')) {
    /**
     * 프로그램 상태여부가 자동인지 체크
     * @param $val
     * @return bool
     */
    function is_program_status_auto($val): bool
    {
        return $val == 100;
    }
}


if (!function_exists('get_program_education_target_lists')) {

    function get_program_education_target_lists($id = null)
    {
        $list = [
            100 => '전체',
            200 => '재학생',
            300 => '졸업생',
            400 => '휴학생',
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }
}

if (!function_exists('get_program_student_grade_lists')) {

    function get_program_student_grade_lists($id = null)
    {
        $list = [
            10 => '전학년',
            1 => '1학년',
            2 => '2학년',
            3 => '3학년',
            4 => '4학년'
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }
}


if (!function_exists('get_program_reservation_status_lists')) {

    function get_program_reservation_status_lists($id = null)
    {
        $list = [
            '신청자' => 1,
            '대기자' => 2,
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }
}


if (!function_exists('get_program_open_lists')) {

    function get_program_open_lists($id = null)
    {
        $list = [
            1 => '공개',
            0 => '비공개'
        ];

        if (isset($id)) {
            return $list[(int)$id];
        }

        return $list;
    }
}


if (!function_exists('get_bank_lists')) {

    function get_bank_lists($id = null)
    {
        $list = [
            100 => '경남은행',
            200 => '광주은행',
            300 => '국민은행',
            400 => '기업은행',
            500 => '농협중앙회',
            600 => '농협회원조합',
            700 => '대구은행',
            800 => '도이치은행',
            900 => '부산은행',
            1000 => '산업은행',
            1100 => '상호저축은행',
            1200 => '새마을금고',
            1300 => '수협중앙회',
            1400 => '신한금융투자',
            1500 => '신한은행',
            1600 => '신협중앙회',
            1700 => '외환은행',
            1800 => '우리은행',
            1900 => '우체국',
            2000 => '전북은행',
            2100 => '제주은행',
            2200 => '카카오뱅크',
            2300 => '케이뱅크',
            2400 => '하나은행',
            2500 => '한국씨티은행',
            2600 => 'HSBC은행',
            2700 => 'SC제일은행',
            2800 => '기타'
        ];


        if (isset($id)) {
            return array_key_exists($id, $list) ? $list[$id] : $list['2800'];
        }

        return $list;
    }
}


if (!function_exists('get_status_html')) {
    function get_status_html($list): string
    {
        $type = 1;
        $html = '';

        if ($list->status_auto == 0) { // 수동일경우
            $type = get_status_type($list);
            $type = $type == 0 ? 1 : $type;
            $html = '<p class="status0' . $type . '">' . get_program_status_lists($type) . '</p>';
        } else if ($list->status_auto == 1) { // 자동일경우 : DB 상태값 대로 보여준다.
            $html = '<p class="status0' . $list->status . '">' . get_program_status_lists($list->status) . '</p>';
        }

        return $html;
    }
}


if (!function_exists('get_status_type')) {
    /**
     * 프로그램 신청 경우에 따른 상태값 return 함수
     * @param $list
     * @return int
     */
    function get_status_type($list): int
    {
        $is_application = ProgramReservation::is_reservation_full($list->id, 1); // 신청자 꽉찼는지
        $is_waiting = ProgramReservation::is_reservation_full($list->id, 2); // 대기자 꽉찼는지


        $sd = strtotime($list->start_reception_date . " " . $list->start_reception_time); // 접수 시작시간
        $td = strtotime(date('Y-m-d H:i')); // 현재시간
        $ed = strtotime($list->end_reception_date . " " . $list->end_reception_time); // 접수 마감시간


        if ($sd < $td && $td > $ed) { // 접수마감
            return 2;
        }

        if ($sd < $td && $td < $ed && $is_application && !$is_waiting) { // 3. 대기접수중 : 접수일시가 마감되진 않았으나 수강인원은 마감되고 대기인원만 남았을 때
            return 3;
        }

        if ($sd < $td && $td < $ed && $is_application && $is_waiting) {  // 4. 대기접수마감 : 접수일시가 마감되진 않았으나 수강인원, 대기인원 모두 정원초과일때
            return 4;
        }

        if ($sd <= $td && $td < $ed) { // 1. 접수중 : 접수일시 기간일떄
            return 1;
        }

        if ($sd > $td) { // 0. 접수대기 : 오늘날짜가 접수일시보다 이전일경우
            return 0;
        }


        return 2; // 2. 접수마감 : 접수일시가 마감일떄 or 혹여나 빈값들어왔을 때 마감처리




    }
}
