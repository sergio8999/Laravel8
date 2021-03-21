<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Poner los campos que queremos que se guarden
    /* protected $fillable =['name','description','price']; */

    //Campos que queremos que esten protegidos
    protected $guarded = [];

    // url mostradas por slug y no por id
    /* public function getRouteKeyName()
    {
        return 'slug';
    } */
}
