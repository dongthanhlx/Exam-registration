<?php

namespace App\Imports;

use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectClassImport implements ToModel, WithHeadingRow
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
}
