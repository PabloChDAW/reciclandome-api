<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Camiseta ecológica',
            'description' => 'Camiseta hecha con materiales sostenibles y respetuosos con el medio ambiente.',
            'price' => 25.00,
            'stock' => 6,
            'image' => 'https://i.etsystatic.com/49697611/r/il/cf22e1/5764600518/il_fullxfull.5764600518_jqla.jpg',
        ]);

        Product::create([
            'name' => 'Botella de acero inox. reutilizable',
            'description' => 'Botella reutilizable de acero inoxidable, ideal para reducir el uso de plásticos.',
            'price' => 12.00,
            'stock' => 28,
            'image' => 'https://www.grupobillingham.com/images/31/17/2dc4b7a13150e95f6589ac620374/1024-768-6/0.jpg',
        ]);

        Product::create([
            'name' => 'Botón de plástico reciclado verde (unidad)',
            'description' => 'Botón fabricado a partir de plástico 100% reciclado, en color verde. Ideal para proyectos de costura sostenibles, reparación de prendas o manualidades. Ligero, resistente y respetuoso con el medio ambiente. Se vende por unidad.',
            'price' => 0.01,
            'stock' => 100,
            'image' => 'https://www.tessiland.com/42590/boton-reciclado-save-30-verde-1pz.jpg'
        ]);
        
        Product::create([
            'name' => 'Bolsa reutilizable algodón',
            'description' => 'Bolsa ecológica de algodón reutilizable. Ideal para hacer la compra, almacenar productos o reducir el uso de bolsas plásticas. Resistente, ligera y 100% sostenible.',
            'price' => 7.99,
            'stock' => 0,
            'image' => 'https://www.retif.es/media/catalog/product/5/0/501141_Retif_PH_01.jpg?quality=80&bg-color=255,255,255&fit=bounds&height=864&width=864&canvas=864:864',
        ]);
    }
}
