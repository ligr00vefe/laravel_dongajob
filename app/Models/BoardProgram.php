<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoardProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'status_auto',
        'status',
        'open',
        'teacher_name',
        'start_reception_date',
        'start_reception_time',
        'end_reception_date',
        'end_reception_time',
        'start_course_date',
        'start_course_time',
        'end_course_date',
        'end_course_time',
        'location',
        'number_students',
        'number_waiting',
        'education_target',
        'student_grade',
        'text_book',
        'tuition_fees',
        'contents',
        'deadline_date',
        'deadline_time',
        'bank_name',
        'account_holder',
        'account_number'
    ];


    public static function paging($request)
    {

        $search = $request->search ?? '';
        $term = $request->term ?? '';
        $cnt = $request->view_count ?? 10;
        $open = $request->open ?? '';
        $column = $request->column ?? 'id';
        $orderBy = $request->orderBy ?? 'desc';
        $from = $request->input('from') ?? '2010-01-01';
        $to = $request->input('to') ?? '';

        return DB::table("board_programs")
            ->when($search, function ($query, $search) use ($term) {
                return $query->where($search, "LIKE", "%{$term}%");
            })
            ->when($open, function ($query, $open) {
                return $query->where('open', $open);
            })
            ->when($column, function ($query, $column) use ($orderBy) {
                return $query->orderBy($column, $orderBy);
            })
            ->when($to, function ($query, $to) use ($from) {
                return $query->whereDate('end_reception_date', '>=', $from)->whereDate('end_reception_date', '<=', $to);
            })
            ->paginate($cnt);
    }


    //--- 수강인원,대기인원(status) 에따라 예약인원수 가져오기
    public static function get_reservation_count($program_id, $status)
    {
        $status_column = self::get_status_column_name($status);

        //--- 프로그램 정원 가져오기
        $program_status_count = DB::table("board_programs")
            ->select($status_column)
            ->where("id", $program_id)
            ->first();

        return $program_status_count->$status_column;

    }

    public static function get_status_column_name($status)
    {
        if ($status == 1) {
            return 'number_students';
        } else if ($status == 2) {
            return 'number_waiting';
        }
    }


    public static function student($account, $program_id = null)
    {
        return DB::table("board_programs")
            ->leftJoin('program_reservations', 'board_programs.id', '=', 'program_reservations.program_id')
            ->where("program_reservations.account", $account)
            ->when($program_id, function ($query, $program_id) {
                return $query->where('program_reservations.program_id', $program_id);
            })->paginate(10);

    }
}
