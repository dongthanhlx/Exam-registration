<?php

namespace App\Imports;

use App\StudentDetailSubjectClass;
use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentNotEligibleImport implements ToModel, WithValidation
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

        return new StudentDetailSubjectClass([
            'student_code' => $row['student_code'],
            'subject_class_id' => $subjectClassID,
            'comments' => $row['comments'],
            'contest_conditions' => $row['contest_conditions']
        ]);
    }

    public function rules(): array
    {
        return [
            'subject_code' => 'required',
            'serial' => 'required',
            'student_code' => 'required',
            'comments' => 'required',
            'contest_conditions' => 'required'
        ];
    }

}
