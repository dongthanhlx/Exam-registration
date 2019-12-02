<?php

namespace App;

use Illuminate\Support\Facades\DB;

class StudentDetailSubjectClass extends BaseModel
{
    protected $table = 'student_details_subject_classes';

    protected $fillable = [
        'student_code', 'subject_code', 'serial', 'contest_conditions', 'comments'
    ];

    public function studentOfSubject($subject)
    {
        $subjectCode = $subject->subject_code;
        return DB::table('subjects')
                ->where('subjects.subject_code', '=', $subjectCode)
                ->join('student_details_subject_classes', 'subjects.subject_code', '=', 'student_details_subject_classes.subject_code')
                ->join('student_details', 'student_details_subject_classes.student_code', '=', 'student_details.student_code')
                ->select('student_details.*')
                ->get();
    }

    public function studentsWithContestConditions($contestConditions)
    {
        return DB::table('student_details_subject_classes')
                ->join('student_details', 'student_details_subject_classes.student_code', '=', 'student_details.student_code')
                ->where('contest_conditions', '=', $contestConditions)
                ->select('student_details.*')
                ->get();
    }

    public function studentsNotEligibleContestConditionsOfSubjectClass($subjectClass)
    {
        $subjectClassID = $subjectClass->id;
        return DB::table('student_details_subject_classes')
                ->where('subject_class_id', '=', $subjectClassID)
                ->where('contest_conditions', '=', 'not eligible')
                ->join('student_details', 'student_details_subject_classes.student_code', 'student_details.student_code')
                ->select('student_details.*')
                ->get();
    }

    public function studentsNotEligibleContestConditionsOfSubject($subject)
    {
        $subjectCode = $subject->codde;
        return DB::table('subjects')
                ->where('subject_code', '=', $subjectCode)
                ->join('student_details_subject_classes',
                    'subjects.student_code',
                    '=',
                    'student_details_subject_classes.student_code')
                ->where('contest_conditions', '=', 'not eligible')
                ->join('student_details', 'student_details_subject_classes.student_code', '=', 'student_details.student_code')
                ->select('student_details.*')
                ->get();
    }

    public function checkContestConditionsOfStudent($student, $subject)
    {
        $studentCode = $student->student_code;
        $subjectCode = $subject->subject_code;
        return DB::table('student_details_subject_classes')
            ->where([['student_code', '=', $studentCode],
                    ['subject_code', '=', $subjectCode],
                    ['contest_conditions', '=', 'eligible']])
            ->get();
    }
}
