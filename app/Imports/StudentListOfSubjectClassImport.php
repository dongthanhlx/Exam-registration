<?php

namespace App\Imports;

use App\StudentDetailSubjectClass;
use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentListOfSubjectClassImport implements ToModel, WithHeadingRow
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
        $model = new SubjectClass();
        $subject = $model->getSubjectClassBySubjectCodeAndSerial($subjectCode, $serial);
        if ($subject == null) return null;
        $subject_class_id = $subject['id'];

        return new StudentDetailSubjectClass([
            'student_code' => $row['student_code'],
            'subject_class_id' => $subject_class_id
        ]);
    }
/*
    public function rules(): array
    {
        return [
            '3' => 'required',
            '5' => 'required',
            '6' => 'required'
        ];
    }

    public function startRow(): int
    {
        return 3;
    }*/

}
