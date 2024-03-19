<?php

if (!function_exists('get_interview_category')) {

    function get_interview_category($id = null)
    {
        $list = [
            100 => '신입',
            200 => '인턴',
            300 => '채용형 인턴',
            400 => '체험형 인턴',
        ];


        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }

}


if (!function_exists('get_interview_next_type')) {

    function get_interview_next_type($id = null)
    {
        $list = [
            100 => '1차면접',
            200 => '2차면접',
            300 => '통합면접'
        ];

        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }

}


if (!function_exists('get_interview_status')) {

    function get_interview_status($id = null)
    {
        $list = [
            100 => '미입력',
            200 => '합격',
            300 => '불합격',

        ];



        if (isset($id)) {
            return $list[$id];
        }

        return $list;
    }

}
