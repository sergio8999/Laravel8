<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory,HasApiTokens,SoftDeletes;

    protected $table = 'admins';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guard = 'admin';

    protected $fillable = [
        'email',
        'password'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'remember_token', 
    ];

    public static function set($name, $password){
        $create = [
            'email' => $name,
            'password' => bcrypt($password)
        ];
        return self::create($create);
    }
}
