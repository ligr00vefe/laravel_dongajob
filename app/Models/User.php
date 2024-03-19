<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account',
        'name',
        'password',
        'menu',
        'ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function paging($request = null)
    {

        $search = $request->search ?? '';
        $term = $request->term ?? '';
        $level = $request->level ?? '';

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

        return DB::table("users")
            ->when($search, function ($query, $search) use ($term) {
                return $query->where($search, "LIKE", "%{$term}%");
            })
            ->when($level, function ($query, $level) {
                return $query->where('level', $level);
            })
            ->orderByDesc("id")
            ->paginate(10);
    }

    public static function getExists($account)
    {
        return DB::table("users")
            ->where("account", "=", $account)->exists();
    }

    public static function getUser($account, $student_name = null)
    {

        return DB::table("users")
            ->where("account", $account)
            ->when($student_name, function ($query, $name) {
                return $query->where('name', $name);
            })->first();
    }
}
