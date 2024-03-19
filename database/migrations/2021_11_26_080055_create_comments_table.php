<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string("board_title")->comment("게시판 명");
            $table->bigInteger("board_id")->comment("게시판 id값");
            $table->tinyInteger("writer_type")->comment("작성자 타입 1: 학생 2: 관리자");
            $table->string("account")->comment("학번");
            $table->longText("comment")->comment("댓글내용");
            $table->integer("class")->comment("계층")->default(0);
            $table->integer("order")->comment("댓글 대댓글 순서")->default(0);
            $table->integer("group_num")->comment("댓글 그룹")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
