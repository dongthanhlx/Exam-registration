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
}
