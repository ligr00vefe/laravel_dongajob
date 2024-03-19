<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoardInterview extends Model
{
    use HasFactory;


    protected $fillable = [
        'enterprise',
        'category',
        'support_division',
        'support_job',
        'next_round',
        'next_round_schedule',
        'contents',
        'user_id',
        'status'
    ];

    public static function paging($request)
    {
        $search = $request->search ?? '';
        $term = $request->term ?? '';
        $user_id = $request->user_id ?? '';
        $column = $request->column ?? 'id';
        $orderBy = $request->orderBy ?? 'desc';
        $from = $request->input('from') ?? '2010-01-01';
        $to = $request->input('to') ?? '';

        return DB::table("board_interviews")
            ->select('board_interviews.id', 'board_interviews.created_at', 'board_interviews.enterprise', 'board_interviews.category', 'board_interviews.user_id', 'board_interviews.next_round', 'board_interviews.support_division', 'board_interviews.support_job', 'board_interviews.next_round_schedule', 'board_interviews.contents', 'board_interviews.status')
            ->leftJoin('students', 'board_interviews.user_id', '=', 'students.account')
            ->when($term, function ($query, $term) use ($search) {
                if ($search == 'name') {
                    return $query->where('students.name', 'like', '%' . $term . '%');
                }

                return $query->where('board_interviews.' . $search, 'like', '%' . $term . '%');
            })
            ->when($user_id, function ($query, $user_id) {
                return $query->where('board_interviews.user_id', $user_id);
            })
            ->when($column, function ($query, $column) use($orderBy) {
                return $query->orderBy($column, $orderBy);
            })
            ->when($to, function ($query, $to) use ($from) {
                return $query->whereDate('board_interviews.created_at', '>=', $from)->whereDate('board_interviews.created_at', '<=', $to);
            })
            ->paginate(10);
    }
}
