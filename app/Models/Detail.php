<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'details';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'beds',
        'wifi',
        'guests',
        'bedrooms',
        'toilets',
        'pool',
        'house_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at' 
    ];

    public static function set($beds, $wifi, $guests, $bedrooms, $toilets, $pool, $house_id){
        $create = [
            'beds' => $beds,
            'wifi' => $wifi,
            'guests' => $guests,
            'bedrooms' => $bedrooms,
            'toilets' => $toilets,
            'pool' => $pool,
            'house_id' => $house_id

        ];
        return self::create($create);
    }

    //Relación muchos a uno
    public function house(){
        return $this->belongsTo(House::class);
    }
}
