<?php

namespace App\Http\Controllers;

use App\Imports\RoomImport;
use App\Imports\StudentAccountImport;
use App\Imports\StudentInfoImport;
use App\Imports\StudentListOfSubjectImport;
use App\Imports\SubjectClassImport;
use App\Imports\SubjectListImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends AdminController
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function studentAccount()
    {
        $this->import(new StudentAccountImport());
        return redirect()->route('admin.account.index')->with('message', 'Import file successfully');
    }

    public function studentInfo()
    {
        $this->import(new StudentInfoImport());
        return redirect()->route('admin.student.index')->with('message', 'Import file successfully');
    }

    public function subject()
    {
        $this->import(new SubjectListImport());
        return redirect()->route('admin.subject.index');
    }

    public function studentListOfSubject()
    {
        $this->import(new StudentListOfSubjectImport());

    }

    public function room()
    {
        $this->import(new RoomImport());
        return redirect()->route('admin.room.index')->with('message', 'Import successfully');
    }

    public function subjectClass()
    {
        $this->import(new SubjectClassImport());
        return redirect()->route('admin.SubjectClass.index')->with('message', 'Import Successfully');
    }
}
