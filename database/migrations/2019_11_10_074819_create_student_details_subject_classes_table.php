<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsSubjectClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details_subject_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_code');
            $table->string('subject_code');
            $table->integer('serial');
            $table->string('contest_conditions')->nullable()->default('eligible');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('student_details_subject_classes');
    }
}
