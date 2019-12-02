<?php

namespace App\Imports;

use App\Student;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentInfoImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     * @return Student|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     * @throws \Exception
     */
    public function model(array $row)
    {
        $email = $row['email'];
        $userModel = new User();
        $user = $userModel->getUserByEmail($email);
        $user_id = $user->id;
        return new Student([
            'student_code'  => $row['student_code'],
            'birthday'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthday']),
            'class'         => $row['class'],
            'gender'        => $row['gender'],
            'user_id'       => $user_id,
        ]);
    }

}
