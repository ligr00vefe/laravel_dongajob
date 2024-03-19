<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete()->comment("유저 id");
            $table->string("category")->comment("1 : 첨부파일, 2:에디터 이미지");
            $table->string("from", 50)->comment("어느 곳에서 업로드했는지");
            $table->bigInteger("target_id")->comment("업로드 id (에디터 업로드일땐 없음)")->nullable();
            $table->string("original_name")->comment("파일 원본 이름");
            $table->string("path")->comment("파일경로 + 변경된파일이름");
            $table->string("comment")->nullable()->comment("설명");
            $table->softDeletes();
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
        Schema::dropIfExists('attachments');
    }
}
