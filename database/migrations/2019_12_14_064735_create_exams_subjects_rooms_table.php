<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsSubjectsRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_subjects_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_id');
            $table->integer('subject_id');
            $table->string('date');
            $table->integer('exam_shift');
            $table->integer('duration');
            $table->json('room_id');
            $table->integer('create_by')->nullable()->default(1);
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
        Schema::dropIfExists('exams_subjects_rooms');
    }
}
