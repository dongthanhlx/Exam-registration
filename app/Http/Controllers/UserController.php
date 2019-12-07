<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new User();
        $this->middleware('auth:admin');
    }

    public function showStudentAccountImportForm()
    {
        $records = $this->model->allAccount();

        return view('admin.import', ['route' => route('admin.import.StudentAccount'), 'table' => 'studentAccountTable', 'records' => $records]);
    }

    public function validator(Request $request)
    {
        $request->validate([
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'email' => 'required',
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
        $record = $this->model->getWhere(['id', '=', $id]);

        return view('admin.edit', ['record' => $record, 'form' => 'studentAccount']);
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

        return redirect()->route('admin.import.StudentAccount')->with('message', 'Edit Successfully');
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
        $student = new Student();
        $student->deleteWhere(['user_id', '=', $id]);

        return back()->with('message', 'Delete Successfully');
    }
}
