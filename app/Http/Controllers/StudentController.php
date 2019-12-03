<?php

namespace App\Http\Controllers;

use App\Imports\StudentAccountImport;
use App\Imports\StudentInfoImport;
use App\Imports\StudentListOfSubjectClassImport;
use App\Imports\StudentNotEligibleImport;
use App\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new Student();
    }

    public function showStudentInfoImportForm()
    {
        $records = $this->model->getAllInfo();

        return view('admin.import', ['route' => route('admin.import.StudentInfo'), 'table' => 'studentInfoTable', 'records' => $records]);
    }

    public function showStudentListOfSubjectImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.StudentListOfSubject'), 'table' => 'studentOfSubjectTable']);
    }

    public function showSubjectListImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.SubjectList')]);
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
        $request->validator([
            'student_code' => 'required',
            'birthday' => 'required',
            'class' => 'required',
            'gender' => 'required',
            'user_id' => 'required'
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

        $this->model->student_code = $request->input('student_code');
        $this->model->birthday = $request->input('birthday');
        $this->model->class = $request->input('class');
        $this->model->gender = $request->input('gender');
        $this->model->user_id  = $request->input('user_id');

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
        $this->validator($request);

        $student = $this->model->getByID($id);
        $student->student_code = $request->input('student_code');
        $student->birthday = $request->input('birthday');
        $student->class = $request->input('class');
        $student->gender = $request->input('gender');
        $student->user_id = $request->input('user_id');

        $student->save();

        return back()->with('message', 'Edit successfully');
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
