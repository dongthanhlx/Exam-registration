<?php

namespace App\Imports;

use App\StudentDetailSubjectClass;
use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentListOfSubjectClassImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new StudentDetailSubjectClass([
            'student_code' => $row['student_code'],
            'subject_code' => $row['subject_code'],
            'serial' => $row['serial']
        ]);
    }

    public function rules(): array
    {
        return [
            'student_code' => 'required',
            'subject_code' => 'required',
            'serial' => 'required'
        ];
    }

}
