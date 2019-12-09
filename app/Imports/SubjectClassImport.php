<?php

namespace App\Imports;

use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubjectClassImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubjectClass([
            'subject_code' => $row['subject_code'],
            'serial' => $row['serial'],
            'teacher' => $row['teacher'],
            'maximum_number_of_student' => $row['maximum_number_of_student']
        ]);
    }

    public function rules(): array
    {
        return [
            'subject_code' => 'required',
            'serial' => 'required',
            'teacher' => 'required',
            'maximum_number_of_student' => 'required|numeric'
        ];
    }
}
