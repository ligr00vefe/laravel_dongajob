<?php

//--- random string 반환
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('generate_string')) {
    function generate_string($length): string
    {
        $characters = "0123456789";
        $characters .= "abcdefghijklmnopqrstuvwxyz";
        $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $characters .= "_";

        $string_generated = "";

        $nmr_loops = $length;
        while ($nmr_loops--) {
            $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string_generated;
    }
}


if (!function_exists('msg_collection')) {

    function msg_collection($key = null)
    {

        $list = [
            'success_enrollment' => '정상적으로 등록되었습니다.',
            'error_enrollment' => '문제가 발생했습니다. 다시 시도해 주세요',
            'success_correction' => '정상적으로 수정되었습니다.',
            'failure_correction' => "수정하는데 실패 하였습니다. 다시 시도해 주세요.",
            'access_impossible' => '잘못된 접근입니다.',
            'reservation_already' => '이미 예약한 상태입니다.',
            'studyroom_already' => '이미 예약되어 있는 스터디룸 입니다. 확인하시길 바랍니다.',
            'studyroom_already_today' => '오늘 이미 예약을 하셨습니다.',
            'reservation_full' => '정원 초과 입니다.',
            'failure_extension' => '첨부할수 없는 확장자 파일입니다.',
            'failure_login' => '로그인 후 서비스 이용이 가능합니다.',
            'none_post' => '존재하지 않는 게시물 입니다.',
            'failure_receipt' => '접수불가능한 상태 입니다.',
            'failure_manager' => '관리자는 서비스를 이용하실수가 없습니다.',
            'add_scrap' => '등록완료 스크랩 내역은 마이페이지에서 확인 가능합니다.',
            'remove_scrap_confirm' => '이미 등록된 스크랩내역입니다 삭제하시겠습니까?',
            'remove_scrap' => '스크랩이 삭제되었습니다',
            'success_remove' => '정상적으로 삭제되었습니다.',
            'failure_remove' => '삭제하는데 실패했습니다. 다시 시도해 주세요.',
            'failure_already_room' => '예약이 되어 있는 스터디룸이라 삭제가 불가능 합니다.<br> 삭제하시려면 예약자 먼저 삭제하시길 바랍니다.',
            'no_show_dont_reservation' => '무단 미사용으로 인해 한달간 예약을 하실수가 없습니다.',
            'already_room_reservation' => '2회예약으로 인해 일주일간 예약을 하실수가 없습니다.',
            'empty_content' => '내용을 입력해주시길 바랍니다.',
            'failure_already_recommend' => '의 채용글에 지원자가 있어 삭제가 불가능 합니다.<br> 삭제하시려면 지원자 먼저 삭제하시길 바랍니다.',
        ];


        if ($key) {
            return $list[$key];
        }

        return $list;
    }

}


// id 넣으면 attachments 리턴
function getAttach($id)
{
    return \Illuminate\Support\Facades\DB::table("attachments")
            ->where("id", "=", $id)
            ->first() ?? false;
}

//--- 게시판 매핑된 값
if (!function_exists('board_id_lists')) {

    function board_id_lists($key = null)
    {

        $list = [
            'notice' => 100
        ];


        if ($key) {
            return $list[$key];
        }

        return $list;
    }
}


//--- 성별
function get_gender_list($key = null)
{
    $list = [
        1 => '남자',
        2 => '여자'
    ];

    if ($key) {
        return $list[$key];
    }

    return $list;
}


//--- 무작위 문자열
function getRandStr($length = 6): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//--- 관리자 체크
function is_manager_check($account): bool
{
    $list = [
        'admin'
    ];


    return in_array($account, $list, true);

}

function get_url_query($key)
{
    return $_GET[$key];
}


//*================= 학생관련 ====================*//
function get_user_id($id)
{
    return DB::table('users')
        ->select('account')
        ->find($id)
        ->account;
}


function get_user_info($user_id)
{
    return DB::table('students')
        ->where('account', $user_id)
        ->first();
}


//*================= 회원관련 ====================*//
function get_manager_type_value($type): int
{
    if ($type == 'student' || $type == '학생') {
        return 1;
    } else if ($type == 'admin') {
        return 2;
    } else if ($type == 'staff' || $type == '교직원') {
        return 3;
    } else {
        return 0;
    }
}

function get_manager_value_type($type)
{
    if ($type == '학생') {
        return 'student';
    } else if ($type == '교직원') {
        return 'staff';
    } else if ($type == '관리자') {
        return 'admin';
    }
}


// 학생인지 체크
function isStudentCheck($val): bool
{
    return $val == 1 || $val == 'student';
}

// 관리자인지 체크
function isAdminCheck($val): bool
{
    return $val == 2 || $val == 'admin';
}

// 관계자인지 체크
function isStaffCheck($val): bool
{
    return $val == 3 || $val == 'staff';
}

// 삭제된 관리자 인지
function isDeleteCheck($val): bool
{
    return $val == 0;
}

// 동아대 실서버인지
function isDongaServer(): bool
{
    return DONGA_NAME == $_SERVER['SERVER_NAME'];
}

function isByDesc($by): bool
{
    return $by === 'desc';
}

function dongaDomainChange($content)
{
    $old = 'jobtest.donga.ac.kr';

    if (isDongaServer()) {
        return $content ? str_replace($old, DONGA_NAME, $content) : '';
    }

    return '';
}
