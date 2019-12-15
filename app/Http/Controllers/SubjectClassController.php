<?php

namespace App\Http\Controllers;

use App\SubjectClass;
use Illuminate\Http\Request;

class SubjectClassController extends Controller
{
    protected $model;

    /**
     * SubjectClassController constructor.
     * @param $subjectClass
     */
    public function __construct()
    {
        $this->model = new SubjectClass();
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
            'route' => route('admin.import.SubjectClass'),
            'table' => 'subjectClassTable'
        ]);
    }

    public function validator(Request $request)
    {
        $request->validate([
            'subject_code' => 'required',
            'serial' => 'required',
            'teacher' => 'required',
            'maximum_number_of_student' =>  'required'
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

        $this->model->serial = $request->input('serial');
        $this->model->subject_code = $request->input('subject_code');
        $this->model->teacher = $request->input('teacher');
        $this->model->maximum_number_of_student = $request->input('maximum_number_of_student');

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
                ->header('Content-Type', 'application/json; charset=UTF-8');
    }

    public function showAll()
    {
        $all = $this->model->getAll();

        return response()->json($all)
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

        $result = $this->model->updateById($input, ['id', '=', $id]);

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

    public function getByYearAndSemester($year, $semester)
    {
        $records = $this->model->getByYearAndSemester($year, $semester);

        return response()->json($records, 200);
    }
}
