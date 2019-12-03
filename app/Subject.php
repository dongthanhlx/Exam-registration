<?php

namespace App;


class Subject extends BaseModel
{
    protected $table = 'subjects';

    protected $fillable = [
        'name', 'subject_code', 'number_of_credits', 'create_by'
    ];
/*
    public function getObjectCollection($subjects): Collection
    {
        $collection = new Collection();
        $subjectClassModel = new SubjectClass();

        foreach ($subjects as $subject)
        {
            $subjectCode = $subject->subject_code;
            $name        = $subject->name;
            $numCredits  = $subject->number_of_credits;
            $subjectClasses = $subjectClassModel->getAllSubjectClassBySubjectCode($subjectCode);
            $subjectClassCollection = $subjectClassModel->getObjectCollection($subjectClasses);

            $collection->add(new Subject($subjectCode, $name, $numCredits, $subjectClassCollection));
        }

        return $collection;
    }
*/

}
