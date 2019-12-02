<?php

namespace App\Http\Controllers;

use App\Imports\StudentAccountImport;
use App\Imports\StudentInfoImport;
use App\Imports\StudentListOfSubjectImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends AdminController
{
    public function showStudentAccountImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.StudentAccount')]);
    }

    public function showStudentInfoImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.StudentInfo')]);
    }

    public function showStudentListOfSubjectImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.StudentListOfSubject')]);
    }

    public function importStudentAccount()
    {
        $this->import(new StudentAccountImport());
    }

    public function importStudentInfo()
    {
        $this->import(new StudentInfoImport());
    }

    public function importStudentListOfSubject()
    {
        $this->import(new StudentListOfSubjectImport());
    }
}
