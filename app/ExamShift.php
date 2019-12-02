<?php

namespace App;


class ExamShift extends BaseModel
{
    protected $table = 'exam_shifts';

    protected $fillable = [
        'start_time', 'finish_time', 'exam_id', 'subject_code', 'create_by'
    ];
/*
    public function getObjectCollection($exam_shifts): Collection
    {
        $collection          = new Collection();
        $subjectModel        = new Subject();
        $roomModel           = new Room();
        $roomsExamShiftModel = new RoomsExamShifts();

        foreach ($exam_shifts as $exam_shift)
        {
            $examShiftID = $exam_shift->id;
            $startTime       = $exam_shift->start_time;
            $finishTime      = $exam_shift->fiish_time;
            $subjectCode     = $exam_shift->subject_code;
            $subject         = $subjectModel->getSubjectBySubjectCode($subjectCode);

            $rooms           = $roomsExamShiftModel->getAllRoomByExamShiftID($examShiftID);
            $roomCollection  = $roomModel->getObjectCollection($rooms);
            $collection->add(new ExamShift($startTime, $finishTime, $subject, $roomCollection));
        }

        return $collection;
    }
*/

    public function examShiftsOfExam($exam)
    {
        $examID = $exam->id;
        return $this->getWithCondition(['exam_id', '=', $examID]);
    }

}
