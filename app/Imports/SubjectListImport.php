<?php

namespace App\Imports;

use App\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectListImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
*/
    public function model(array $row)
    {
        return new Subject([
            'name' => $row['name'],
            'subject_code' => $row['subject_code'],
            'number_of_credits' => $row['number_of_credits'],
        ]);
    }
}
