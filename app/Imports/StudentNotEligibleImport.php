<?php

namespace App\Imports;

use App\StudentDetailSubjectClass;
use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentNotEligibleImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $subjectCode = $row['subject_code'];
        $serial = $row['serial'];

        $subjectClass = (new SubjectClass())->getSubjectClassBySubjectCodeAndSerial($subjectCode, $serial);
        $subjectClassID = $subjectClass->id;
        $condition = "không đủ";

        return new StudentDetailSubjectClass([
            'student_code' => $row['student_code'],
            'subject_class_id' => $subjectClassID,
            'comments' => $row['comments'],
            'contest_conditions' => $condition
        ]);
    }
/*
    public function rules(): array
    {
        return [
            '5' => 'required',
            '6' => 'required',
            '3' => 'required',
            '8' => 'required',
            '7' => 'required'
        ];
    }

    public function startRow(): int
    {
        return 3;
    }*/
}
