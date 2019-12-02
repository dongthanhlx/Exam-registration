<?php

namespace App;


use Illuminate\Support\Facades\DB;

class StudentDetailsExamShiftsRooms extends BaseModel
{
    protected $table = 'student_details_exam_shifts_rooms';

    protected $fillable = [
        'student_code', 'exam_shift_id', 'room_id'
    ];


    public function studentsOfExamShiftIDAndRoomID($examShiftsID, $roomID)
    {
        return DB::table('student_details_exam_shifts_rooms')
                ->where('exam_shift_id', '=', $examShiftsID)
                ->where('room_id', '=', $roomID)
                ->join('student_details',
                    'student_details_exam_shifts_rooms.student_code',
                    '=',
                    'student_details.student_code')
                ->get();
    }
}
