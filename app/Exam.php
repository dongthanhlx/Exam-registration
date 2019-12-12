<?php

namespace App;


use Illuminate\Support\Facades\DB;

class Exam extends BaseModel
{
    protected $table = 'exams';

    protected $fillable = [
        'name', 'semester', 'year', 'create_by'
    ];
    /*
        public function getObjectCollection($exams): Collection
        {
            $collection     = new Collection();
            $examShiftModel = new ExamShift();

            foreach ($exams as $exam)
            {
                $examID     = $exam->id;
                $name       = $exam->name;
                $semester   = $exam->semester;
                $year       = $exam->year;

                $examShifts          = $examShiftModel->getAllExamShiftByExamID($examID);
                $examShiftCollection = $examShiftModel->getObjectCollection($examShifts);

                $collection->add(new Exams($name, $semester, $year, $examShiftCollection));
            }

            return $collection;
        }
    */


    public function store($input)
    {
        try {
            $this->saveOrFail([
                'name' => $input['name'],
                'semester' => $input['semester'],
                'year' => $input['year']
            ]);
        } catch (\Throwable $e) {
            return back()->withErrors('Exam exists')->withInput();
        }
    }

    public function getBySemesterAndYear($semester, $year)
    {
        return DB::table('exams')
                ->where(['semester', '=', $semester], ['year', '=', $year])
                ->get()
                ->first();
    }
}
