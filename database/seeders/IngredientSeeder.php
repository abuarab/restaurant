<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::create([
            'id'                => 1,
            'name'              => 'Beef',
            'measure_id'        => 1,
            'original_value'    => 20,
            'stock_value'       => 20,
        ]);
        Ingredient::create([
            'id'                => 2,
            'name'              => 'Cheese',
            'measure_id'        => 1,
            'original_value'    => 5,
            'stock_value'       => 5,
        ]);
        Ingredient::create([
            'id'                => 3,
            'name'              => 'Onion',
            'measure_id'        => 1,
            'original_value'    => 1,
            'stock_value'       => 1,
        ]);
    }
}
