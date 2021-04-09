<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    //Relación uno a muchos
    public function reservations(){
        return $this->hasMany(House::class);
    }
}
