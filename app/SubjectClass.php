<?php

namespace App;


class SubjectClass extends BaseModel
{
    protected $table = 'subject_classes';

    protected $fillable = [
        'serial', 'subject_code', 'teacher', 'maximum_number_of_student', 'create_by'
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

}
