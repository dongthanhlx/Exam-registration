<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExamRegistration extends BaseModel
{

    protected $table = 'exams_subjects_rooms_student_details';

    protected $fillable = [
        'exams_subjects_rooms_id', 'student_id', 'create_by'
    ];

    public function store($input)
    {
        /*$schedulingModel = new Scheduling();
        $roomModel = new Room();
        $schedulingID = $input['schedulingID'];
        $studentID = $input['studentID'];
        $roomID = $input['roomID'];

        $scheduling = $schedulingModel->getByID($schedulingID);
        $roomIDs = unserialize($scheduling->room_id);

        $numOfComputer = $roomModel->getNumOfComputer($roomIDs);
        $registered = $this->countRegistrationBySchedulingIDAndRoomID($schedulingID, $roomID);

        if ($numOfComputer > $registered) {
            return $this::firstOrCreate([
                'exams_subjects_rooms_id' => $schedulingID,
                'student_id' => $studentID
            ]);
        }

        return false;*/
        $roomModel = new Room();
        $data = $input['data'];
        $studentID = $input['studentID'];
        foreach ($data as $record)
        {
            var_dump($record);
            $schedulingID = $record['id'];
            $room = $record['room'];
            $roomID = $room['id'];
            $allComputer = $roomModel->getNumOfComputer($roomID);
            $registeredComputer = $this->countRegistrationBySchedulingIDAndRoomID($schedulingID, $roomID);

            if ($allComputer > $registeredComputer) {
                DB::table('exams_subjects_rooms_student_details')
                    ->insert([
                        'exams_subjects_rooms_id' => $schedulingID,
                        'student_id' => $studentID,
                        'room_id' => $roomID
                    ]);
            }
        }
    }

    public function countRegistrationBySchedulingIDAndRoomID($schedulingID, $roomID)
    {
        return DB::table('exams_subjects_rooms_student_details')
            ->where([['exams_subjects_rooms_id', '=', $schedulingID], ['room_id', '=', $roomID]])
            ->count();
    }

    public function getAllRootInfo()
    {
        return DB::table('exams_subjects_rooms_student_details')
            ->join('exams_subjects_rooms',
                'exams_subjects_rooms_student_details.exams_subjects_rooms_id', '=', 'exams_subjects_rooms.id')
            ->join('subjects',
                'exams_subjects_rooms.subject_id', '=', 'subjects.id')
            ->get();
    }
}