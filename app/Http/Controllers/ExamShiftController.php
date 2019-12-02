<?php

namespace App\Http\Controllers;

use App\ExamShift;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ExamShiftController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new ExamShift();
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
            'start_time' => $request->input('start_time'),
            'finish_time' => $request->input('finish_time'),
            'exam_id' => $request->input('exam_id'),
            'subject_code' => $request->input('subject_code')
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

        $this->model->start_time = $request->input('start_time');
        $this->model->finish_time = $request->input('finish_time');
        $this->model->exam_id = $request->input('exam_id');
        $this->model->subject_code = $request->input('subject_code');

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
}
