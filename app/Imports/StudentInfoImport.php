<?php

namespace App\Imports;

use App\Student;
use App\User;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class StudentInfoImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
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
        $user = $userModel->getByEmail($email);
        if ($user == null) return null;
        $user_id = $user->id;
        return new Student([
            'student_code'  => $row['student_code'],
            'birthday'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthday']),
            'class'         => $row['class'],
            'gender'        => $row['gender'],
            'user_id'       => $user_id,
        ]);
    }

    public function rules(): array
    {
        return [
            'student_code' => 'required',
            'birthday' => 'required',
            'class' => 'required',
            'gender' => 'required',
            'email' => 'required'
        ];
    }
}
