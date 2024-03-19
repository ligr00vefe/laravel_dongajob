<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomReservation extends Model
{
    use HasFactory;


    /**
     * type에 따라 예약자 정보 가져오기
     * @param $type : 1: 예약자 2: 동반자
     */
    public static function get_student_subscriber($id, $type = null)
    {

        return DB::table('room_reservation_students')
            ->where('reservation_id', $id)
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->get();
    }


    //--- id값을 통해 예약한 시간 가져오기
    public static function get_date_subscriber($id)
    {
        return DB::table('room_reservation_dates')
            ->where('reservation_id', $id)->get();
    }


    //--- 노쇼 체크 함수 true return 시 무단으로인해 금지상황
    public static function is_no_show_check($account, $room_id = null): bool
    {
        $max = 3; // no-show max cnt
        $result = false;

        //--- 회원의 노쇼 리스트 체크 status = 2
        $lists = DB::table("room_reservation_students")
            ->leftJoin('room_reservations', 'room_reservation_students.reservation_id', '=', 'room_reservations.id')
            ->where('room_reservation_students.account', $account)
            ->where('room_reservations.status', 2)
            ->when($room_id, function($query, $room_id) {
                return $query->where('room_reservations.room_id', '!=', $room_id);
            })
            ->get();


        //--- 미사용 카운트보다 더클경우
        if (!empty($lists) && count($lists) >= $max) {
            $result = true;
        }

        return $result;

    }


    //--- 1주일 이내 예약 있는지 체크
    public static function is_week_reservation($account, $room_id = null): bool
    {
        $max = 2;
        $cnt = 0;
        $result = false;

        $lists = DB::table("room_reservation_students")
            ->leftJoin('room_reservations', 'room_reservation_students.reservation_id', '=', 'room_reservations.id')
            ->where('room_reservation_students.account', $account)
            ->when($room_id, function($query, $room_id) {
                return $query->where('room_reservations.room_id', '!=', $room_id);
            })
            ->get();

        $before_day = date("Y-m-d", strtotime("-7 day"));

        foreach ($lists as $list) {
            if ($list->created_at >= $before_day) {
                $cnt++;
            }
        }

        if ($cnt >= $max) {
            $result = true;
        }

        return $result;

    }


    public static function get_no_show_count($account): int
    {
        //--- 회원의 노쇼 카운트 status = 2
        $lists = DB::table("room_reservation_students")
            ->leftJoin('room_reservations', 'room_reservation_students.reservation_id', '=', 'room_reservations.id')
            ->where('room_reservation_students.account', $account)
            ->where('room_reservations.status', 2)
            ->get();

        return count($lists);


    }
}
