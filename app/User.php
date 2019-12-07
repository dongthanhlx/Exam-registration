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

    public function deleteWhere($conditions = [])
    {
        DB::table('users')
            ->where([$conditions])
            ->update(['deleted' => true]);
    }

    public function updateWhere($input, $conditions = [])
    {
        $firstName = $input['firstName'];
        $lastName = $input['lastName'];
        $email = $input['email'];

        DB::table('users')
            ->where([$conditions])
            ->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email
            ]);

    }
}
