<?php

namespace App;


class Room extends BaseModel
{
    protected $table    = 'rooms';

    protected $fillable = [
        'name', 'number_of_computer', 'location_id', 'create_by'
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
        $locationID = $location->id;
        return $this->getWithCondition(['location_id', '=', $locationID]);
    }

    public function numComputerOfRoom($rooms)
    {
        return $rooms->number_of_computer;
    }
}
