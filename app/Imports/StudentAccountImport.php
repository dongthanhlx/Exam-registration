<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentAccountImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $this->validation($row);

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

    public function validation(array $row)
    {
        if (!array_key_exists([
            'first_name',
            'last_name',
            'email',
            'password'
        ], $row))

        {
            return back()->withErrors('File Not successful')->withInput();
        }
    }
}
