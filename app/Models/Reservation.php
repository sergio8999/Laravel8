<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'reservations';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'arrivalDay',
        'departureDay',
        'arrivalTime',
        'departureTime',
        'taxes',
        'subtotal',
        'total',
        'user_id',
        'house_id'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at' 
    ];

    public static function set($arrivalDay, $departureDay, $arrivalTime, $departureTime, $taxes, $subtotal, $total, $user_id, $house_id){
        $create = [
            'arrivalDay' => $arrivalDay,
            'departureDay' => $departureDay,
            'arrivalTime' => $arrivalTime,
            'departureTime' => $departureTime,
            'taxes' => $taxes,
            'subtotal' => $subtotal,
            'total' => $total,
            'user_id' => $user_id,
            'house_id' => $house_id
        ];
        return self::create($create);
    }

    //Relación uno a muchos (inversa)
    public function house(){
        return $this->belongsTo(House::class);
    }

    //Relación uno a muchos (inversa)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
