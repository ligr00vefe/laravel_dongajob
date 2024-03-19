<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string('keyword')->comment('검색 키워드');
            $table->string("action")->comment("행위");
            $table->string("route")->comment("라우트명");
            $table->string("target")->comment("대상")->nullable();
            $table->string("comment")->comment("설명")->nullable();
            $table->string("path")->comment("주소")->nullable();
            $table->string("ip")->comment("아이피")->nullable();
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
        Schema::dropIfExists('logs');
    }
}
