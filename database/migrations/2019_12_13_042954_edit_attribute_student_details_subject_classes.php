<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditAttributeStudentDetailsSubjectClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_details_subject_classes', function (Blueprint $table) {
            $table->dropColumn('subject_code');
            $table->dropColumn('serial');
            $table->integer('subject_class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_details_subject_classes', function (Blueprint $table) {
            //
        });
    }
}
