<?php

namespace App;


use Illuminate\Support\Facades\DB;

class SubjectClass extends BaseModel
{
    protected $table = 'subject_classes';

    protected $fillable = [
        'subject_code', 'serial', 'teacher', 'maximum_number_of_student', 'create_by'
    ];

    public function getAllSubjectClassBySubjectCode($subjectCode)
    {
        return $this->getWithCondition(['subject_code', '=', $subjectCode]);
    }
/*
    public function getObjectCollection($subjects): Collection
    {
        $collection = new Collection();

        foreach ($subjects as $subject)
        {
            $serial = $subject->serial;
            $teacher = $subject->teacher;
            $maximum_number = $subject->maximum_number_of_student;

            $collection->add(new SubjectClass($serial, $teacher, $maximum_number));
        }

        return $collection;
    }
*/

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
}
