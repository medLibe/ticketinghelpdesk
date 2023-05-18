<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'username',
        'password',
        'remember_token',
        'created_by',
        'updated_by',
        'is_active',
    ];

     public function authenticateUser($username)
     {
        $getUser = User::join('roles', 'roles.id', '=', 'users.role_id')
                       ->where('username', $username)
                       ->first(['users.*', 'roles.role_name']);

        return $getUser;
     }
}
