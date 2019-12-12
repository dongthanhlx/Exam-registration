<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new Student();
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.import', [
            'route' => route('admin.import.StudentInfo'),
            'table' => 'studentInfoTable'
        ]);
    }

    public function showStudentListOfSubjectImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.StudentListOfSubject'), 'table' => 'studentOfSubjectTable']);
    }

    public function validator(Request $request)
    {
        $request->validate([
            'student_code' => 'required',
            'birthday' => 'required',
            'class' => 'required',
            'gender' => 'required',
        ]);
    }

    public function show($id)
    {
        $record = $this->model->getById($id);

        return response()->json($record)
                ->header('Content-Type', 'application/json; chartset=UTF-8')
    }

    public function showAll()
    {
        $all = $this->model->getAll();

        return response()->json($all)
                ->header('Content-Type', 'application/json; chartset=UTF-8')
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
        $result = $this->model->deleteById(['id', '=', $id]);

        return $result;
    }
}
