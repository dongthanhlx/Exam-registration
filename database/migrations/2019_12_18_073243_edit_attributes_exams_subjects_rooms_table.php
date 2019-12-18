<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditAttributesExamsSubjectsRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams_subjects_rooms', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('finish_time');
            $table->integer('exam_shift');
            $table->integer('duration');
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
