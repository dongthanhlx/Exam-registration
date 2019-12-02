<?php

namespace App;

use Illuminate\Support\Facades\DB;


class RoomsExamShifts extends BaseModel
{
    protected $table = 'rooms_exam_shifts';

    protected $fillable = [
        'exam_shift_id', 'room_id', 'create_by'
    ];

    public function roomsOfExamShift($examShift)
    {
        $examShiftID = $examShift->id;
        return DB::table('rooms_exam_shifts')
            ->join('rooms', function ($join) use ($examShiftID) {
                $join->on('rooms_exam_shifts.room_id', '=', 'rooms.id')
                    ->where('rooms_exam_shifts.exam_shift_id', '=', $examShiftID);
            })
            ->get();
    }
}
