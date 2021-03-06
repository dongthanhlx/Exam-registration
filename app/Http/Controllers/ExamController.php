<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new Exam();
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all =  $this->model->getAll();

        return response()->json($all, 200);
    }

    public function validator(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'semester' => 'required',
            'year' => 'required'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.createExamSite');
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
        $input = $request->all();
        $this->model->store($input);

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
        $input = $request->all();
        $this->model->updateStatus($id, $input);

        return response()->json('OK', 200);
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

    public function allYear()
    {
        $result = $this->model->allYear();

        return response()->json($result, 200);
    }

    public function getSemestersByYear($year)
    {
        $result = $this->model->getSemestersByYear($year);

        return response()->json($result, 200);
    }

    public function getExamActive()
    {
        $result = $this->model->getExamActive();

        return response()->json($result, 200);
    }
}
