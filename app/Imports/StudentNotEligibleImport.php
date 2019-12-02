<?php

namespace App\Imports;

use App\StudentDetailSubjectClass;
use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentNotEligibleImport implements ToModel
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
            'contest_conditions' => $row['contest_conditions'],
            'comments' => $row['comments'],
        ]);
    }
}
