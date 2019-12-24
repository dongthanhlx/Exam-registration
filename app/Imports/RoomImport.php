<?php

namespace App\Imports;

use App\Room;
use Dotenv\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RoomImport implements ToModel, WithStartRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Room([
            'location' => $row[1],
            'name' => $row[2],
            'number_of_computer' => $row[3]
        ]);
    }

    public function rules(): array
    {
        return [
            '1' => 'required|string',
            '2' => 'required',
            '3' => 'required|numeric'
        ];
    }

    public function startRow(): int
    {
        return 3;
    }

}