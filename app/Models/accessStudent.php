<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class accessStudent extends Model
{
    use HasFactory;


    /**
     * 토큰저장
     * @param $account
     * @param $token
     * @return bool
     */
    public static function setToken($account, $token): bool
    {
        $date = date('Y-m-d H:i:s');
        return DB::table('access_students')
            ->insert([
                "account" => $account,
                "remember_token" => $token,
                "ip" => $_SERVER['REMOTE_ADDR'],
                "created_at" => $date,
                "updated_at" => $date
            ]);
    }

    /**
     * 토큰있는지 체크
     * @param $account
     */
    public static function isToken($account): bool
    {
        return DB::table('access_students')->where('account', $account)->exists();
    }

    /**
     * 토큰 업데이트
     * @param $account
     * @param string $token
     */
    public static function updateToken($account, string $token): int
    {
        return DB::table('access_students')
            ->where('account', $account)
            ->update(['remember_token' => $token, 'ip' => $_SERVER['REMOTE_ADDR'], 'updated_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * 토큰가져오기
     * @param $account
     * @return false|\Illuminate\Support\Collection
     */
    public static function getToken($account)
    {
        return DB::table('access_students')->where('account', $account)->first();
    }

}
