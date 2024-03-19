<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudyRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'campus_id',
        'name',
        'location',
        'operating_time',
        'time',
        'use',
        'max_personnel',
        'min_personnel',
        'office_equipment',
        'room_ip',
        'room_password'
    ];

    public static function get($request)
    {
        $page = $request->input("page") ?? 1;


        $seunghak = DB::table("study_rooms")
            ->where("campus_id", 1)
            ->orderByDesc("id")
            ->paginate(10);

        $bumin = DB::table("study_rooms")
            ->where("campus_id", 2)
            ->orderByDesc("id")
            ->paginate(10);


        return [
            "seunghak" => $seunghak,
            "bumin" => $bumin
        ];
    }

    public static function add($request): bool
    {
        $insert = [
            "campus_id" => $request->input("campus_id"),
            "name" => $request->input("name"),
            "info_desc" => $request->input("info_desc"),
            "location" => $request->input("location"),
            "operating_time" => $request->input("operating_time"),
            "time" => $request->input("time"),
            "use" => $request->input("use"),
            "max_personnel" => $request->input("max_personnel"),
            "min_personnel" => $request->input("min_personnel"),
            "office_equipment" => $request->input("office_equipment"),
            "room_ip" => $request->input("room_ip"),
            "created_at" => now(),
            "updated_at" => now()
        ];


        return DB::table("study_rooms")->insert($insert);
    }


    //--- 캠퍼스 아이디를 가지고 사용할수 있는 룸목록 가져오기
    public static function get_room_list($campus): \Illuminate\Support\Collection
    {
        return DB::table("study_rooms")
            ->where('campus_id', $campus)
            ->where('use', 1)
            ->get();
    }

    public static function get_time_list($campus, $id)
    {

        if (!$list = DB::table("study_rooms")->find($id))
            return false;


        if (!$list->use)
            return false;

        return explode(',', $list->time);
    }

    /**
     * 오늘 스터디룸 예약이 되어 있는지 있는지 체크
     * @return bool : 예약 여부
     */
    public static function is_today_reservation($account): bool
    {
        return DB::table('room_reservations')
            ->leftJoin('room_reservation_students', 'room_reservation_students.reservation_id', '=', 'room_reservations.id')
            ->whereDate('room_reservations.created_at', date('Y-m-d'))
            ->where('room_reservation_students.account', $account)
            ->exists();
    }
}
