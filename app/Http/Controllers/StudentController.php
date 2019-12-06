<?php

namespace App\Http\Controllers;

use App\Imports\StudentAccountImport;
use App\Imports\StudentInfoImport;
use App\Imports\StudentListOfSubjectClassImport;
use App\Imports\StudentNotEligibleImport;
use App\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new Student();
        $this->middleware('auth:admin');
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

    public function validator(Request $request)
    {
        $request->validate([
            'student_code' => 'required',
            'birthday' => 'required',
            'class' => 'required',
            'gender' => 'required',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = $this->model->getInfoStudentByID($id);

        return view('admin.edit', ['route' => route('admin.student.update', $id), 'record' => $record, 'form' => 'studentInfo']);
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

        return redirect()->route('admin.import.StudentInfo')->with('message', 'Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->deleteWhere(['id', '=', $id]);

        return redirect()->route('admin.import.StudentInfo')->with('message', 'Delete Successfully');
    }
}
