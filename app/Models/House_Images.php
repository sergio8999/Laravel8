<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House_Images extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'house_images';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at' 
    ];

    public static function set($url, $house_id){
        $create = [
            'url' => $url,
            'house_id' =>$house_id

        ];
        return self::create($create);
    }

    //Relación muchos a uno
    public function House(){
        return $this->belongsTo(House::class);
    }
}
