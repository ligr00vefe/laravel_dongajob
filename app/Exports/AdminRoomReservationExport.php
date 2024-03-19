<?php

namespace App\Exports;

use App\Models\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class AdminRoomReservationExport implements FromView, WithColumnWidths
{

    public function columnWidths(): array
    {

        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
        ];
    }

    public function view(): View
    {
//        $from = ($_REQUEST['from'] != 'undefined' && $_REQUEST['from'] != '') ? '?from='.$_REQUEST['from'] : '';
//        $to = ($_REQUEST['to'] != 'undefined' && $_REQUEST['to'] != '') ? '&to='.$_REQUEST['to'] : '';
        if($_REQUEST['data_type'] == '1'){
            $campus = ($_REQUEST['campus'] != 'undefined' && $_REQUEST['campus'] != '') ? $_REQUEST['campus'] : '';
            $room = ($_REQUEST['room'] != 'undefined' && $_REQUEST['room'] != '') ? $_REQUEST['room'] : '';
            $type = ($_REQUEST['type'] != 'undefined' && $_REQUEST['type'] != '') ? $_REQUEST['type'] : '';
            $date = ($_REQUEST['date'] != 'undefined' && $_REQUEST['date'] != '') ? $_REQUEST['date'] : '';
            $schedule_date = ($_REQUEST['schedule_date'] != 'undefined' && $_REQUEST['schedule_date'] != '') ? $_REQUEST['schedule_date'] : '';
            $schedule_end_date = ($_REQUEST['schedule_end_date'] != 'undefined' && $_REQUEST['schedule_end_date'] != '') ? $_REQUEST['schedule_end_date'] : '';
            $keyword = ($_REQUEST['keyword'] != 'undefined' && $_REQUEST['keyword'] != '') ? $_REQUEST['keyword'] : '';
            $term = ($_REQUEST['term'] != 'undefined' && $_REQUEST['term'] != '') ? $_REQUEST['term'] : '';
        }else{
            $campus = '';
            $room = '';
            $type = '';
            $date = '';
            $schedule_date = '';
            $schedule_end_date = '';
            $keyword = '';
            $term = '';
        }

        //var_dump($_REQUEST);exit;
        //var_dump($_REQUEST);exit;
        //DB::enableQueryLog();
        $contents = DB::table("room_reservations")
            ->select('room_reservations.id', 'room_reservations.office_equipment', 'room_reservations.ip', 'room_reservations.location', 'room_reservations.room_id', 'room_reservations.date', 'room_reservations.target_type', 'room_reservations.status', 'room_reservations.campus_id', 'room_reservations.created_at', 'room_reservations.use_people', 'room_reservation_students.account', 'room_reservation_students.type', 'room_reservation_dates.time')
            ->distinct('room_reservation_students.reservation_id')
            ->leftJoin('study_rooms', 'room_reservations.room_id', '=', 'study_rooms.id')
            ->leftJoin('room_reservation_students', 'room_reservations.id', '=', 'room_reservation_students.reservation_id')
            ->leftJoin('room_reservation_dates', 'room_reservations.id', '=', 'room_reservation_dates.reservation_id')
            ->when($campus, function ($query, $campus) {
                return $query->where('room_reservations.campus_id', $campus);
            })
            ->when($type, function ($query, $type) {
                return $query->where('room_reservations.target_type', $type);
            })
            ->when($room, function ($query, $room) {
                return $query->where('study_rooms.name', 'like', '%' . $room . '%');
            })
            ->when($schedule_end_date, function ($query, $schedule_end_date) use ($date, $schedule_date) {
                if ($date == 'application')
                    //return $query->where('room_reservations.created_at', 'like', '%' . $schedule_date . '%');
                    return $query->whereDate('room_reservations.created_at', '>=', $schedule_date)->whereDate('room_reservations.created_at', '<=', $schedule_end_date);
                else if ($date == 'reservation')
                    //return $query->where('room_reservations.date', 'like', '%' . $schedule_date . '%');
                    return $query->whereDate('room_reservations.date', '>=', $schedule_date)->whereDate('room_reservations.date', '<=', $schedule_end_date);
            })
            ->when($term, function ($query, $term) use ($keyword) {
                if ($keyword == 'name') {
                    return $query
                        ->leftJoin('users', 'room_reservation_students.account', '=', 'users.account')
                        ->where('users.name', 'like', '%' . $term . '%');

                } else if ($keyword == 'account') {
                    return $query->where('room_reservation_students.account', 'like', '%' . $term . '%');
                }
            })
            ->where('room_reservation_students.type', 1)
            ->orderByDesc("room_reservations.id")
            ->get();



        //var_dump(DB::getQueryLog());exit;
        //dd($contents);

        $index = 1;
        $heads = ["번호", "학번", "타입", "스터디룸", "캠퍼스", "타입2", "인원", "사무기기", "장소", "상태", "예약날짜", "시간", "스터디룸IP", "등록날짜"];
        return view("admin._excel.study.reservation", ["heads" => $heads, "contents" => $contents, "index" => $index]);
    }

}
