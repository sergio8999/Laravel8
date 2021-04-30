<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use HasFactory,SoftDeletes;

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
        'deleted_at' 
    ];

    public static function set($name, $password){
        $create = [
            'name' => $name,
            'password' => bcrypt($password)
        ];
        return self::create($create);
    }
}
