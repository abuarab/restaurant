<?php

namespace Database\Seeders;

use App\Models\ProductIngredient;
use Illuminate\Database\Seeder;

class ProductIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ProductIngredient::create([
            'id'                     => 1,
            'product_id'             => 1,
            'ingredient_id'          => 1,
            'ingredient_measure_id'  => 2,
            'ingredient_value'       => 150,
        ]);
        ProductIngredient::create([
            'id'                     => 2,
            'product_id'             => 1,
            'ingredient_id'          => 2,
            'ingredient_measure_id'  => 2,
            'ingredient_value'       => 30,
        ]);
        ProductIngredient::create([
            'id'                     => 3,
            'product_id'             => 1,
            'ingredient_id'          => 3,
            'ingredient_measure_id'  => 2,
            'ingredient_value'       => 20,
        ]);
    }
}
