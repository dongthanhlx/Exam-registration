<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamRegistration;
use App\Scheduling;
use Illuminate\Http\Request;

class ExamRegistrationController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new ExamRegistration();
        $this->middleware('auth');
    }

    public function showStudentExamIDAndExamShift()
    {
        $all = $this->model->getAllStudentByRoomIDAndExamShift();

        return response()->json($all, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('examRegistration');
    }

    public function result()
    {
        return view('admin.import',[
            'table' => 'examRegistrationResultTable.blade'
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $this->model->store($input);
        /*$all = (new Scheduling())->getAllInfoConverted();
        return response()->json($all, 200);*/

        return response()->json('OK', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
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

    public function getInfoPrint($studentID)
    {
        $all = $this->model->getInfoPrint($studentID);

        return response()->json($all, 200);
    }

    public function getRegistered($studentID)
    {
        $all = $this->model->getAllByStudentID($studentID);

        return response()->json($all, 200);
    }

    public function checkStatusAt($time)
    {
        $result = $this->model->checkActive($time);

        return response()->json($result, 200);
    }

    public function getNewestExam()
    {
        $newest = (new Exam())->getNewestExam();

        return response()->json($newest, 200);
    }

    public function getStudentInfoByUserID($userID)
    {
        $studentInfo = $this->model->getStudentInfoByUserID($userID);

        return response()->json($studentInfo, 200);
    }
}
