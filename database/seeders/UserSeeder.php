<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        // 임시 관리자 계정 생성
        User::create([
            'name' => '최고관리자',
            'account' => 'supervisor',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'level' => 2,
            'menu' => '',
            'ip' => '',
            'remember_token' => Str::random(32),
        ]);

        // 바램용 관리자 계정 생성
        User::create([
            'name' => '최고관리자',
            'account' => 'baraem',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'level' => 2,
            'menu' => '',
            'ip' => '',
            'remember_token' => Str::random(32),
        ]);
    }
}
