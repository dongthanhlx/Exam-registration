<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->time('start_time');
            $table->time('finish_time');
            $table->integer('exam_id');
            $table->string('subject_code');
            $table->string('create_by')->nullable()->default(1);
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
        Schema::dropIfExists('exam_shifts');
    }
}
