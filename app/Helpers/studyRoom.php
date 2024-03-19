<?php


function show_use_data($use, $mode = null): string
{
    if ($use == 1) {
        $msg = '가능';
        $color = '#01387F';
    } else {
        $msg = '불가능';
        $color = '#EE1414';
    }

    if ($mode == 'html') {
        return '<span style="color:' . $color . '" data-use="' . $use . '">' . $msg . '</span>';
    }

    return $msg;
}


function get_room_html($lists): string
{
    $html = '';

    //--- 데이터가 없을 떄
    if (empty($lists)) {
        $html = '<div>등록된 스터디룸이 존재하지 않습니다.</div>';
    } else {


        foreach ($lists as $key => $val) {

            // id 값 세팅
            $id = 'room' . $key + 1;

            $operation_time = get_time_range($val->time);

            $html .= '<li>';
            $html .= '<input type="radio" id="' . $id . '" class="room-option" name="room_id" value="' . $val->id . '">';
            $html .= '<label for="' . $id . '">';
            $html .= '<span class="room-info">';
            $html .= '<h6 class="info-subject">' . $val->name . '</h6>';
            $html .= '<p class="info-desc">' . $val->info_desc . '</p>';
            $html .= '<p> 운영시간' . $operation_time . '</p>';
            $html .= '</span>';
            $html .= '</label>';
            $html .= '</li>';
        }

    }
    return $html;
}


/**
 * 스터디룸 이용시간 시작시간 마감시간을 return 하는 함수
 * @param $val : 시간대 배열
 * @return string : 13:00 ~ 15:00
 */
function get_time_range($val): string
{
    $operation_time = '';

    if (!$val) {
        return '';
    }

    // 인자의 값이 배열이라면 바로 사용이 가능하기 때문에 $times 변수에 초기화 한다.
    if (is_array($val)) {
        $times = $val;
        $end_time = explode(':', $times[count($times) - 1])[0] + 1;

        if (strpos($end_time, ':') !== true) {
            $end_time .= ':00';
        }

        $operation_time = sprintf('%s ~ %s', $times[0], $end_time);
    } else {
        // 문자열로 이루어졌을 때 explode로 배열화 시킨다.
        $times = explode(',', $val);

        $end_time = explode(':', $times[count($times) - 1])[0];
        $operation_time = sprintf('%s ~ %s', $times[0], $end_time . ':00');

    }

    return $operation_time;
}


function get_room_time_html($times, $reservations): string
{
    $html = '';
    $index = 1;
    foreach ($times as $key => $val) {

        //--- 예약배열에 예약시간이 담겨져 있으면 disable class 를 담는다.
        $class_name = '';
        if (in_array($val, $reservations))
            $class_name = 'disabled-time';

        $html .= '<li class="' . $class_name . '">';
        $html .= '<p >' . $val . '<input type="checkbox" id="time_' . $index . '" class="input_time" name="time[]" value="' . $val . '" style="display: none"></p>';
        $html .= '</li>';

        $index++;
    }

    return $html;
}


//--- 예약 테이블 객체가 들어오면 시간을 배열에 담아 리턴한다.
function get_room_reservation_time_array($reservations)
{
    $times = [];
    if ($reservations) {
        foreach ($reservations as $val) {
            $times[] = $val->time;
        }
    }

    return $times;

}


if (!function_exists('get_week_day')) {
    function get_week_day($day): string
    {
        $week = ['일', '월', '화', '수', '목', '금', '토'];

        return $week[$day];
    }
}

function get_campus_name($key): string
{

    $list = [
        1 => '승학',
        2 => '부민'
    ];


    return $list[$key];
}


// 스터디룸 예약리스트 입력자 key
function get_room_target_type($key): string
{
    $list = [
        1 => '학생',
        2 => '관리자'
    ];

    return $list[$key];
}

function study_room_time_range(): array
{
    $list = [
        '10:00',
        '11:00',
        '12:00',
        '13:00',
        '14:00',
        '15:00',
        '16:00',
        '17:00',
        '18:00',
        '19:00',
        '20:00',
        '21:00',
        '22:00',
        '23:00'
    ];

    return $list;
}

function get_room_status($key = null, $mode = null)
{
    $list = [
        0 => '사용전',
        1 => '사용완료',
        2 => '미사용'
    ];


    if (isset($mode)) {
        $color = '';
        if ($key == 1) {
            $color = '#01387F';
        } else if ($key == 2) {
            $color = '#EE1414';
        }

        $list[$key] = '<span style="font-weight:bold;color:' . $color . '">' . $list[$key] . '</span>';
    }


    if (isset($key)) {
        return $list[$key];
    }

    return $list;
}


function get_mypage_modal_html($lists): string
{
    $html = '';

    if (!$lists)
        return $html;


    foreach ($lists as $list) {

        $type = $list->type == 1 ? '신청자' : '동반자';

        $student = \App\Models\Student::getStudent($list->account);


        $html .= ' <tr>
                  <td><p>' . $type . '</p></td>
                  <td><p>' . $student->name . '</p></td>
                  <td><p>' . $list->account . '</p></td>
              </tr>';

    }

    return $html;
}

function get_study_room_reservation_type($key)
{
    $list = [
        1 => '예매자',
        2 => '동반자'
    ];


    return $list[$key];
}
