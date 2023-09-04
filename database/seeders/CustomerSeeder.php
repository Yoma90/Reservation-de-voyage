<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Customer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            'id' => 1,
            'first_name' => 'Blaise',
            'last_name' => 'Elovie',
            'user_name' => 'Elovie100',
            'email' => 'kempes90@gmail.com',
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('customers')->insert([
            'id' => 2,
            'first_name' => 'Kempes',
            'last_name' => 'Blaise',
            'user_name' => 'Kempes90',
            'email' => 'kempes@gmail.com',
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
