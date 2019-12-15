<?php

namespace App\Http\Controllers;

use App\Imports\subjectInfoImport;
use App\Imports\SubjectListImport;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    protected $model;

    public function __construct()
    {
//        $this->middleware('auth:admin');
        $this->model = new Subject();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.import', [
            'route' => route('admin.import.subject'),
            'table' => 'subjectTable'
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
            'name' => 'required',
            'subject_code' => 'required',
            'number_of_credits' => 'required|numeric'
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

        $this->model->subject_code = $request->input('subject_code');
        $this->model->name = $request->input('name');
        $this->model->number_of_credits = $request->input('number_of_credits');

        $this->model->save();

        return back()->with('message', 'Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return string
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

    public function getByYearAndSemester($year, $semester)
    {
        $record = $this->model->getByYearAndSemester($year, $semester);

        return response()->json($record, 200);
    }
}
