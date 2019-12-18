<?php

namespace App;

use Illuminate\Support\Facades\DB;

class StudentDetailSubjectClass extends BaseModel
{
    protected $table = 'student_details_subject_classes';

    protected $fillable = [
        'student_code', 'subject_code', 'serial', 'contest_conditions', 'comments'
    ];

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
        $subjectCode = $subject->code;
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

    public function getInfoStudentOfSubjectClass($id)
    {
        return DB::table('student_details_subject_classes')
            ->where('student_details_subject_classes.id', '=', $id)
            ->join('student_details',
                'student_details_subject_classes.student_code', '=','student_details.student_code')
            ->join('users',
                'student_details.user_id', '=', 'users.id')
            ->join('subject_classes',
                'student_details_subject_classes.subject_class_id', '=', 'subject_classes.id')
            ->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
                'student_details.student_code',
                'student_details_subject_classes.contest_conditions', 'student_details_subject_classes.comments', 'student_details_subject_classes.id',
                DB::raw("CONCAT(subject_classes.subject_code, ' ', subject_classes.serial) AS subject_class"))
            ->get()
            ->first();
    }

    public function updateByID($id, $input)
    {
        return DB::table('student_details_subject_classes')
            ->where('id', '=', $id)
            ->update([
                'contest_conditions' => $input['contest_conditions'],
                'comments' => $input['comments']
            ]);
    }

    public function deleteByID($id)
    {
        return DB::table('student_details_subject_classes')
            ->delete($id);
    }
}
