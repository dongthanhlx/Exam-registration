<?php

namespace App;


class Location extends BaseModel
{
    protected $table    = 'locations';

    protected $fillable = [
        'name', 'create_by'
    ];
/*
    public function getObjectCollection($locations): Collection
    {
        $collection     = new Collection();
        $roomModel      = new Room();

        foreach ($locations as $location)
        {
            $name       = $location->name;
            $locationID = $location->id;

            $rooms          = $roomModel->getAllRoomByLocationID($locationID);
            $roomCollection = $roomModel->getObjectCollection($rooms);

            $collection->add(new Location($name, $roomCollection));
        }

        return $collection;
    }*/
}
