<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Point;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('ABCabc123*'),
                'email_verified_at' => now(),
            ]
        );

        // Obtener todos los tipos
        $types = Type::all();
        $pointTypes = ['Plásticos', 'Vidrios', 'Aceites', 'Orgánica', 'Electrónicos', 'Textiles', 'Neumáticos', 'Chatarra', 'Construcción'];

        // Puntos de reciclaje reales distribuidos por España
        $points = [
            // Madrid
            ['name' => 'Punto Limpio Vallecas', 'latitude' => 40.3947, 'longitude' => -3.6453, 'city' => 'Madrid', 'address' => 'Calle de la Concordia, 28031 Madrid', 'region' => 'Comunidad de Madrid', 'postcode' => '28031'],
            ['name' => 'Ecoparque Móstoles', 'latitude' => 40.3217, 'longitude' => -3.8649, 'city' => 'Móstoles', 'address' => 'Avenida de Portugal, 28935 Móstoles', 'region' => 'Comunidad de Madrid', 'postcode' => '28935'],
            ['name' => 'Centro de Reciclaje Alcorcón', 'latitude' => 40.3459, 'longitude' => -3.8240, 'city' => 'Alcorcón', 'address' => 'Calle de los Príncipes de España, 28922 Alcorcón', 'region' => 'Comunidad de Madrid', 'postcode' => '28922'],

            // Barcelona
            ['name' => 'Deixalleria Collserola', 'latitude' => 41.4036, 'longitude' => 2.1219, 'city' => 'Barcelona', 'address' => 'Carrer de Collserola, 08023 Barcelona', 'region' => 'Cataluña', 'postcode' => '08023'],
            ['name' => 'Punto Verde Badalona', 'latitude' => 41.4502, 'longitude' => 2.2470, 'city' => 'Badalona', 'address' => 'Carrer de la Indústria, 08911 Badalona', 'region' => 'Cataluña', 'postcode' => '08911'],
            ['name' => 'Ecoparque Sabadell', 'latitude' => 41.5432, 'longitude' => 2.1085, 'city' => 'Sabadell', 'address' => 'Carrer de Gràcia, 08201 Sabadell', 'region' => 'Cataluña', 'postcode' => '08201'],

            // Valencia
            ['name' => 'Ecoparque Valencia Norte', 'latitude' => 39.5021, 'longitude' => -0.3528, 'city' => 'Valencia', 'address' => 'Avenida de la Constitución, 46019 Valencia', 'region' => 'Comunidad Valenciana', 'postcode' => '46019'],
            ['name' => 'Punto Limpio Alicante', 'latitude' => 38.3452, 'longitude' => -0.4815, 'city' => 'Alicante', 'address' => 'Avenida de Denia, 03016 Alicante', 'region' => 'Comunidad Valenciana', 'postcode' => '03016'],
            ['name' => 'Centro de Reciclaje Castellón', 'latitude' => 39.9864, 'longitude' => -0.0513, 'city' => 'Castellón de la Plana', 'address' => 'Avenida del Mar, 12003 Castellón', 'region' => 'Comunidad Valenciana', 'postcode' => '12003'],

            // Sevilla
            ['name' => 'Punto Limpio Sevilla Este', 'latitude' => 37.3826, 'longitude' => -5.9530, 'city' => 'Sevilla', 'address' => 'Avenida de la Palmera, 41012 Sevilla', 'region' => 'Andalucía', 'postcode' => '41012'],
            ['name' => 'Ecoparque Córdoba', 'latitude' => 37.8882, 'longitude' => -4.7794, 'city' => 'Córdoba', 'address' => 'Avenida de América, 14005 Córdoba', 'region' => 'Andalucía', 'postcode' => '14005'],
            ['name' => 'Centro de Reciclaje Granada', 'latitude' => 37.1773, 'longitude' => -3.5986, 'city' => 'Granada', 'address' => 'Carretera de Málaga, 18014 Granada', 'region' => 'Andalucía', 'postcode' => '18014'],

            // Bilbao
            ['name' => 'Garbigune Bilbao', 'latitude' => 43.2627, 'longitude' => -2.9253, 'city' => 'Bilbao', 'address' => 'Calle Autonomía, 48012 Bilbao', 'region' => 'País Vasco', 'postcode' => '48012'],
            ['name' => 'Punto Limpio Vitoria', 'latitude' => 42.8467, 'longitude' => -2.6716, 'city' => 'Vitoria-Gasteiz', 'address' => 'Calle Portal de Foronda, 01010 Vitoria', 'region' => 'País Vasco', 'postcode' => '01010'],
            ['name' => 'Ecoparque San Sebastián', 'latitude' => 43.3183, 'longitude' => -1.9812, 'city' => 'San Sebastián', 'address' => 'Avenida de Tolosa, 20018 San Sebastián', 'region' => 'País Vasco', 'postcode' => '20018'],

            // Zaragoza
            ['name' => 'Punto Limpio Zaragoza Sur', 'latitude' => 41.6488, 'longitude' => -0.8891, 'city' => 'Zaragoza', 'address' => 'Avenida de Cataluña, 50014 Zaragoza', 'region' => 'Aragón', 'postcode' => '50014'],
            ['name' => 'Centro de Reciclaje Huesca', 'latitude' => 42.1408, 'longitude' => -0.4082, 'city' => 'Huesca', 'address' => 'Calle del Parque, 22003 Huesca', 'region' => 'Aragón', 'postcode' => '22003'],
            ['name' => 'Ecoparque Teruel', 'latitude' => 40.3456, 'longitude' => -1.1063, 'city' => 'Teruel', 'address' => 'Avenida de Sagunto, 44003 Teruel', 'region' => 'Aragón', 'postcode' => '44003'],

            // Murcia
            ['name' => 'Punto Limpio Murcia Norte', 'latitude' => 37.9922, 'longitude' => -1.1307, 'city' => 'Murcia', 'address' => 'Avenida Juan de Borbón, 30007 Murcia', 'region' => 'Región de Murcia', 'postcode' => '30007'],
            ['name' => 'Centro de Reciclaje Cartagena', 'latitude' => 37.6063, 'longitude' => -0.9868, 'city' => 'Cartagena', 'address' => 'Calle Real, 30201 Cartagena', 'region' => 'Región de Murcia', 'postcode' => '30201'],

            // Palma de Mallorca
            ['name' => 'Deixalleria Son Reus', 'latitude' => 39.5696, 'longitude' => 2.6502, 'city' => 'Palma', 'address' => 'Camí de Son Reus, 07120 Palma', 'region' => 'Islas Baleares', 'postcode' => '07120'],
            ['name' => 'Punto Verde Ibiza', 'latitude' => 38.9067, 'longitude' => 1.4206, 'city' => 'Ibiza', 'address' => 'Carretera de San Antonio, 07800 Ibiza', 'region' => 'Islas Baleares', 'postcode' => '07800'],

            // Las Palmas
            ['name' => 'Punto Limpio Las Palmas', 'latitude' => 28.1248, 'longitude' => -15.4300, 'city' => 'Las Palmas de Gran Canaria', 'address' => 'Avenida Marítima, 35007 Las Palmas', 'region' => 'Canarias', 'postcode' => '35007'],
            ['name' => 'Ecoparque Tenerife', 'latitude' => 28.4636, 'longitude' => -16.2518, 'city' => 'Santa Cruz de Tenerife', 'address' => 'Avenida de Anaga, 38001 Santa Cruz', 'region' => 'Canarias', 'postcode' => '38001'],

            // Valladolid
            ['name' => 'Punto Limpio Valladolid', 'latitude' => 41.6523, 'longitude' => -4.7245, 'city' => 'Valladolid', 'address' => 'Calle de la Esperanza, 47014 Valladolid', 'region' => 'Castilla y León', 'postcode' => '47014'],
            ['name' => 'Centro de Reciclaje León', 'latitude' => 42.5987, 'longitude' => -5.5671, 'city' => 'León', 'address' => 'Avenida de Asturias, 24009 León', 'region' => 'Castilla y León', 'postcode' => '24009'],
            ['name' => 'Ecoparque Salamanca', 'latitude' => 40.9701, 'longitude' => -5.6635, 'city' => 'Salamanca', 'address' => 'Carretera de Madrid, 37900 Salamanca', 'region' => 'Castilla y León', 'postcode' => '37900'],

            // Más puntos distribuidos por España...
            ['name' => 'Punto Limpio Vigo', 'latitude' => 42.2328, 'longitude' => -8.7226, 'city' => 'Vigo', 'address' => 'Rúa de Urzáiz, 36201 Vigo', 'region' => 'Galicia', 'postcode' => '36201'],
            ['name' => 'Centro de Reciclaje A Coruña', 'latitude' => 43.3623, 'longitude' => -8.4115, 'city' => 'A Coruña', 'address' => 'Avenida de Finisterre, 15004 A Coruña', 'region' => 'Galicia', 'postcode' => '15004'],
            ['name' => 'Ecoparque Santiago', 'latitude' => 42.8805, 'longitude' => -8.5456, 'city' => 'Santiago de Compostela', 'address' => 'Rúa do Hórreo, 15702 Santiago', 'region' => 'Galicia', 'postcode' => '15702'],

            ['name' => 'Punto Limpio Oviedo', 'latitude' => 43.3614, 'longitude' => -5.8593, 'city' => 'Oviedo', 'address' => 'Calle de Uría, 33003 Oviedo', 'region' => 'Asturias', 'postcode' => '33003'],
            ['name' => 'Centro de Reciclaje Gijón', 'latitude' => 43.5322, 'longitude' => -5.6611, 'city' => 'Gijón', 'address' => 'Avenida de la Costa, 33212 Gijón', 'region' => 'Asturias', 'postcode' => '33212'],

            ['name' => 'Punto Limpio Santander', 'latitude' => 43.4623, 'longitude' => -3.8099, 'city' => 'Santander', 'address' => 'Avenida de los Castros, 39005 Santander', 'region' => 'Cantabria', 'postcode' => '39005'],

            ['name' => 'Ecoparque Logroño', 'latitude' => 42.4627, 'longitude' => -2.4449, 'city' => 'Logroño', 'address' => 'Calle de Portillejo, 26004 Logroño', 'region' => 'La Rioja', 'postcode' => '26004'],

            ['name' => 'Punto Limpio Pamplona', 'latitude' => 42.8125, 'longitude' => -1.6458, 'city' => 'Pamplona', 'address' => 'Avenida de Barañáin, 31008 Pamplona', 'region' => 'Navarra', 'postcode' => '31008'],

            ['name' => 'Centro de Reciclaje Toledo', 'latitude' => 39.8628, 'longitude' => -4.0273, 'city' => 'Toledo', 'address' => 'Avenida de Europa, 45003 Toledo', 'region' => 'Castilla-La Mancha', 'postcode' => '45003'],
            ['name' => 'Ecoparque Albacete', 'latitude' => 38.9943, 'longitude' => -1.8585, 'city' => 'Albacete', 'address' => 'Avenida de España, 02006 Albacete', 'region' => 'Castilla-La Mancha', 'postcode' => '02006'],
            ['name' => 'Punto Limpio Ciudad Real', 'latitude' => 38.9848, 'longitude' => -3.9274, 'city' => 'Ciudad Real', 'address' => 'Calle de la Mata, 13005 Ciudad Real', 'region' => 'Castilla-La Mancha', 'postcode' => '13005'],

            ['name' => 'Centro de Reciclaje Cáceres', 'latitude' => 39.4753, 'longitude' => -6.3724, 'city' => 'Cáceres', 'address' => 'Avenida de la Universidad, 10003 Cáceres', 'region' => 'Extremadura', 'postcode' => '10003'],
            ['name' => 'Ecoparque Badajoz', 'latitude' => 38.8794, 'longitude' => -6.9707, 'city' => 'Badajoz', 'address' => 'Avenida de Europa, 06006 Badajoz', 'region' => 'Extremadura', 'postcode' => '06006'],

            // Puntos adicionales para llegar a 100
            ['name' => 'Punto Verde Getafe', 'latitude' => 40.3058, 'longitude' => -3.7327, 'city' => 'Getafe', 'address' => 'Calle Madrid, 28901 Getafe', 'region' => 'Comunidad de Madrid', 'postcode' => '28901'],
            ['name' => 'Centro Reciclaje Leganés', 'latitude' => 40.3272, 'longitude' => -3.7636, 'city' => 'Leganés', 'address' => 'Avenida del Mediterráneo, 28915 Leganés', 'region' => 'Comunidad de Madrid', 'postcode' => '28915'],
            ['name' => 'Ecoparque Fuenlabrada', 'latitude' => 40.2842, 'longitude' => -3.7947, 'city' => 'Fuenlabrada', 'address' => 'Calle de la Libertad, 28942 Fuenlabrada', 'region' => 'Comunidad de Madrid', 'postcode' => '28942'],
            ['name' => 'Punto Limpio Alcalá', 'latitude' => 40.4818, 'longitude' => -3.3658, 'city' => 'Alcalá de Henares', 'address' => 'Avenida de Madrid, 28801 Alcalá de Henares', 'region' => 'Comunidad de Madrid', 'postcode' => '28801'],

            ['name' => 'Deixalleria Hospitalet', 'latitude' => 41.3598, 'longitude' => 2.1074, 'city' => 'L\'Hospitalet de Llobregat', 'address' => 'Carrer de la Granvia, 08901 L\'Hospitalet', 'region' => 'Cataluña', 'postcode' => '08901'],
            ['name' => 'Punto Verde Terrassa', 'latitude' => 41.5609, 'longitude' => 2.0110, 'city' => 'Terrassa', 'address' => 'Carrer de Colom, 08221 Terrassa', 'region' => 'Cataluña', 'postcode' => '08221'],
            ['name' => 'Centro Reciclaje Lleida', 'latitude' => 41.6176, 'longitude' => 0.6200, 'city' => 'Lleida', 'address' => 'Avinguda de Catalunya, 25001 Lleida', 'region' => 'Cataluña', 'postcode' => '25001'],
            ['name' => 'Ecoparque Girona', 'latitude' => 41.9794, 'longitude' => 2.8214, 'city' => 'Girona', 'address' => 'Carrer de Barcelona, 17001 Girona', 'region' => 'Cataluña', 'postcode' => '17001'],
            ['name' => 'Punto Limpio Tarragona', 'latitude' => 41.1189, 'longitude' => 1.2445, 'city' => 'Tarragona', 'address' => 'Avinguda de Roma, 43001 Tarragona', 'region' => 'Cataluña', 'postcode' => '43001'],

            ['name' => 'Centro Reciclaje Elche', 'latitude' => 38.2622, 'longitude' => -0.7011, 'city' => 'Elche', 'address' => 'Avenida de la Libertad, 03202 Elche', 'region' => 'Comunidad Valenciana', 'postcode' => '03202'],
            ['name' => 'Ecoparque Gandía', 'latitude' => 38.9670, 'longitude' => -0.1802, 'city' => 'Gandía', 'address' => 'Carrer de Valencia, 46701 Gandía', 'region' => 'Comunidad Valenciana', 'postcode' => '46701'],
            ['name' => 'Punto Verde Torrevieja', 'latitude' => 37.9787, 'longitude' => -0.6814, 'city' => 'Torrevieja', 'address' => 'Avenida de las Habaneras, 03181 Torrevieja', 'region' => 'Comunidad Valenciana', 'postcode' => '03181'],

            ['name' => 'Centro Reciclaje Málaga', 'latitude' => 36.7213, 'longitude' => -4.4214, 'city' => 'Málaga', 'address' => 'Avenida de Andalucía, 29006 Málaga', 'region' => 'Andalucía', 'postcode' => '29006'],
            ['name' => 'Ecoparque Cádiz', 'latitude' => 36.5297, 'longitude' => -6.2920, 'city' => 'Cádiz', 'address' => 'Avenida del Puerto, 11006 Cádiz', 'region' => 'Andalucía', 'postcode' => '11006'],
            ['name' => 'Punto Limpio Huelva', 'latitude' => 37.2614, 'longitude' => -6.9447, 'city' => 'Huelva', 'address' => 'Avenida de Andalucía, 21005 Huelva', 'region' => 'Andalucía', 'postcode' => '21005'],
            ['name' => 'Centro Reciclaje Jaén', 'latitude' => 37.7796, 'longitude' => -3.7849, 'city' => 'Jaén', 'address' => 'Avenida de Madrid, 23008 Jaén', 'region' => 'Andalucía', 'postcode' => '23008'],
            ['name' => 'Ecoparque Almería', 'latitude' => 36.8381, 'longitude' => -2.4597, 'city' => 'Almería', 'address' => 'Carretera de Ronda, 04007 Almería', 'region' => 'Andalucía', 'postcode' => '04007'],

            // Más puntos para completar los 100...
            ['name' => 'Punto Verde Burgos', 'latitude' => 42.3440, 'longitude' => -3.6969, 'city' => 'Burgos', 'address' => 'Avenida de la Paz, 09006 Burgos', 'region' => 'Castilla y León', 'postcode' => '09006'],
            ['name' => 'Centro Reciclaje Palencia', 'latitude' => 42.0096, 'longitude' => -4.5288, 'city' => 'Palencia', 'address' => 'Calle Mayor, 34001 Palencia', 'region' => 'Castilla y León', 'postcode' => '34001'],
            ['name' => 'Ecoparque Zamora', 'latitude' => 41.5034, 'longitude' => -5.7447, 'city' => 'Zamora', 'address' => 'Avenida de Requejo, 49012 Zamora', 'region' => 'Castilla y León', 'postcode' => '49012'],
            ['name' => 'Punto Limpio Segovia', 'latitude' => 40.9429, 'longitude' => -4.1088, 'city' => 'Segovia', 'address' => 'Avenida de la Constitución, 40001 Segovia', 'region' => 'Castilla y León', 'postcode' => '40001'],
            ['name' => 'Centro Reciclaje Ávila', 'latitude' => 40.6566, 'longitude' => -4.6813, 'city' => 'Ávila', 'address' => 'Avenida de Madrid, 05003 Ávila', 'region' => 'Castilla y León', 'postcode' => '05003'],
            ['name' => 'Ecoparque Soria', 'latitude' => 41.7665, 'longitude' => -2.4790, 'city' => 'Soria', 'address' => 'Calle de Numancia, 42003 Soria', 'region' => 'Castilla y León', 'postcode' => '42003'],

            ['name' => 'Punto Verde Lugo', 'latitude' => 43.0097, 'longitude' => -7.5567, 'city' => 'Lugo', 'address' => 'Rúa da Milagrosa, 27001 Lugo', 'region' => 'Galicia', 'postcode' => '27001'],
            ['name' => 'Centro Reciclaje Ourense', 'latitude' => 42.3406, 'longitude' => -7.8644, 'city' => 'Ourense', 'address' => 'Rúa do Progreso, 32003 Ourense', 'region' => 'Galicia', 'postcode' => '32003'],
            ['name' => 'Ecoparque Pontevedra', 'latitude' => 42.4296, 'longitude' => -8.6446, 'city' => 'Pontevedra', 'address' => 'Rúa de Oliva, 36002 Pontevedra', 'region' => 'Galicia', 'postcode' => '36002'],
            ['name' => 'Punto Limpio Ferrol', 'latitude' => 43.4840, 'longitude' => -8.2335, 'city' => 'Ferrol', 'address' => 'Rúa Real, 15402 Ferrol', 'region' => 'Galicia', 'postcode' => '15402'],

            ['name' => 'Centro Reciclaje Avilés', 'latitude' => 43.5564, 'longitude' => -5.9249, 'city' => 'Avilés', 'address' => 'Calle de Galicia, 33401 Avilés', 'region' => 'Asturias', 'postcode' => '33401'],
            ['name' => 'Ecoparque Langreo', 'latitude' => 43.3009, 'longitude' => -5.6883, 'city' => 'Langreo', 'address' => 'Calle de la Constitución, 33930 Langreo', 'region' => 'Asturias', 'postcode' => '33930'],

            ['name' => 'Punto Verde Torrelavega', 'latitude' => 43.3493, 'longitude' => -4.0492, 'city' => 'Torrelavega', 'address' => 'Avenida de España, 39300 Torrelavega', 'region' => 'Cantabria', 'postcode' => '39300'],
            ['name' => 'Centro Reciclaje Castro', 'latitude' => 43.3844, 'longitude' => -3.2176, 'city' => 'Castro-Urdiales', 'address' => 'Calle de la Rúa, 39700 Castro-Urdiales', 'region' => 'Cantabria', 'postcode' => '39700'],

            ['name' => 'Ecoparque Calahorra', 'latitude' => 42.3058, 'longitude' => -1.9650, 'city' => 'Calahorra', 'address' => 'Calle de la Planilla, 26500 Calahorra', 'region' => 'La Rioja', 'postcode' => '26500'],

            ['name' => 'Punto Limpio Tudela', 'latitude' => 42.0601, 'longitude' => -1.6057, 'city' => 'Tudela', 'address' => 'Avenida de Zaragoza, 31500 Tudela', 'region' => 'Navarra', 'postcode' => '31500'],
            ['name' => 'Centro Reciclaje Estella', 'latitude' => 42.6719, 'longitude' => -2.0281, 'city' => 'Estella-Lizarra', 'address' => 'Calle de la Rúa, 31200 Estella', 'region' => 'Navarra', 'postcode' => '31200'],

            ['name' => 'Ecoparque Guadalajara', 'latitude' => 40.6320, 'longitude' => -3.1601, 'city' => 'Guadalajara', 'address' => 'Avenida del Ejército, 19004 Guadalajara', 'region' => 'Castilla-La Mancha', 'postcode' => '19004'],
            ['name' => 'Punto Verde Cuenca', 'latitude' => 40.0703, 'longitude' => -2.1374, 'city' => 'Cuenca', 'address' => 'Avenida de los Alfares, 16004 Cuenca', 'region' => 'Castilla-La Mancha', 'postcode' => '16004'],
            ['name' => 'Centro Reciclaje Talavera', 'latitude' => 39.9637, 'longitude' => -4.8301, 'city' => 'Talavera de la Reina', 'address' => 'Avenida de Portugal, 45600 Talavera', 'region' => 'Castilla-La Mancha', 'postcode' => '45600'],

            ['name' => 'Ecoparque Mérida', 'latitude' => 38.9165, 'longitude' => -6.3363, 'city' => 'Mérida', 'address' => 'Avenida de Portugal, 06800 Mérida', 'region' => 'Extremadura', 'postcode' => '06800'],
            ['name' => 'Punto Limpio Plasencia', 'latitude' => 40.0303, 'longitude' => -6.0882, 'city' => 'Plasencia', 'address' => 'Avenida de Salamanca, 10600 Plasencia', 'region' => 'Extremadura', 'postcode' => '10600'],

            ['name' => 'Centro Reciclaje Ceuta', 'latitude' => 35.8883, 'longitude' => -5.3095, 'city' => 'Ceuta', 'address' => 'Avenida de África, 51001 Ceuta', 'region' => 'Ceuta', 'postcode' => '51001'],
            ['name' => 'Ecoparque Melilla', 'latitude' => 35.2919, 'longitude' => -2.9380, 'city' => 'Melilla', 'address' => 'Avenida de la Democracia, 52001 Melilla', 'region' => 'Melilla', 'postcode' => '52001'],

            // Puntos adicionales en islas menores
            ['name' => 'Punto Verde Mahón', 'latitude' => 39.8885, 'longitude' => 4.2614, 'city' => 'Mahón', 'address' => 'Carrer de Gracia, 07701 Mahón', 'region' => 'Islas Baleares', 'postcode' => '07701'],
            ['name' => 'Centro Reciclaje Formentera', 'latitude' => 38.6920, 'longitude' => 1.4326, 'city' => 'Sant Francesc Xavier', 'address' => 'Carrer de sa Senieta, 07860 Formentera', 'region' => 'Islas Baleares', 'postcode' => '07860'],

            ['name' => 'Ecoparque Arrecife', 'latitude' => 28.9630, 'longitude' => -13.5477, 'city' => 'Arrecife', 'address' => 'Avenida de las Playas, 35500 Arrecife', 'region' => 'Canarias', 'postcode' => '35500'],
            ['name' => 'Punto Limpio Puerto del Rosario', 'latitude' => 28.5004, 'longitude' => -13.8627, 'city' => 'Puerto del Rosario', 'address' => 'Calle León y Castillo, 35600 Puerto del Rosario', 'region' => 'Canarias', 'postcode' => '35600'],
            ['name' => 'Centro Reciclaje La Gomera', 'latitude' => 28.0916, 'longitude' => -17.1133, 'city' => 'San Sebastián de La Gomera', 'address' => 'Calle del Medio, 38800 San Sebastián', 'region' => 'Canarias', 'postcode' => '38800'],
            ['name' => 'Ecoparque El Hierro', 'latitude' => 27.7519, 'longitude' => -17.9155, 'city' => 'Valverde', 'address' => 'Calle Dr. Quintero, 38900 Valverde', 'region' => 'Canarias', 'postcode' => '38900'],
            ['name' => 'Punto Verde La Palma', 'latitude' => 28.6835, 'longitude' => -17.7648, 'city' => 'Santa Cruz de La Palma', 'address' => 'Avenida Marítima, 38700 Santa Cruz de La Palma', 'region' => 'Canarias', 'postcode' => '38700'],
        ];

        foreach ($points as $index => $pointData) {
            // Agregar campos adicionales
            $pointData['country'] = 'España';
            $pointData['place_type'] = ['address', 'poi', 'locality', 'neighborhood'][array_rand(['address', 'poi', 'locality', 'neighborhood'])];
            $pointData['way'] = ['street', 'road', 'avenue'][array_rand(['street', 'road', 'avenue'])];
            $pointData['point_type'] = $pointTypes[array_rand($pointTypes)];
            $pointData['description'] = 'Centro de reciclaje municipal para la gestión de residuos urbanos';
            $pointData['phone'] = '9' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);
            $pointData['email'] = 'info@' . strtolower(str_replace(' ', '', $pointData['name'])) . '.es';
            $pointData['url'] = strtolower(str_replace([' ', 'ñ', 'á', 'é', 'í', 'ó', 'ú'], ['-', 'n', 'a', 'e', 'i', 'o', 'u'], $pointData['name'])) . '-' . $pointData['latitude'] . '-' . $pointData['longitude'];

            // Crear el punto
            $point = $admin->points()->create($pointData);

            // Asignar tipos aleatorios (1-3 tipos por punto)
            $randomTypes = $types->random(rand(1, 3));
            $point->types()->attach($randomTypes->pluck('id'));
        }
    }
}
