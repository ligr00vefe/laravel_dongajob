<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccessLog extends Model
{
    use HasFactory;

    public int $access_cnt = 5; // 제한 횟수


    /**
     * 몇번 제한 걸렸는지 체크
     * @param $account
     */
    public function getCount($account): int
    {
        return DB::table('access_logs')
            ->where('account', $account)->count();
    }

    /**
     * 입장 가능 체크 메서드
     * @param $account
     * @return bool true 시 입장 불가, false 가능
     */
    public function isAccessCheck($account): bool
    {
        $cnt = $this->getCount($account);
        return $cnt >= $this->access_cnt;
    }


    /**
     * 로그인 틀렸을시 횟수 증가
     * @param $account
     * @return int
     */
    public function countUp($account): int
    {
        $result = DB::table('access_logs')
            ->insert(['account' => $account]);


        return $this->getCount($account);
    }


    /**
     * 로그인시 기존에 틀렸던 횟수 초기화
     * @param $account
     * @return int
     */
    public function initialization($account): int
    {
        return DB::table('access_logs')
            ->where('account', $account)
            ->delete();
    }


    public function limitPermit($val, $id)
    {

        $account = User::find($id)->account;

        if ($val == 1) { // 허용

            return $this->initialization($account);

        } else {

            for ($i = 0; $i < 5; $i++) {
                DB::table('access_logs')->insert(
                    ['account' => $account]
                );
            }


            return true;
        }
    }

}
