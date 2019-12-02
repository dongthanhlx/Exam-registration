<?php

namespace App;



class Student extends User
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
/*
    public function insert($input)
    {
        $email = $input->email;
        $user_id = (new User())->getUserByEmail($email)->id;

        $this::firstOrCreate(
            [
                'student_code' => $input->student_code
            ],
            [
                'birthday' => $input->birthday,
                'class' => $input->class,
                'gender' => $input->gender,
                'user_id' => $user_id,
            ]
        );
    }
*/

    public function accountOfStudent($student)
    {
        $user_id = $student->user_id;
        return (new User())->getByID($user_id);
    }

    public function studentInfoOfStudentCode($studentCode)
    {
        return $this->getWithCondition(['student_code', '=', $studentCode]);
    }
}
