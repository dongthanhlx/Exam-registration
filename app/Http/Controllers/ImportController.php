<?php

namespace App\Http\Controllers;

use App\Imports\StudentAccountImport;
use App\Imports\StudentInfoImport;
use App\Imports\StudentListOfSubjectImport;
use App\Imports\SubjectListImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends AdminController
{
    public function showStudentAccountImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.StudentAccount'), 'table' => 'studentAccountTable']);
    }

    public function importStudentAccount()
    {
        $this->import(new StudentAccountImport());
    }

    public function showStudentInfoImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.StudentInfo'), 'table' => 'studentInforTable']);
    }

    public function importStudentInfo()
    {
        $this->import(new StudentInfoImport());
    }

    public function showStudentListOfSubjectImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.StudentListOfSubject'), 'table' => 'studentOfSubjectTable']);
    }

    public function importStudentListOfSubject()
    {
        $this->import(new StudentListOfSubjectImport());
    }

    public function showSubjectListImportForm()
    {
        return view('admin.import', ['route' => route('admin.import.SubjectList')]);
    }

    public function importSubjectList()
    {
        $this->import(new SubjectListImport());
    }
}
