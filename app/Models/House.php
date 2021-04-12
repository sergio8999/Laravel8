<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'houses';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'host',
        'url',
        'price',
        'description'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at' 
    ];

    public static function set($name, $host, $url, $price, $description){
        $create = [
            'name' => $name,
            'host' => $host,
            'url' => $url,
            'price' => $price,
            'description' => $description
        ];
        return self::create($create);
    }

    //Relación uno a muchos
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
