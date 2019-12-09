<?php

namespace App\Imports;

use App\Room;
use Dotenv\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RoomImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Room([
            'location' => $row['location'],
            'name' => $row['name'],
            'number_of_computer' => $row['number_of_computer']
        ]);
    }

    public function rules(): array
    {
        return [
            'location' => 'required|string',
            'name' => 'required',
            'number_of_computer' => 'required|numeric'
        ];
    }

}
