<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditAttrbutesExamsSubjectsRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams_subjects_rooms', function (Blueprint $table) {
            $table->dropColumn('exams_subject_id');
            $table->integer('exam_id');
            $table->integer('subject_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams_subjects_rooms', function (Blueprint $table) {
            //
        });
    }
}
