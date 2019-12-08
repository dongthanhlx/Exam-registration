<?php

namespace App\Imports;

use App\Room;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RoomImport implements ToModel, WithHeadingRow
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
}
