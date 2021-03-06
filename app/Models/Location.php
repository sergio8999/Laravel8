<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'locations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'abbreviation',
        'cod'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at' 
    ];

    public static function set($name, $abbrebiation, $cod){
        $create = [
            'name' => $name,
            'abbreviation' => $abbrebiation,
            'cod' => $cod
        ];
        return self::create($create);
    }

    // Relación uno a muchos
    public function houses(){
        return $this->hasMany(House::class);
    }
}
