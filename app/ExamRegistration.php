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
        $roomModel = new Room();
        $data = $input['data'];
        $studentID = $input['studentID'];

        foreach ($data as $record)
        {
            $subjectCode = $record['subject_code'];
            $schedulingID = $record['id'];
            $room = $record['room'];
            $roomID = $room['id'];
            $allComputer = $roomModel->getNumOfComputer($roomID);
            $registeredComputer = $this->countRegistrationBySchedulingIDAndRoomID($schedulingID, $roomID);

            if ($allComputer > $registeredComputer) {
                DB::table('exams_subjects_rooms_student_details')
                    ->updateOrInsert([
                        'student_id' => $studentID,
                        'subject_code' => $subjectCode
                    ], [
                        'exams_subjects_rooms_id' => $schedulingID,
                        'student_id' => $studentID,
                        'room_id' => $roomID,
                        'subject_code' => $subjectCode
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
