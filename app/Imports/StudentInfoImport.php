<?php

namespace App\Imports;

use App\Student;
use App\User;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class StudentInfoImport implements ToModel, WithValidation, WithStartRow
{

    /**
     * @param array $row
     * @return Student|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     * @throws \Exception
     */
    public function model(array $row)
    {
        $email = $row[3];
        $userModel = new User();
        $user = $userModel->getByEmail($email);
        if ($user == null) return null;
        $user_id = $user->id;

        return new Student([
            'student_code'  => $row[4],
            'birthday'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5], '+7'),
            'class'         => $row[7],
            'gender'        => $row[6],
            'user_id'       => $user_id,
        ]);
    }

    public function rules(): array
    {
        return [
            '4' => 'required',
            '5' => 'required',
            '7' => 'required',
            '6' => 'required',
            '3' => 'required'
        ];
    }

    public function startRow(): int
    {
        return 3;
    }

}
