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

    public function allSubjectOfExam($exam)
    {
        $exam_id = $exam->id;

        return DB::table('exams')
            ->where('id', '=', $exam_id)
            ->join('exams_subjects',
                'exams.id', '=', 'exams_subjects.exam_id')
            ->join('subjects',
                'subjects.id', '=', 'exams_subjects.subject_id')
            ->select('subjects.*')
            ->get();
    }

    public function allYear()
    {
        return DB::table('exams')
            ->select('year')
            ->distinct()
            ->get();
    }
}
