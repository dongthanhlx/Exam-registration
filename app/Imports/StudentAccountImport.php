<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentAccountImport implements ToModel, WithValidation, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $email = $row[3];
        $user = new User();
        $record = $user->getByEmail($email);

        if ($record != null) return null;

        return new User([
            'first_name' => $row[1],
            'last_name' => $row[2],
            'email'     => $email,
            'password'  => Hash::make($row[4])
        ]);
    }

    public function rules(): array
    {
        return [
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required'
        ];
    }

    public function startRow(): int
    {
        return 3;
    }

}
