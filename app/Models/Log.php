<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    use HasFactory;

    protected $table = "logs";

    public static function record($data)
    {

        return DB::table("logs")
            ->insertGetId([
                "user_id" => $data['user_id'],
                "action" => $data['action'] ?? "",
                "route" => $data['route'] ?? "",
                "target" => $data['target'] ?? "",
                "comment" => $data['comment'] ?? "",
                "path" => $data['path'] ?? "",
                "ip" => $data['ip'] ?? "",
                "keyword" => $data['keyword'] ?? "",
            ]);

    }


    public static function paging($request)
    {
        $keyword = $request->input("keyword");
        $category = $request->input('category');
        $from = $request->input('from') ?? '2021-01-01';
        $to = $request->input('to') ?? '';


        if ($category == '' || $category == 'all') {
            return DB::table("logs")
                ->orderByDesc("id")
                ->when($to, function ($query, $to) use ($from) {
                    return $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
                })
                ->paginate(15);
        }

        if ($category == 'connect') {

            return DB::table("logs")
                ->orderByDesc("id")
                ->where('action', '!=', '관리자생성')
                ->where('action', '!=', '관리자삭제')
                ->where('action', '!=', '관리자수정')
                ->where('action', '!=', '엑셀내역다운로드')
                ->when($to, function ($query, $to) use ($from) {
                    return $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
                })
                ->paginate(15);

        }

        if ($category == 'change') {



            return DB::table("logs")
                ->orWhere('action', '관리자생성')
                ->orWhere('action', '관리자삭제')
                ->orWhere('action', '관리자수정')
                ->when($to, function ($query, $to) use ($from) {
                    return $query->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                })
                ->orderByDesc("id")
                ->paginate(15);

        }

        if ($category == 'excel') {

            return DB::table("logs")
                ->where('action', '엑셀내역다운로드')
                ->when($to, function ($query, $to) use ($from) {
                    return $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
                })
                ->orderByDesc("id")
                ->paginate(15);
        }
    }
}
