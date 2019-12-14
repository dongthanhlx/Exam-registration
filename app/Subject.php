<?php

namespace App;


use App\Imports\SubjectListImport;
use Illuminate\Support\Facades\DB;

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

    public function updateById($input, $id)
    {
        $result = DB::table('subjects')
            ->where('id', '=', $id)
            ->update([
                'name' => $input['name'],
                'subject_code' => $input['subject_code'],
                'number_of_credits' => $input['number_of_credits'],
            ]);

        return $result;
    }

    public function deleteById($id)
    {
        $result = DB::table('subjects')
            ->delete($id);

        return $result;
    }

    public function getByYearAndSemester($year, $semester)
    {
        return DB::table('exams')
            ->where(['year', '=', $year], ['semester', '=', $semester])
            ->join('exams_subjects',
                'exams.id', '=', 'exams_subjects.exam_id')
            ->join('subjects',
                'exams_subjects.subject_id', '=', 'subjects.id')
            ->get();
    }
}
