<?php

namespace App;


use Illuminate\Support\Facades\DB;

class Exam extends BaseModel
{
    protected $table = 'exams';

    protected $fillable = [
        'name', 'semester', 'year', 'create_by', 'active', 'start_registration', 'finish_registration'
    ];

    public function store($input)
    {
        $this::firstOrCreate([
            'name' => $input['name'],
            'semester' => $input['semester'],
            'year' => $input['year']
        ]);
    }

    public function allYear()
    {
        return DB::table('exams')
            ->select('year')
            ->distinct()
            ->get();
    }

    public function getByYearAndSemester($year, $semester)
    {
        return DB::table('exams')
            ->where([['year', '=', $year], ['semester', '=', $semester]])
            ->get()
            ->first();
    }

    public function getSemestersByYear($year)
    {
        return DB::table('exams')
            ->where('year', '=', $year)
            ->select('id', 'semester')
            ->get();
    }

    public function getAll()
    {
        return DB::table('exams')
            ->select(DB::raw("CONCAT(exams.name, ' ', exams.semester, ' năm học ', exams.year) as name"),
                'status',
                'start_registration',
                'finish_registration',
                'id')
            ->get();
    }

    public function updateStatus($id, $input)
    {
        $status = $input['status'];

        if ($status == 'START') {
            DB::table('exams')
                ->update([
                    'status' => 'START'
                ]);

            DB::table('exams')
                ->where('id', '=', $id)
                ->update([
                    'start_registration' => $input['start'],
                    'finish_registration' => $input['finish'],
                    'status' => 'STOP'
                ]);
        } else {
            DB::table('exams')
                ->where('id', '=', $id)
                ->update([
                    'status' => 'START'
                ]);
        }
    }

    public function getNewestExam()
    {
        $schedulingID = DB::table('exams_subjects_rooms_student_details')->latest()->get()->first()->exams_subjects_rooms_id;

        return DB::table('exams_subjects_rooms')
            ->where('exams_subjects_rooms.id', '=', $schedulingID)
            ->join('exams',
                'exams_subjects_rooms.exam_id',
                '=',
                'exams.id')
            ->select(DB::raw("CONCAT(exams.name, ' ', exams.semester, ' năm học ', exams.year) as name"))
            ->get()
            ->first();
    }

    public function getExamActive()
    {
        return DB::table('exams')
            ->where('status', '=', 'STOP')
            ->get()
            ->first();
    }
}
