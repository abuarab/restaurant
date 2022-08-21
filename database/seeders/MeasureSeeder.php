<?php

namespace Database\Seeders;

use App\Models\Measure;
use Illuminate\Database\Seeder;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Measure::create([
            'id'    => 1,
            'name'  => 'KG',
        ]);

        Measure::create([
            'id'    => 2,
            'name' => 'G',
        ]);
    }
}
