<?php

namespace App\Imports;

use App\Exam;
use App\SubjectClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubjectClassImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $semester = $row['semester'];
        $year = $row['year'];

        $model = new Exam();
        $exam = $model->getBySemesterAndYear($semester, $year);
        $exam_id = $exam->id;

        return new SubjectClass([
            'subject_code' => $row['subject_code'],
            'serial' => $row['serial'],
            'teacher' => $row['teacher'],
            'maximum_number_of_student' => $row['maximum_number_of_student'],
            'exam_id' => $exam_id
        ]);
    }

    public function rules(): array
    {
        return [
            'subject_code' => 'required',
            'serial' => 'required|numeric',
            'teacher' => 'required',
            'maximum_number_of_student' => 'required|numeric',
            'semester' => 'required|numeric',
            'year' => 'required'
        ];
    }
}
