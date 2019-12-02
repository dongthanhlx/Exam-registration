<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentDetailsExamShifts extends Model
{
    protected $table = 'student_details_exam_shifts';

    protected $fillable = [
        'student_code', 'exam_shift_id'
    ];

    public function studentsOfExamShift($examShift)
    {
        $examShiftID = $examShift->id;
        return DB::table('student_details_exam_shifts')
            ->where('exam_shift_id', '=', $examShiftID)
            ->join('student_details',
                'student_details_exam_shifts.student_code',
                '=',
                'student_details.student_code')
            ->select('student_details.*')
            ->get();
    }

}
