<?php

namespace App;


use Illuminate\Support\Facades\DB;

class Room extends BaseModel
{
    protected $table    = 'rooms';

    protected $fillable = [
        'location', 'name', 'number_of_computer', 'create_by'
    ];

    public function roomsAtLocation($location)
    {
        return $this->getWithCondition(['location', '=', $location]);
    }

    public function numComputerOfRoom($rooms)
    {
        return $rooms->number_of_computer;
    }

    public function updateById($input, $id)
    {
        $result = DB::table('rooms')
            ->where('id', '=', $id)
            ->update([
                'location' => $input['location'],
                'name' => $input['name'],
                'number_of_computer' => $input['number_of_computer']
            ]);

        return $result;
    }

    public function deleteById($id)
    {
        $result = DB::table('rooms')
            ->delete($id);

        return $result;
    }

    public function checkRoom($location, $name)
    {
        return DB::table('rooms')
            ->where([['location', '=', $location], ['name', '=', $name]])
            ->get()
            ->first();
    }

    public function allRoomName()
    {
        DB::table('rooms')
            ->select(DB::raw("CONCAT(rooms.name, ' ', rooms.location) AS name"))
            ->get();
    }
}
