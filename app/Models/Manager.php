<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'account',
        'name',
        'password',
        'menu'
    ];


    public static function paging($request = null)
    {
        $search = $request->search ?? '';
        $term = $request->term ?? '';

        //--- 검색 대상이 menu일경우 db에 1,2,3,4, 이렇게 저장되어 있기때문에 이 포맷에 맞게끔 처리
        if ($search == 'menu') {
            $str = $term;
            $term = [];
            foreach (get_admin_menu_list() as $key => $value) {
                if (strpos($value, $str) !== false) {
                    $term[] = $key;
                }
            }
            $term = implode(',', $term);
        }

        return DB::table("managers")
            ->when($search, function ($query, $search) use ($term) {
                return $query->where($search, "LIKE", "%{$term}%");
            })
            ->orderByDesc("id")
            ->paginate(10);
    }

    public static function getExists($account)
    {
        return DB::table("managers")
            ->where("account", "=", $account)->exists();
    }
}
