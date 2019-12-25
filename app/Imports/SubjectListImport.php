<?php

namespace App\Imports;

use App\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubjectListImport implements ToModel, WithValidation, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
*/
    public function model(array $row)
    {
        return new Subject([
            'name' => $row[1],
            'subject_code' => $row[2],
            'number_of_credits' => $row[3],
        ]);
    }

    public function rules(): array
    {
        return [
            '1' => 'required',
            '2' => 'required',
            '3' => 'required|numeric'
        ];
    }

    public function startRow(): int
    {
        return 3;
    }

}
