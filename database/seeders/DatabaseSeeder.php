<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Detail;
use App\Models\House;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Para version Laravel 8, no hay que crear un seeders para cada modelo
        /* Product::factory(20)->create(); */

        // Localizacion
        Location::set('Granada');
        Location::set('Almuñecar');
        Location::set('Madrid');
        Location::set('Marbella');
        
        // Categorias
        Category::set('Alojamientos enteros');
        Category::set('Alojamientos únicos');
        Category::set('Granjas y naturaleza');
        Category::set('Por mascotas');
        
        // Casas
        House::set('Estudio moderno en el centro de Granada','Alejandro','imagen1.webp','2','Confortable, hogareño y funcional estudio Ideal para disfrutar de su estancia en pleno corazón de Granada. Se encuentra en edificio en el centro de Granada. Localizado en Puerta Real, donde se encuentran los lugares más emblemáticos de la ciudad.','1','1');
        House::set('La Bolina is a unique experience','Timsam','imagen2.webp','3','Construido, decorado y amueblado por un escultor y su esposa pintora con gran atención al detalle. Una piscina infinita da a través del valle al pueblo blanco de Frigiliana descansando en la base de las montañas de Almijara y la reserva natural.','2','2');
        
        // Detalles
        Detail::set('3','true','4','2','1','false','1');
        Detail::set('2','true','3','2','1','true','2');
    }
}
