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
            ->where([['year', '=', $year], ['semester', '=', $semester]])
            ->join('subject_classes',
                'exams.id', '=', 'subject_classes.exam_id')
            ->join('subjects',
                'subject_classes.subject_code', '=', 'subjects.subject_code')
            ->select('subjects.*')
            ->distinct()
            ->get();
    }

    public function getBySubjectCode($subjectCode)
    {
        return DB::table('subjects')
            ->where('subject_code', '=', $subjectCode)
            ->get()
            ->first();
    }
}
