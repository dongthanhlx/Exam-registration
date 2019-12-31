<?php

namespace App;


use Illuminate\Support\Facades\DB;

class SubjectClass extends BaseModel
{
    protected $table = 'subject_classes';

    protected $fillable = [
        'subject_code', 'serial', 'teacher', 'maximum_number_of_student', 'exam_id', 'create_by'
    ];

    public function getAllSubjectClassBySubjectCode($subjectCode)
    {
        return $this->getWithCondition(['subject_code', '=', $subjectCode]);
    }

    public function getSubjectClassBySubjectCodeAndSerial($subjectCode, $serial)
    {
        return $this->getWithConditions([['subject_code', '=', $subjectCode],['serial', '=', $serial]])->first();
    }

    public function updateById($input, $id)
    {
        $result = DB::table('subject_classes')
            ->where('id', '=', $id)
            ->update([
                'serial' => $input['serial'],
                'subject_code' => $input['subject_code'],
                'teacher' => $input['teacher'],
                'maximum_number_of_student' => $input['maximum_number_of_student']
            ]);

        return $result;
    }

    public function deleteById($id)
    {
        $result = DB::table('subject_classes')
            ->delete($id);

        return $result;
    }

    public function getByYearAndSemester($year, $semester)
    {
        return DB::table('exams')
            ->where([['year', '=', $year], ['semester', '=', $semester]])
            ->join('subject_classes',
                'exams.id', '=', 'subject_classes.exam_id')
            ->join('subjects',
                'subject_classes.subject_code', '=', 'subjects.subject_code')
            ->select(
                'subject_classes.*',
                'subjects.name',
                'subjects.subject_code'
            )
            ->get();
    }
}
