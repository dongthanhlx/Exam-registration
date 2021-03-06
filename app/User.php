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
        return DB::table('users')
            ->where('email', '=', $email)
            ->get()
            ->first();
    }

    public function allAccount()
    {
        return DB::table('users')
            ->where('users.deleted', '=', false)
            ->select('users.id', DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), 'email')
            ->get();
    }

    public function getWhere($conditions = [])
    {
        return DB::table('users')
            ->where([$conditions])
            ->get()
            ->first();
    }

    public function deleteById($id)
    {
        $result = DB::table('users')
            ->where('id', '=', $id)
            ->update(['deleted' => true]);

        return $result;
    }

    public function updateById($input, $id)
    {
        $firstName = $input['first_name'];
        $lastName = $input['last_name'];
        $email = $input['email'];

        $result = DB::table('users')
                ->where('id', '=', $id)
                ->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email
                ]);

        return $result;
    }
}
