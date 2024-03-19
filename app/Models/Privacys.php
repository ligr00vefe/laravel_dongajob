<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Privacys extends Model
{
    use HasFactory;


    /**
     * @param $account : 학번
     * @return bool : 프라이버시 체크했는지 여부
     */
    public static function isPrivacy($account): bool
    {
        return DB::table('privacys')->where('account', $account)->exists();
    }


    /**
     * @param $account : 학번
     * @param $yn : 체크 여부 1: 확인,  2:취소
     * @return bool
     */
    public static function setPrivacy($account, $yn): bool
    {

        return DB::table('privacys')->insert(
            [
                'account' => $account,
                'yn' => $yn
            ]
        );


    }
}
