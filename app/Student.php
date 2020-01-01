<?php

namespace App;



use Illuminate\Support\Facades\DB;

class Student extends BaseModel
{
    protected $table    = 'student_details';

    protected $fillable = [
        'student_code', 'birthday', 'class', 'gender', 'user_id', 'create_by'
    ];

    public function getStudentByStudentCode($studentCode)
    {
        return $this->getWithCondition(['student_code', '=', $studentCode])->first();
    }

    public function accountOfStudent($student)
    {
        $user_id = $student->user_id;
        return (new User())->getWhere(['user_id', '=', $user_id]);
    }

    public function studentInfoOfStudentCode($studentCode)
    {
        return $this->getWithCondition(['student_code', '=', $studentCode]);
    }

    public function getAllInfo()
    {
        return DB::table('users')
            ->join('student_details', 'users.id', '=', 'student_details.user_id')
            ->where('student_details.deleted', '=', false)
            ->select('student_details.id', 'first_name', 'last_name', 'birthday', 'gender', 'student_code', 'class')
            ->get();
    }

    public function getInfoStudentByID($id)
    {
        return DB::table('student_details')
            ->where('student_details.id', '=', $id)
            ->join('users', 'student_details.user_id', '=', 'users.id')
            ->select('student_details.id', 'first_name', 'last_name', 'birthday', 'gender', 'student_code', 'class')
            ->get()
            ->first();
    }

    public function deleteById($id)
    {
        return DB::table('student_details')
            ->where('id', '=', $id)
            ->update([
                'deleted' => true
            ]);
    }

    public function updateById($input, $id)
    {
        $result = DB::table('student_details')
            ->where('id', '=', $id)
            ->update([
                'student_code' => $input['student_code'],
                'birthday' => $input['birthday'],
                'class' => $input['class'],
                'gender' => $input['gender'],
            ]);

        return $result;
    }

    public function getBySubjectClass($subjectCode, $serial)
    {
        return DB::table('subject_classes')
            ->where([['student_code', '=', $subjectCode], ['serial', '=', $serial]])
            ->join('student_details_subject_classes',
                'subject_classes.id', '=', 'student_details_subject_classes.subject_class_id')
            ->join('student_details',
                'student_details.student_code', '=', 'student_details_subject_classes.student_code')
            ->select('student_details.*')
            ->get();
    }

    public function getBySubjectCodeAndExamID($subjectCode, $exam_id)
    {
        return DB::table('subject_classes')
            ->where([['subject_code', '=', $subjectCode], ['exam_id', '=', $exam_id]])
            ->join('student_details_subject_classes',
                'subject_classes.id', '=', 'student_details_subject_classes.subject_class_id')
            ->join('student_details',
                'student_details_subject_classes.student_code', '=', 'student_details.student_code')
            ->join('users',
                'student_details.user_id', '=', 'users.id')
            ->select(
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
                'student_details.student_code', 'student_details.birthday', 'student_details.class',
                'subject_classes.subject_code', 'subject_classes.serial',
                'student_details_subject_classes.id', 'student_details_subject_classes.contest_conditions', 'student_details_subject_classes.comments'
            )
            ->get();
    }

    public function getByExam($year, $semester)
    {
        return DB::table('exams')
            ->where([['year', '=', $year], ['semester', '=', $semester]])
            ->join('subject_classes',
                'exams.id', '=', 'subject_classes.exam_id')
            ->join('student_details_subject_classes',
                'subject_classes.id', '=', 'student_details_subject_classes.subject_class_id')
            ->join('student_details',
                'student_details_subject_classes.student_code', '=', 'student_details.student_code')
            ->join('users',
                'student_details.user_id', '=', 'users.id')
            ->select('subject_classes.subject_code',
                'subject_classes.serial',
                'student_details.*',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"))
            ->get();
    }

    public function getAllStudentByExamRegistrationID($schedulingID, $roomID)
    {
        return DB::table('exams_subjects_rooms_student_details')
            ->where([
                [
                    'exams_subjects_rooms_student_details.exams_subjects_rooms_id',
                    '=',
                    $schedulingID
                ],
                [
                    'exams_subjects_rooms_student_details.room_id',
                    '=',
                    $roomID
                ]
            ])
            ->join('users',
                'exams_subjects_rooms_student_details.student_id',
                '=',
                'users.id')
            ->join('student_details',
                'users.id',
                '=',
                'student_details.user_id')
            ->select(
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
                'student_details.student_code'
            )
            ->get();
    }
}

