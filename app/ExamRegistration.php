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


        DB::table('exams_subjects_rooms_student_details')
            ->where('student_id', '=', $studentID)
            ->delete();

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
                    ->insert([
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

    public function getAllByStudentID($studentID)
    {
        return DB::table('exams_subjects_rooms_student_details')
            ->where('student_id', '=', $studentID)
            ->get();
    }

    public function getInfoPrint($studentID)
    {
        return DB::table('exams_subjects_rooms_student_details')
            ->where('exams_subjects_rooms_student_details.student_id', '=', $studentID)
            ->join('exams_subjects_rooms',
                'exams_subjects_rooms_student_details.exams_subjects_rooms_id',
                '=',
                'exams_subjects_rooms.id')
            ->join('subjects',
                'exams_subjects_rooms.subject_id', '=', 'subjects.id')
            ->join('users',
                'exams_subjects_rooms_student_details.student_id',
                '=',
                'users.id')
            ->join('rooms',
                'exams_subjects_rooms_student_details.room_id',
                '=',
                'rooms.id')
            ->select('subjects.name',
                'subjects.subject_code',
                'exams_subjects_rooms.date',
                'exams_subjects_rooms.exam_shift',
                DB::raw("CONCAT(rooms.name, ' ', rooms.location) AS room"))
            ->get();
    }

    public function checkActive($time)
    {
        $number = DB::table('exams')
            ->where([
                ['start_registration', '<=', $time],
                ['finish_registration', '>=', $time],
                ['status', '=', 'STOP']
            ])
            ->get()
            ->count();

        return $number == 0 ? false: true;
    }

    public function getAllRoom()
    {
        return DB::table('exams_subjects_rooms_student_details')
            ->join('rooms',
                'exams_subjects_rooms_student_details.room_id',
                '=',
                'rooms.id')
            ->distinct()
            ->get();
    }

    public function getAllStudentByRoomIDAndExamShift()
    {
        return DB::table('exams_subjects_rooms_student_details')
            ->join('exams_subjects_rooms',
                'exams_subjects_rooms_student_details.exams_subjects_rooms_id',
                '=',
                'exams_subjects_rooms.id')
            ->join('student_details',
                'exams_subjects_rooms_student_details.student_id',
                '=',
                'student_details.user_id')
            ->join('users',
                'student_details.user_id',
                '=',
                'users.id')
            ->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
                'student_details.birthday',
                'student_details.student_code')
            ->get();
    }

    public function getStudentInfoByUserID($userID)
    {
        return DB::table('student_details')
            ->where('student_details.user_id', '=', $userID)
            ->join('users', 'student_details.user_id', '=', 'users.id')
            ->select('student_details.id', 'first_name', 'last_name', 'birthday', 'gender', 'student_code', 'class')
            ->get()
            ->first();
    }
}
