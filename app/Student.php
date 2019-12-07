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

    public function deleteWhere($conditions = [])
    {
        DB::table('student_details')
            ->where([$conditions])
            ->update(['deleted' => true]);
    }

    public function updateWhere($input, $conditions = [])
    {
        $studentCode = $input['student_code'];
        $birthday = $input['birthday'];
        $class = $input['class'];
        $gender = $input['gender'];

        DB::table('student_details')
            ->where([$conditions])
            ->update([
                'student_code' => $studentCode,
                'birthday' => $birthday,
                'class' => $class,
                'gender' => $gender,
            ]);
    }


}
