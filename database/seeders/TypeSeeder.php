<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Plásticos',
                'description' => 'Envases de plástico, botellas, bolsas y otros materiales plásticos',
                'icon' => '♻️'
            ],
            [
                'name' => 'Vidrios',
                'description' => 'Botellas de vidrio, frascos y otros envases de cristal',
                'icon' => '🍾'
            ],
            [
                'name' => 'Aceites',
                'description' => 'Aceites usados de cocina y aceites industriales',
                'icon' => '🛢️'
            ],
            [
                'name' => 'Orgánica',
                'description' => 'Residuos orgánicos, restos de comida y material biodegradable',
                'icon' => '🥬'
            ],
            [
                'name' => 'Electrónicos',
                'description' => 'Dispositivos electrónicos, móviles, ordenadores y electrodomésticos',
                'icon' => '📱'
            ],
            [
                'name' => 'Textiles',
                'description' => 'Ropa, zapatos, telas y otros materiales textiles',
                'icon' => '👕'
            ],
            [
                'name' => 'Neumáticos',
                'description' => 'Neumáticos usados de vehículos',
                'icon' => '🛞'
            ],
            [
                'name' => 'Chatarra',
                'description' => 'Metales, hierro, aluminio y otros materiales metálicos',
                'icon' => '🔩'
            ],
            [
                'name' => 'Construcción',
                'description' => 'Escombros, materiales de construcción y demolición',
                'icon' => '🧱'
            ]
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
