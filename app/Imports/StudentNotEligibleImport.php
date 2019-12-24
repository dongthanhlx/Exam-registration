<?php

namespace App\Imports;

use App\StudentDetailSubjectClass;
use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentNotEligibleImport implements ToModel, WithValidation, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $subjectCode = $row[5];
        $serial = $row[6];

        $subjectClass = (new SubjectClass())->getSubjectClassBySubjectCodeAndSerial($subjectCode, $serial);
        $subjectClassID = $subjectClass->id;

        return new StudentDetailSubjectClass([
            'student_code' => $row[3],
            'subject_class_id' => $subjectClassID,
            'comments' => $row[8],
            'contest_conditions' => $row[7]
        ]);
    }

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
    }
}
