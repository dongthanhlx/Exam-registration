<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsExamShiftsRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details_exam_shifts_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_code');
            $table->integer('exam_shift_id');
            $table->integer('room_id');
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
        Schema::dropIfExists('student_details_exam_shifts_rooms');
    }
}
