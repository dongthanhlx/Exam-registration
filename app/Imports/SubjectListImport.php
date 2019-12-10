<?php

namespace App\Imports;

use App\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubjectListImport implements ToModel, WithHeadingRow, WithValidation
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

    public function rules(): array
    {
        return [
            'name' => 'required',
            'subject_code' => 'unique:subjects',
            'number_of_credits' => 'required|numeric'
        ];
    }

}
