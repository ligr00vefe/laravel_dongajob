<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPermissionLog extends Model
{
    use HasFactory;
    protected $table = "admin_permission_logs";

    public static function paging($request) {

        $keyword = $request->input("keyword");

//        return DB::table("admin_permission_logs")
//            ->when($keyword, function ($query, $keyword) {
//                return $query->where("");
//            });
    }

    public static function record($data)
    {
        return DB::table("admin_permission_logs")
            ->insert([
                "user_id" => $data['user_id'],
                "action" => $data['action'],
                "target" => $data['target'],
                "comment" => $data['comment'],
                "path" => $data['path'],
                "ip" => $data['ip']
            ]);
    }
}
