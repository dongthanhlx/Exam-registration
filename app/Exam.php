<?php

namespace App;


use Illuminate\Support\Facades\DB;

class Exam extends BaseModel
{
    protected $table = 'exams';

    protected $fillable = [
        'name', 'semester', 'year', 'create_by'
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
}
