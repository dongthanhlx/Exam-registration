<?php

namespace App;


use Illuminate\Support\Facades\DB;

class Room extends BaseModel
{
    protected $table    = 'rooms';

    protected $fillable = [
        'location', 'name', 'number_of_computer', 'create_by'
    ];
/*
    public function getObjectCollection($rooms): Collection
    {
        $collection      = new Collection();

        foreach ($rooms as $room)
        {
            $name        = $room->name;
            $numComputer = $room->number_of_computer;

            $collection->add(new Room($name, $numComputer));
        }

        return $collection;
    }*/

    public function roomsAtLocation($location)
    {
        return $this->getWithCondition(['location', '=', $location]);
    }

    public function numComputerOfRoom($rooms)
    {
        return $rooms->number_of_computer;
    }

    public function allRoom()
    {
        return DB::table('rooms')
            ->join('locations', 'rooms.location_id', '=', 'locations.id')
            ->select('locations.name AS location', 'name', 'number_of_computer')
            ->get();
    }

    public function updateWhere($input, $condition = [])
    {
        DB::table('rooms')
            ->where([$condition])
            ->update([
                'location' => $input['location'],
                'name' => $input['name'],
                'number_of_computer' => $input['number_of_computer']
            ]);
    }

    public function deleteById($id)
    {
        DB::table('rooms')
            ->delete($id);
    }
}
