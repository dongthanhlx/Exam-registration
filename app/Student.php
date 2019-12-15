<?php

namespace App;



use Illuminate\Support\Facades\DB;

class Student extends BaseModel
{
    protected $table    = 'student_details';

    protected $fillable = [
        'student_code', 'birthday', 'class', 'gender', 'user_id', 'create_by'
    ];
/*
    public function getObjectCollection($students): Collection
    {
        $collection = new Collection();

        foreach ($students as $student)
        {
            $studentCode = $student->student_code;
            $birthday    = $student->birthday;
            $class       = $student->class;
            $gender      = $student->gender;

            $collection->add(new Student($studentCode, $birthday, $class, $gender));
        }

        return $collection;
    }
*/

    public function getStudentByStudentCode($studentCode)
    {
        return $this->getWithCondition(['student_code', '=', $studentCode])->first();
    }

    public function accountOfStudent($student)
    {
        $user_id = $student->user_id;
        return (new User())->getWhere(['user_id', '=', $user_id]);
    }

    public function studentInfoOfStudentCode($studentCode)
    {
        return $this->getWithCondition(['student_code', '=', $studentCode]);
    }

    public function getAllInfo()
    {
        return DB::table('users')
            ->join('student_details', 'users.id', '=', 'student_details.user_id')
            ->where('student_details.deleted', '=', false)
            ->select('student_details.id', 'first_name', 'last_name', 'birthday', 'gender', 'student_code', 'class')
            ->get();
    }

    public function getInfoStudentByID($id)
    {
        return DB::table('student_details')
            ->where('student_details.id', '=', $id)
            ->join('users', 'student_details.user_id', '=', 'users.id')
            ->select('student_details.id', 'first_name', 'last_name', 'birthday', 'gender', 'student_code', 'class')
            ->get()
            ->first();
    }

    public function deleteById($id)
    {
        $result = DB::table('student_details')
            ->where('id', '=', $id)
            ->update([
                'deleted' => true
            ]);

        return $result;
    }

    public function updateById($input, $id)
    {
        $result = DB::table('student_details')
            ->where('id', '=', $id)
            ->update([
                'student_code' => $input['student_code'],
                'birthday' => $input['birthday'],
                'class' => $input['class'],
                'gender' => $input['gender'],
            ]);

        return $result;
    }

    public function getBySubjectClass($subjectCode, $serial)
    {
        return DB::table('subject_classes')
            ->where([['student_code', '=', $subjectCode], ['serial', '=', $serial]])
            ->join('student_details_subject_classes',
                'subject_classes.id', '=', 'student_details_subject_classes.subject_class_id')
            ->join('student_details',
                'student_details.student_code', '=', 'student_details_subject_classes.student_code')
            ->select('student_details.*')
            ->get();
    }

}

