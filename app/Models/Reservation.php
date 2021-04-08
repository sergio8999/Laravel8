<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

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
        'house_id'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function set($arrivalDay, $departureDay, $arrivalTime, $departureTime, $taxes, $subtotal, $total, $house_id){
        $create = [
            'arrivalDay' => $arrivalDay,
            'departureDay' => $departureDay,
            'arrivalTime' => $arrivalTime,
            'departureTime' => $departureTime,
            'taxes' => $taxes,
            'subtotal' => $subtotal,
            'total' => $total,
            'house_id' => $house_id
        ];
        return self::create($create);
    }

    //Relación uno a muchos (inversa)
    public function house(){
        return $this->belongsTo(Reservation::class);
    }
}
