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

        return view('admin.edit', ['record' => $record, 'form' => 'subjectClass']);
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

        return redirect()->route('admin.import.SubjectClass')->with('message', 'Edit Successfully');
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

        return redirect()->route('admin.import.SubjectClass')->with('message', 'Delete Successfully');
    }

    public function showSubjectClassImportForm()
    {
        $records = $this->model->getAll();

        return view('admin.import', ['route' => route('admin.import.SubjectClass'), 'table' => 'subjectClassTable', 'records' => $records]);
    }
}
