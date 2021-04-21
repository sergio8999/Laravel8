<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'houses';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'host',
        'url',
        'price',
        'url',
        'description',
        'category_id',
        'location_id'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at' 
    ];

    public static function set($name, $host, $price, $url, $description, $category_id, $location_id){
        $create = [
            'name' => $name,
            'host' => $host,
            'price' => $price,
            'url' =>$url,
            'description' => $description,
            'category_id' => $category_id,
            'location_id' => $location_id
        ];
        return self::create($create);
    }

    //Relación uno a muchos
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function images(){
        return $this->hasMany(House_Images::class);
    }

    public function details(){
        return $this->hasOne(House_Detail::class);
    }

    //Relación muchos a uno
    public function category(){
        return $this->belongsTo(Category::class);
    }
 
    public function location(){
        return $this->belongsTo(Location::class);
    }
}
