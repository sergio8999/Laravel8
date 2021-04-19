<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Detail;
use App\Models\House;
use App\Models\House_Detail;
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
        
        Location::set('Álava','Ál.','ES-VI');
        Location::set('Albacete','Alb.','ES-AB');
        Location::set('Alicante', 'Alc.', 'ES-A');
        Location::set('Almería', 'Alm.', 'ES-AL');
        Location::set('Asturias', 'Ast.', 'ES-O');
        Location::set('Ávila', 'Áv.', 'ES-AV');
        Location::set('Badajoz', 'Bad.', 'ES-BA');
        Location::set('Baleares / Balears',	'Bal.',	'ES-PM');
        Location::set('Barcelona', 'Barna.', 'ES-B');
        Location::set('Burgos', 'Burg.', 'ES-BU');
        Location::set('Cáceres', 'Các.', 'ES-CC');
        Location::set('Cádiz', 'Cád.', 'ES-CA');
        Location::set('Cantabria', 'Cantb.', 'ES-S');
        Location::set('Castellón / Castelló', 'Cs., Cast.',	'ES-CS');
        Location::set('Ciudad Real', 'C. Real', 'ES-CR');
        Location::set('Córdoba', 'Córd.', 'ES-CO');
        Location::set('Cuenca', 'Cuen.', 'ES-CU');
        Location::set('Gerona / Girona','–', 'ES-GI');
        Location::set('Granada', 'Gran.', 'ES-GR');
        Location::set('Guadalajara', 'Guad.', 'ES-GU');
        Location::set('Guipúzcoa / Gipuzkoa', 'Guip.', 'ES-SS');
        Location::set('Huelva', 'Huel.', 'ES-H');
        Location::set('Huesca', 'Hues.', 'ES-HU');
        Location::set('Jaén', '–', 'ES-J');
        Location::set('La Coruña / A Coruña', '–', 'ES-C');
        Location::set('La Rioja', '–', 'ES-LO');
        Location::set('Las Palmas', '–', 'ES-GC');
        Location::set('León', '–', 'ES-LE');
        Location::set('Lérida / Lleida', 'Lér.', 'ES-L');
        Location::set('Lugo', '–', 'ES-LU');
        Location::set('Madrid', 'Mad.', 'ES-M');
        Location::set('Málaga', 'Mál.', 'ES-MA');
        Location::set('Murcia', 'Mur.', 'ES-MU');
        Location::set('Navarra', 'Nav.', 'ES-NA');
        Location::set('Orense / Ourense', '–', 'ES-OR');
        Location::set('Palencia', 'Pal.', 'ES-P');
        Location::set('Pontevedra', '–', 'ES-PO');
        Location::set('Salamanca', 'Sal.', 'ES-SA');
        Location::set('Santa Cruz de Tenerife', '–', 'ES-TF');
        Location::set('Segovia', 'Seg.', 'ES-SG');
        Location::set('Sevilla', 'Sev.', 'ES-SE');
        Location::set('Soria', 'Sor.', 'ES-SO');
        Location::set('Tarragona', '–', 'ES-T');
        Location::set('Teruel', 'Ter.', 'ES-TE');
        Location::set('Toledo',	'Tol.',	'ES-TO');
        Location::set('Valencia / València', 'Val.', 'ES-V');
        Location::set('Valladolid',	'Vall.', 'ES-VA');
        Location::set('Vizcaya / Bizkaia', 'Vizc.', 'ES-BI');
        Location::set('Zamora', 'Zam.',	'ES-ZA');
        Location::set('Zaragoza', 'Zar.', 'ES-Z');

        
        /* Location::set('Madrid');
        Location::set('Marbella');
        Location::set('Oporto'); */
        
        // Categorias
        Category::set('Alojamientos enteros','alojamientosEnteros.jpg');
        Category::set('Alojamientos únicos','alojamientosUnicos.jpg');
        Category::set('Granjas y naturaleza','granjasNaturaleza.jpg');
        Category::set('Por mascotas','mascotas.jpg');
        
        // Casas
        House::set('Estudio moderno en el centro de Granada','Alejandro','imagen1.webp','2','Confortable, hogareño y funcional estudio Ideal para disfrutar de su estancia en pleno corazón de Granada. Se encuentra en edificio en el centro de Granada. Localizado en Puerta Real, donde se encuentran los lugares más emblemáticos de la ciudad.','2','1');
        House::set('La Bolina is a unique experience','Timsam','imagen2.webp','3','Construido, decorado y amueblado por un escultor y su esposa pintora con gran atención al detalle. Una piscina infinita da a través del valle al pueblo blanco de Frigiliana descansando en la base de las montañas de Almijara y la reserva natural.','1','2');
        House::set('Cabaña LovelyMemories','LovelyMemories','imagen3.jpg','4','Paraíso significa Paraíso en portugués. Nuestra propiedad está situada en Paradise Street y no podría ser mejor, ya que Paraiso 331 es realmente un paraíso en el centro de la ciudad de Oporto, a sólo 10 minutos a pie del centro de la ciudad.','3','5');
        House::set('Studio Maisonnette à 100m de la Plage à Biarritz','Pierre','imagen4.jpg','2','Casa unifamiliar a 100 m de la playa (a poca distancia) de Milady, Ilbarritz Golf, Thalasso Thalmar. Terraza privada de madera con muebles de jardín (pequeños) animales domésticos bienvenidos... bajo petición ','4','4');

        // Detalles
        House_Detail::set('3','true','4','2','1','false','1');
        House_Detail::set('2','true','3','2','1','true','2');
        House_Detail::set('1','true','2','1','1','false','3');
        House_Detail::set('1','true','2','1','1','false','4');
    }
}
