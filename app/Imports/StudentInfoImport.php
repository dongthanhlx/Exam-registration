<?php

namespace App\Imports;

use App\Student;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentInfoImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $email = $row['email'];
        $userModel = new User();
        $user = $userModel->getByEmail($email);
        if ($user == null) return null;
        $user_id = $user->id;

        return new Student([
            'student_code'  => $row['student_code'],
            'birthday'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthday']),
            'class'         => $row['class'],
            'gender'        => $row['gender'],
            'user_id'       => $user_id
        ]);
    }
/*
    public function rules(): array
    {
        return [
            '4' => 'required',
            '5' => 'required',
            '7' => 'required',
            '6' => 'required',
            '3' => 'required'
        ];
    }*/
/*
    public function startRow(): int
    {
        return 3;
    }*/
}