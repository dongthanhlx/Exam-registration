<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Scheduling extends BaseModel
{
    public function getAllRoomInDateAndExamShift($date, $examShift)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $dateString = $date->toDateString();

        return DB::table('exams_subjects_rooms')
            ->where([['date', '=', $dateString], ['exam_shift', '=', $examShift]])
            ->join('rooms',
                'exams_subjects_rooms.room_id', '=', 'rooms.id')
            ->select(DB::raw("CONCAT(rooms.name, ' ', rooms.location) AS room"))
            ->get();
    }

    public function getAllRemainingInfoInDate($date)
    {
        $allRoom = (new Room())->allRoomName();
        $result = [];
        for ($examShift = 1; $examShift<5; $examShift++)
        {
            $allRoomInExamShift = $this->getAllRoomInDateAndExamShift($date, $examShift);
            $remain = Arr::except($allRoom, $allRoomInExamShift);
            $result = Arr::collapse([$result,$remain]);
        }
        return $result;
    }
}
