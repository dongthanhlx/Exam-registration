<?php

namespace App;

use Illuminate\Support\Collection;

class Subject extends BaseModel
{
    protected $table = 'subjects';

    protected $fillable = [
        'subject_code', 'name', 'number_of_credits', 'create_by'
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

    public function getSubjectBySubjectCode($subjectCode)
    {
        return $this->getWithCondition(['subject_code', '=', $subjectCode])->first();
    }
/*
    public function insert($input)
    {
        $this::firstOrCreate(
            [
                'subject_code' => $input->subject_code
            ],
            [
                'name' => $input->name,
                'number_of_credits' => $input->number_of_credits,
            ]
        );
    }*/

}
