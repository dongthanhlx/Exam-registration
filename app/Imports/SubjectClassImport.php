<?php

namespace App\Imports;

use App\Exam;
use App\Subject;
use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubjectClassImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $exam = (new Exam)->getExamActive();
        if ($exam == null) return null;
        $exam_id = $exam->id;

        $subjectCode = $row['subject_code'];
        $subjectModel = new Subject();
        $subject = $subjectModel->getBySubjectCode($subjectCode);
        if ($subject == null) return null;

        return new SubjectClass([
            'subject_code' => $subjectCode,
            'serial' => $row['serial'],
            'teacher' => $row['teacher'],
            'maximum_number_of_student' => $row['maximum_number_of_student'],
            'exam_id' => $exam_id
        ]);
    }
/*
    public function rules(): array
    {
        return [
            '1' => 'required',
            '2' => 'required|numeric',
            '3' => 'required',
            '4' => 'required|numeric',
            '5' => 'required|numeric',
            '6' => 'required'
        ];
    }

    public function startRow(): int
    {
        return 3;
    }*/

}
