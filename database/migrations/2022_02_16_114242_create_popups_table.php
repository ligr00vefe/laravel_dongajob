<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->nullable();
            $table->string('device', 50)->comment('접속기기')->nullable();
            $table->dateTime('start_time')->comment('시작시간')->nullable();
            $table->dateTime('end_time')->comment('종료시간')->nullable();
            $table->integer('disable_hours')->comment('보여지지 않는 시간 설정')->nullable();
            $table->integer('left')->nullable();
            $table->integer('top')->nullable();
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->string('subject')->comment('제목')->nullable();
            $table->longText("contents")->comment("내용")->nullable();
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
        Schema::dropIfExists('popups');
    }
}
