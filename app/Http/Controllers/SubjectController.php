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
        $this->middleware('auth:admin');
        $this->model = new Subject();
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
        $subject = $this->model->getByID($id);
        return $subject->toJson();
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

        return view('admin.edit', ['record' => $record, 'form' => 'subject']);
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
        return redirect()->route('admin.import.subject')->with('message', 'Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('subjects')
            ->delete($id);
        return redirect()->route('admin.import.subject')->with('message', 'Delete Successfully');
    }

    public function showSubjectImportForm()
    {
        $records = $this->model->getAll();

        return view('admin.import', ['route' => route('admin.import.subject'), 'table' => 'subjectTable', 'records' => $records]);
    }
}
