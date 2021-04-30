<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Category;
use App\Models\House;
use App\Models\House_Detail;
use App\Models\House_Images;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\User;
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
        House::set('Estudio moderno en el centro de Granada','Alejandro','2','casa1i1.jpg','Confortable, hogareño y funcional estudio Ideal para disfrutar de su estancia en pleno corazón de Granada. Se encuentra en edificio en el centro de Granada. Localizado en Puerta Real, donde se encuentran los lugares más emblemáticos de la ciudad.','2','1');
        House::set('La Bolina is a unique experience','Timsam','3','casa2i1.jpg','Construido, decorado y amueblado por un escultor y su esposa pintora con gran atención al detalle. Una piscina infinita da a través del valle al pueblo blanco de Frigiliana descansando en la base de las montañas de Almijara y la reserva natural.','1','2');
        House::set('Cabaña LovelyMemories','LovelyMemories','4', 'casa3i1.jpg','Paraíso significa Paraíso en portugués. Nuestra propiedad está situada en Paradise Street y no podría ser mejor, ya que Paraiso 331 es realmente un paraíso en el centro de la ciudad de Oporto, a sólo 10 minutos a pie del centro de la ciudad.','3','5');
        House::set('Studio Maisonnette à 100m de la Plage à Biarritz','Pierre','2', 'casa4i1.jpg','Casa unifamiliar a 100 m de la playa (a poca distancia) de Milady, Ilbarritz Golf, Thalasso Thalmar. Terraza privada de madera con muebles de jardín (pequeños) animales domésticos bienvenidos... bajo petición ','1','4');
        House::set('Villa patio next to the beach Seignosse / Hossegor','Antho','2.5','casa5i1.jpg','A 5 minutos a pie del surf world cup spot "les Bourdaines", la casa está idealmente ubicada : se puede hacer todo caminando y la zona está tranquila. Tiendas, mercado y restaurantes estarán en "Les Penons", a 10 minutos a pie.','1','3');
        House::set('Deauville en toute simplicité','Alexandre','3','casa6i1.jpg','Acogedora casa de 75 m2, totalmente reformada, con jardín, salón con chimenea, comedor en terraza y 3 dormitorios. Se encuentra en Deauville, en un barrio tranquilo donde se puede aparcar fácilmente y de forma gratuita en la calle (apreciable durante las vacaciones). Disfruta de un sol precioso.','1','6');
        House::set('Casita en los montes de Robledo de Chavela','Cesar','3','casa7i1.jpg','Un pequeño refugio donde la paz esta asegurada, rodeado de montes y naturaleza en estado puro. Con una decoracion rustica y muy acogedora.','2','10');
        House::set('Private domed Copula','Karina','4','casa8i1.jpg','Aproveche la oportunidad de permanecer en esta cópula abovedada increíble y muy bien ubicada. La cópula se encuentra dentro de un refugio de caballos, lo que la convierte en una experiencia verdaderamente mágica para cualquiera que se quede aquí.','2','23');
        House::set('Chalet con piscina','Ana','4','casa9i1.jpg','Disfruta de un jardín precioso y con piscina y una casa acogedora en un entorno tranquilo como es la urbanización Cerro de Alarcón I. La casa está muy cercana a un pantano con vistas y a la parada del autobús para ir a Madrid o al pueblo de Valdemorillo','3','31');
        House::set('Via Fera','Pedro','3.5','casa10i1.jpg','Espacio rural aislado con capacidad para 2/3 personas, con un jardín silvestre de 1.000 metros cuadrados y un mirador-cenador sobre el valle del río Lozoya. Situado en una antigua granja ganadera','3','40');
        House::set('Studio Seignosse Océan','Remi','2.2','casa11i1.jpg','Es un estudio cómodo y funcional. Se beneficia de calefacción central por lo que el apartamento es cálido incluso en invierno. Hay una cama doble en un armario que se despliega y se pliega según la hora del día, y un sofá cama.','4','22');

        // Imagenes
        House_Images::set('casa1i2.jpg',1);
        House_Images::set('casa1i3.jpg',1);
        House_Images::set('casa1i4.jpg',1);
        House_Images::set('casa2i2.jpg',2);
        House_Images::set('casa2i3.jpg',2);
        House_Images::set('casa2i4.jpg',2);
        House_Images::set('casa3i2.jpg',3);
        House_Images::set('casa3i3.jpg',3);
        House_Images::set('casa3i4.jpg',3);
        House_Images::set('casa4i2.jpg',4);
        House_Images::set('casa5i2.jpg',5);
        House_Images::set('casa5i3.jpg',5);
        House_Images::set('casa5i4.jpg',5);
        House_Images::set('casa6i2.jpg',6);
        House_Images::set('casa6i3.jpg',6);
        House_Images::set('casa6i4.jpg',6);
        House_Images::set('casa7i2.jpg',7);
        House_Images::set('casa7i3.jpg',7);
        House_Images::set('casa7i4.jpg',7);
        House_Images::set('casa8i2.jpg',8);
        House_Images::set('casa8i3.jpg',8);
        House_Images::set('casa8i4.jpg',8);
        House_Images::set('casa8i5.jpg',8);
        House_Images::set('casa9i2.jpg',9);
        House_Images::set('casa9i3.jpg',9);
        House_Images::set('casa10i2.jpg',10);
        House_Images::set('casa10i3.jpg',10);
        House_Images::set('casa10i4.jpg',10);
        House_Images::set('casa11i2.jpg',11);
        House_Images::set('casa11i3.jpg',11);

        // Detalles
        House_Detail::set('3','true','4','2','1','false','1');
        House_Detail::set('2','true','3','2','1','true','2');
        House_Detail::set('1','true','2','1','1','false','3');
        House_Detail::set('1','true','2','1','1','false','4');
        House_Detail::set('3','true','6','2','1','false','5');
        House_Detail::set('5','true','6','3','2','false','6');
        House_Detail::set('1','false','2','1','1','true','7');
        House_Detail::set('2','false','3','1','1','false','8');
        House_Detail::set('3','true','4','4','2','true','9');
        House_Detail::set('1','false','2','1','1','false','10');
        House_Detail::set('2','false','4','2','1','false','11');

        // Usuario
        User::set('Sergio','sergio8999@gmail.com','1234');
        
        // Reservas
        Reservation::set('28/04/2021','30/04/2021','0:00','0:00','10.56','105.6','116.16','1','11');
        Reservation::set('06/05/2021','07/05/2021','0:00','0:00','5.28','52.8','58.08','1','11');
        Reservation::set('07/05/2021','08/05/2021','0:00','0:00','5.28','52.8','58.08','1','11');
        Reservation::set('30/04/2021','08/05/2021','0:00','03:00','1.05','10.5','11.55','1','10');

        // Administrador
        Administrador::set('sergio','1234');
    }
}
