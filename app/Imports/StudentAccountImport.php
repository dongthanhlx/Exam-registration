<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentAccountImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $email = $row['email'];
        $user = new User();
        $record = $user->getByEmail($email);

        if ($record != null) return null;

        return new User([
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email'     => $email,
            'password'  => Hash::make($row['password'])
        ]);
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'unique:users',
            'password' => 'required'
        ];
    }

}
