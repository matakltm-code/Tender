<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // Table
    protected $table = 'users';
    // Primary Key
    protected $primaryKey = 'id';
    // created_at and updated_at
    public $timestamps = true;


    protected $guarded = [];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * $user = User::find(1);
     * $user->is_admin; // true or false
     * $user->is_bi; // true or false
     * $user->is_pt; // true or false
     * $user->is_pr; // true or false
     * $user->is_pd; // true or false
     * $user->is_casher; // true or false
     * $user->is_sd; // true or false
     * $user->is_pac; // true or false
     */
    // UserTypes in user_type column: admin, bi, pt, pr, pd, casher, sd, pac
    public function getIsAdminAttribute()
    {
        return auth()->user()->user_type == 'admin';
    }
    public function getIsBiAttribute()
    {
        return auth()->user()->user_type == 'bi';
    }
    public function getIsPtAttribute()
    {
        return auth()->user()->user_type == 'pt';
    }
    public function getIsPrAttribute()
    {
        return auth()->user()->user_type == 'pr';
    }
    public function getIsPdAttribute()
    {
        return auth()->user()->user_type == 'pd';
    }
    public function getIsCasherAttribute()
    {
        return auth()->user()->user_type == 'casher';
    }
    public function getIsSdAttribute()
    {
        return auth()->user()->user_type == 'sd';
    }
    public function getIsPacAttribute()
    {
        return auth()->user()->user_type == 'pac';
    }

    public function getSexAttribute($value)
    {
        return $value == 'M' ? 'Male' : 'Female';
    }

    // public function sex_type_text($sex_type)
    // {
    //     $result = '';
    //     if ($sex_type == 'M') {
    //         $result = 'Male';
    //     }
    //     if ($sex_type == 'F') {
    //         $result = 'Female';
    //     }

    //     return $result;
    // }
    public function account_type_text($user_type)
    {
        $result = '';
        if ($user_type == 'admin') {
            $result = 'Adminstrator';
        }
        if ($user_type == 'counselor') {
            $result = 'Counselor';
        }
        if ($user_type == 'student') {
            $result = 'Student';
        }

        return $result;
    }
}
