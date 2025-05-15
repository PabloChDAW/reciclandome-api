<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Product::create([
            'name' => 'Camiseta ecológica',
            'description' => 'Camiseta hecha con materiales sostenibles y respetuosos con el medio ambiente.',
            'price' => 25.00,
            'stock' => 6,
            'image' => 'https://i.etsystatic.com/49697611/r/il/cf22e1/5764600518/il_fullxfull.5764600518_jqla.jpg'
        ]);

        Product::create([
            'name' => 'Botella de acero inox. reutilizable',
            'description' => 'Botella reutilizable de acero inoxidable, ideal para reducir el uso de plásticos.',
            'price' => 12.00,
            'stock' => 28,
            'image' => 'https://www.grupobillingham.com/images/31/17/2dc4b7a13150e95f6589ac620374/1024-768-6/0.jpg',
        ]);
        
    }
}
