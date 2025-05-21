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

        Product::create([
            'name' => 'Botón de plástico reciclado azul (unidad)',
            'description' => 'Botón fabricado a partir de plástico 100% reciclado, en color azul. Ideal para proyectos de costura sostenibles, reparación de prendas o manualidades. Ligero, resistente y respetuoso con el medio ambiente. Se vende por unidad.',
            'price' => 0.41,
            'stock' => 60,
            'image' => 'https://thumbs.dreamstime.com/b/bot%C3%B3n-azul-129081681.jpg'
        ]);

        Product::create([
            'name' => 'Botón de plástico reciclado amarillo (unidad)',
            'description' => 'Botón fabricado a partir de plástico 100% reciclado, en color amarillo. Ideal para proyectos de costura sostenibles, reparación de prendas o manualidades. Ligero, resistente y respetuoso con el medio ambiente. Se vende por unidad.',
            'price' => 0.71,
            'stock' => 70,
            'image' => 'https://img.freepik.com/vector-premium/boton-amarillo_311865-9637.jpg'
        ]);


        Product::create([
            'name' => 'Lámpara de madera reciclada',
            'description' => 'Lámpara de mesa fabricada con madera reciclada, aportando calidez y estilo rústico a tu hogar. Cada pieza es única y sostenible.',
            'price' => 29.99,
            'stock' => 25,
            'image' => 'https://d.media.kavehome.com/image/upload/w_900,c_fill,ar_0.8,g_auto,f_auto/v1709568129/products/EA331FN39_1V01.jpg'
        ]);


        Product::create([
            'name' => 'Lámpara de latas recicladas',
            'description' => 'Lámpara artesanal elaborada a partir de latas de aluminio recicladas. Su diseño único y ecológico aporta un toque industrial y sostenible a cualquier espacio. Ideal para decoración de interiores modernos.',
            'price' => 25.99,
            'stock' => 50,
            'image' => 'https://www.handfie.com/wp-content/uploads/2018/01/Lampara_lata_Reciclada.jpg'
        ]);

        Product::create([
            'name' => 'Maceta con botella de plástico reciclada',
            'description' => 'Maceta creativa realizada a partir de botellas de plástico recicladas. Perfecta para cultivar pequeñas plantas o hierbas en espacios reducidos. Contribuye al reciclaje y embellece tu hogar.',
            'price' => 4.50,
            'stock' => 100,
            'image' => 'https://www.residuosprofesional.com/wp-content/uploads/2022/05/Villavicencio.jpg'
        ]);

        Product::create([
            'name' => 'Alfombra reciclada',
            'description' => 'Alfombra tejida a mano utilizando tiras de camisetas recicladas. Suave al tacto y resistente, ideal para interiores con estilo bohemio y sostenible.',
            'price' => 19.99,
            'stock' => 30,
            'image' => 'https://img.freepik.com/fotos-premium/2358-alfombra-negra-aislada-sobre-fondo-transparente_1049953-2515.jpg?semt=ais_hybrid&w=740'
        ]);

        Product::create([
            'name' => 'Espejo reciclado',
            'description' => 'Espejo decorativo fabricado con CDs reciclados, creando un efecto visual único. Aporta un toque moderno y ecológico a tu hogar.',
            'price' => 15.00,
            'stock' => 40,
            'image' => 'https://img.freepik.com/fotos-premium/espejo-maquillaje-moderno-aislado-sobre-fondo-blanco_627429-8.jpg'
        ]);

        Product::create([
            'name' => 'Caja de cartón reciclado',
            'description' => 'Caja multifuncional hecho de cartón reciclado, ideal para mantener ordenados tus objetos personales en el hogar o la oficina.',
            'price' => 7.99,
            'stock' => 60,
            'image' => 'https://avatarenergia.com/wp-content/uploads/2018/09/reciclaje-de-cart%C3%B3n.jpg'
        ]);
    }
}
