<?php

namespace App;


use Illuminate\Support\Facades\DB;

class Room extends BaseModel
{
    protected $table    = 'rooms';

    protected $fillable = [
        'location', 'name', 'number_of_computer', 'create_by'
    ];

    public function roomsAtLocation($location)
    {
        return $this->getWithCondition(['location', '=', $location]);
    }

    public function numComputerOfRoom($rooms)
    {
        return $rooms->number_of_computer;
    }

    public function updateById($input, $id)
    {
        $result = DB::table('rooms')
            ->where('id', '=', $id)
            ->update([
                'location' => $input['location'],
                'name' => $input['roomName'],
                'number_of_computer' => $input['number_of_computer']
            ]);

        return $result;
    }

    public function deleteById($id)
    {
        $result = DB::table('rooms')
            ->delete($id);

        return $result;
    }

    public function checkRoom($location, $name)
    {
        return DB::table('rooms')
            ->where([['location', '=', $location], ['name', '=', $name]])
            ->get()
            ->first();
    }

    public function allRoomName()
    {
        DB::table('rooms')
            ->select(DB::raw("CONCAT(rooms.name, ' ', rooms.location) AS name"))
            ->get();
    }

    public function getAllRoomID()
    {
        $allID = collect();

        $all = DB::table('rooms')
            ->select('id')
            ->get();

        foreach ($all as $room)
        {
            $allID = $allID->merge($room->id);
        }

        return $allID;
    }

    public function getByID($id)
    {
        return DB::table('rooms')
            ->where('id', '=', $id)
            ->select(
                'id',
                DB::raw("CONCAT(rooms.name, ' ', rooms.location) AS name"),
                'number_of_computer',
                DB::raw("rooms.name AS roomName"),
                'location'
            )
            ->get()
            ->first();
    }

    public function getNumOfComputer($roomIDs = [])
    {
        $count = 0;
        if (gettype($roomIDs) == 'integer') return $this->getByID($roomIDs)->number_of_computer;

        foreach ($roomIDs as $roomID)
        {
            $room = $this->getByID($roomID);
            $count += $room->number_of_computer;
        }

        return $count;
    }

    public function getBySubjectCodeAndExamShift($subjectCode, $examShift, $examID)
    {
        return DB::table('exams_subjects_rooms_student_details')
            ->where('subject_code', '=', $subjectCode)
            ->join('exams_subjects_rooms',
                'exams_subjects_rooms_student_details.exams_subjects_rooms_id',
                '=',
                'exams_subjects_rooms.id')
            ->where([
                [
                    'exams_subjects_rooms.exam_shift', '=', $examShift
                ],
                [
                    'exam_id', '=', $examID
                ]
            ])
            ->join('rooms',
                'exams_subjects_rooms_student_details.room_id',
                '=',
                'rooms.id')
            ->select(
                DB::raw("CONCAT(rooms.name, ' ', rooms.location) AS name"),
                'rooms.id',
                'exams_subjects_rooms_student_details.exams_subjects_rooms_id'
            )
            ->distinct()
            ->get();
    }
}
