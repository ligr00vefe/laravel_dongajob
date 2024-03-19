<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardReviewBeforesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_review_befores', function (Blueprint $table) {
            $table->id();
            $table->string("subject")->comment("제목");
            $table->longText("contents")->comment("내용");
            $table->string("account")->comment("학번 or 관리자 ID");
            $table->smallInteger("user_type")->comment("1:학생 2: 관리자");
            $table->integer("hit")->comment("조회수")->default(0)->nullable();
            $table->integer("attachment1")->comment("첨부파일1")->nullable();
            $table->integer("attachment2")->comment("첨부파일2")->nullable();
            $table->integer("attachment3")->comment("첨부파일3")->nullable();
            $table->integer("attachment4")->comment("첨부파일4")->nullable();
            $table->integer("attachment5")->comment("첨부파일5")->nullable();
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
        Schema::dropIfExists('board_review_befores');
    }
}
