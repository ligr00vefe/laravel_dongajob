<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProgramReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'account',
        'user_id',
        'status'
    ];

    public static function paging($program_id, $status = null)
    {

        return DB::table("program_reservations")
            ->when($program_id, function ($query, $program_id) {
                return $query->where('program_id', $program_id);
            }) ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })->orderByDesc("created_at")
            ->paginate(10);
    }

    public static function getData($program_id, $status = null)
    {

        return DB::table("program_reservations")
            ->when($program_id, function ($query, $program_id) {
                return $query->where('program_id', $program_id);
            }) ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })->orderByDesc("created_at")
            ->paginate(100000);
    }

    /**
     * 프로그램 이미 예약했는지 체크
     */
    public static function is_reservation_already($program_id, $account): bool
    {
        return DB::table("program_reservations")
            ->where("account", $account)
            ->where(program_id, $program_id)
            ->exists();
    }


    //--- 예약이 꽉찼는지 체크 (true 꽉참, false 가능)
    public static function is_reservation_full($program_id, $status): bool
    {
        // 예약하려는 프로그램 예약 limit 갯수 가져오기
        $max_count = BoardProgram::get_reservation_count($program_id, $status);

        // 현재 예약자 갯수 가져오기
        $current_count = DB::table("program_reservations")
            ->where("program_id", $program_id)
            ->where("status", $status)
            ->count();


        return (int)$current_count >= $max_count;

    }

    //--- 유저가 해당 프로그램 예약했는지 체크 (예약한 숫자를 return)h
    public static function is_reservation_user($program_id, $account): int
    {
        $current_count = DB::table("program_reservations")
            ->where("program_id", $program_id)
            ->where("account", $account)
            ->count();

        return $current_count;
    }

    //--- 프로그램 예약 가능한지 체크
    public static function is_reservation_possible($program_id, $account, $status): bool
    {
        if (!self::is_reservation_user($program_id, $account)) {
            return !self::is_reservation_full($program_id, $status);
        }

        return false;
    }
}
