<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\String_;

class Scheduling extends BaseModel
{
    protected $table = 'exams_subjects_rooms';
    protected $casts = [
        'options' => 'array',
    ];

    protected $fillable = [
        'exam_id', 'subject_id', 'date', 'exam_shift', 'duration', 'room_id', 'create_by'
    ];

    public function getAllRoomIDByDateAndExamShift($date, $examShift)
    {
        $allRoom = collect();

        $results = DB::table('exams_subjects_rooms')
            ->where([['date', '=', $date], ['exam_shift', '=', $examShift]])
            ->select('room_id')
            ->get();

        if ($results == null) return null;

        foreach ($results as $result)
        {
            $roomIDs = unserialize($result->room_id);

            if (is_string($roomIDs)) {
                $allRoom = $allRoom->merge((integer) $roomIDs);
            }

            else
            {
                foreach ($roomIDs as $roomID)
                {
                    $allRoom = $allRoom->merge((integer) $roomID);
                }
            }
        }

        return $allRoom;
    }

    public function getAllRemainingRoomInfoInDateAndExamShift($date, $examShift)
    {
        $roomModel = new Room();
        $result = collect();

        $allRoomID = $roomModel->getAllRoomID();
        $allRoomIDInExamShift = $this->getAllRoomIDByDateAndExamShift($date, $examShift);

        foreach ($allRoomID as $roomID)
        {
            $check = false;

            foreach ($allRoomIDInExamShift as $item)
            {
                if ($item == $roomID) {
                    $check = true;
                    break;
                }
            }

            if (!$check) {
                $result->push($roomModel->getByID($roomID));
            }
        }

        return $result;
    }

    public function test()
    {
        $result = collect();
        $roomModel = new Room();
        $allRoomID = $roomModel->getAllRoomID();
        $tmp = $this->getAllRoomIDByDateAndExamShift('2019-12-19', 1);

        foreach ($allRoomID as $roomID)
        {
            if (!in_array($roomID, (array) $tmp))
            {
                $result->push($roomID);
            }
        }

        return $result;
    }

    public function store($input)
    {
        $year = $input['year'];
        $semester = $input['semester'];
        $subject_id = $input['subject'];
        $duration = $input['duration'];
        $date = $input['date'];
        $examShift = $input['examShift'];
        $room = $input['room'];

        $examModel = new Exam();
        $exam_id = $examModel->getByYearAndSemester($year, $semester)->id;
        $room_id_array = serialize($room);

        DB::table('exams_subjects_rooms')
            ->insert([
                'exam_id' => $exam_id,
                'subject_id' => $subject_id,
                'duration' => $duration,
                'date' => $date,
                'exam_shift' => $examShift,
                'room_id' => $room_id_array
            ]);
    }
}
