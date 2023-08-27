<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'admin',
            'last_name' => 'super',
            'user_name' => 'Admin90',
            'email' => 'kempes@gmail.com',
            'password' => Hash::make('secret'),
            'phone' => '658288757',
            'location' => 'Yaoundé',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'first_name' => 'kempes',
            'last_name' => 'blaise',
            'user_name' => 'kempes90',
            'email' => 'kempes90@gmail.com',
            'password' => Hash::make('123456789'),
            'phone' => '658288757',
            'location' => 'Yaoundé',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('customers')->insert([
            'id' => 1,
            'first_name' => 'Kempes',
            'last_name' => 'Blaise',
            'user_name' => 'Kempes90',
            'email' => 'kempes@gmail.com',
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('managers')->insert([
            'id' => 1,
            'first_name' => 'Miendjem',
            'last_name' => 'Thierry',
            'email' => 'Miendjemthierry01@gmail.com',
            'password' => Hash::make('123456789'),
            'phone'=> '654894523',
            'agency' => 'Finexx',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('managers')->insert([
            'id' => 2,
            'first_name' => 'MIT',
            'last_name' => 'Idris',
            'email' => 'thierry01@gmail.com',
            'password' => Hash::make('123456789'),
            'phone'=> '654894523',
            'agency' => 'Global',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
