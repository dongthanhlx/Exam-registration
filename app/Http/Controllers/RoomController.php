<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new Room();
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.import', [
            'route' => route('admin.import.room'),
            'table' => 'roomTable'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function validator(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'name' => 'required',
            'number_of_computer' => 'required|numeric'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);

        $this->model->name = $request->input('name');
        $this->model->number_of_computer = $request->input('number_of_computer');
        $this->location_id = $request->input('location_id');

        $this->model->save();

        return back()->with('message', 'Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = $this->model->getByID($id);

        return response()->json($record)
            ->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function showAll()
    {
        $records = $this->model->getAll();

        return response()->json($records)
            ->header('Content-Type', 'application/json; charset=UTF-8');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validator($request);
         $input = $request->all();

         $result = $this->model->updateById($input, $id);

         return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->model->deleteById($id);

        return $result;
    }
}
