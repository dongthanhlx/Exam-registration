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

    public function index()
    {
        $all = $this->model->allAccount();

        return view('admin.import', [
            'route' => route('admin.import.StudentAccount'),
            'table' => 'studentAccountTable',
            'records' => $all
        ]);
    }

    public function show($id)
    {
        $record = $this->model->getWhere(['id', '=', $id]);

        return response()->json($record)
                ->header('Content-Type', 'application/json; charset=UTF-8');
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
        if ($result) {
            $student = new Student();
            $result = $student->deleteById($id);
        }

        return $result;
    }
}
