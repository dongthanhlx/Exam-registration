<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getAll()
    {
        return $this::all();
    }

    public function getWithCondition($conditions = [])
    {
        return $this::where([$conditions])->get();
    }

    public function getWithConditions($conditions = [])
    {
        return $this::where($conditions)->get();
    }

    public function getByID($id)
    {
        return $this::findOrFail($id);
    }

    public function saveInput($input)
    {
        $this->saveOrFail($input);
    }

}
