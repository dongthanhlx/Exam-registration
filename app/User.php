<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getByEmail($email)
    {
        return DB::table('users')->where('email', '=', $email)->get()->first();
    }

    public function allAccount()
    {
        return DB::table('users')
            ->join('student_details',
                'users.id', '=', 'student_details.user_id')
            ->select(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), 'student_code', 'email', 'password')
            ->get();
    }
}
