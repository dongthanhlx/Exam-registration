<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsSubjectsRoomsStudentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_subjects_rooms_student_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exams_subjects_rooms_id');
            $table->string('subject_code');
            $table->integer('student_id');
            $table->integer('room_id');
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
        Schema::dropIfExists('exams_subjects_rooms_student_details');
    }
}
