<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommend_reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recommend_id')->comment('recommend id');
            $table->string("account")->comment('학번');
            $table->string('question1')->nullable();
            $table->string('question2')->nullable();
            $table->string('question3')->nullable();
            $table->string('question4')->nullable();
            $table->string('question5')->nullable();
            $table->string('attachment1')->nullable();
            $table->string('attachment2')->nullable();
            $table->string('attachment3')->nullable();
            $table->string('proof_photo')->comment('증명사진')->nullable();
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
        Schema::dropIfExists('recommend_reservations');
    }
}
