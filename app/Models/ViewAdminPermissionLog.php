<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViewAdminPermissionLog extends Model
{
    use HasFactory;

    protected $table = "admin_permission_logs";

    public static function paging($request)
    {

        $keyword = $request->input("keyword");
        $category = $request->input('category');


        if ($category == '' || $category == 'all') {

             return DB::table("logs")
                ->orderByDesc("id")
                ->paginate(10);

        } else if ($category == 'connect') {

            return DB::table("logs")
                ->orderByDesc("id")
                ->where('action', '!=', '관리자생성')
                ->where('action', '!=', '관리자삭제')
                ->where('action', '!=', '엑셀내역다운로드')
                ->paginate(10);

        } else if ($category == 'change') {

            return DB::table("logs")
                ->where('action',  '관리자생성')
                ->orWhere('action',  '관리자삭제')
                ->orderByDesc("id")
                ->paginate(10);
        } else if ($category == 'excel') {

            return DB::table("logs")
                ->where('action',  '엑셀내역다운로드')
                ->orderByDesc("id")
                ->paginate(10);
        }


    }
}
