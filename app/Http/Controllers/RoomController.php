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
//        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = $this->model->getByID($id);

        return view('admin.edit', ['record' => $record->toJson(), 'form' => 'room']);
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

        $this->model->updateWhere($input, ['id', '=', $id]);

        return redirect()->route('admin.import.room')->with('message', 'Edit successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->deleteById($id);

        return redirect()->route('admin.import.room')->with('message', 'Delete successfully');
    }

    public function showRoomImportForm()
    {
        $records = $this->model->getAll();

        return view('admin.import', ['route' => route('admin.import.room'), 'table' => 'roomTable', 'records' => $records]);
    }

    public function test()
    {
        $records = $this->model->getAll();

        return response()->json($records)->header('Content-Type', 'application/json;');
    }
}
