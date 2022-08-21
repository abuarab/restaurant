<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'         => 1,
            'first_name' => Str::random(10),
            'last_name'  => Str::random(10),
            'email'      => 'admin@restaurant.com',
            'role'       => 'admin',
            'password'   => Hash::make('password'),
        ]);

        User::create([
            'id'         => 2,
            'first_name' => Str::random(10),
            'last_name'  => Str::random(10),
            'email'      => 'client@restaurant.com',
            'role'       => 'client',
            'password'   => Hash::make('password'),
        ]);
    }
}
