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

    public function importStudentAccount()
    {
        $this->import(new StudentAccountImport());
        return redirect()->route('admin.import.StudentAccount')->with('message', 'Import file successfully');
    }

    public function importStudentInfo()
    {
        $this->import(new StudentInfoImport());
        return redirect()->route('admin.import.StudentInfo')->with('message', 'Import file successfully');
    }

    public function importSubjectList()
    {
        $this->import(new SubjectListImport());
        return redirect()->route('admin.import.subject');
    }

    public function importStudentListOfSubject()
    {
        $this->import(new StudentListOfSubjectImport());

    }

    public function importRoomList()
    {
        $this->import(new RoomImport());
        return redirect()->route('admin.import.room')->with('message', 'Import successfully');
    }

    public function importSubjectClass()
    {
        $this->import(new SubjectClassImport());
        return redirect()->route('admin.import.SubjectClass')->with('message', 'Import Successfully');
    }
}
