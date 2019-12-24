<?php

namespace App\Http\Controllers;

use App\Scheduling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchedulingController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Scheduling();
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
            'table' => 'schedulingTable'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.scheduling');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $result = $this->model->store($input);

        return response()->json($result, 200);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllRemainingRoomInfoInDayAndExamShift($date, $examShift)
    {
        $result = $this->model->getAllRemainingRoomInfoInDateAndExamShift($date, $examShift);

        return response()->json($result, 200);
    }

    public function getAllInfo()
    {
        $all = $this->model->getAllInfoConverted();

        return response()->json($all, 200);
    }
}
