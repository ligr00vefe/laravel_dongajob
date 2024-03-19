<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('account')->unique();
            $table->string('password');
            $table->string('menu')->nullable()->comment("메뉴 아이디값 ,(콤마)로 구분");
            $table->tinyInteger('level')->comment('1 : 일반 2 : 최고관리자 0 : 삭제회원')->default(1);
            $table->string('ip')->comment('접속 아이피');
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
