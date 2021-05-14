<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Administrador extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'administradors';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'password'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function set($name, $password){
        $create = [
            'name' => $name,
            'password' => bcrypt($password)
        ];
        return self::create($create);
    }
}
