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
        DB::table('types')->insert([
            'id' => 1,
            'name' => 'VIP',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('types')->insert([
            'id' => 2,
            'name' => 'CLASSIQUE',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'System administrator',
            'description' => 'This is the System administrator and can do any thing in the application',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Manager',
            'description' => 'This is the Manager and can\'t do any thing in the application',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Receptory',
            'description' => 'This receptory confirm the ticket of a customer who boocked a ticket in mobile app',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'email' => 'kempes@gmail.com',
            'password' => Hash::make('secret'),
            'phone' => '658288757',
            'location' => 'Yaoundé',
            'role_id' => 1,
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
        DB::table('customers')->insert([
            'id' => 2,
            'first_name' => 'Marcel',
            'last_name' => 'Junior',
            'user_name' => 'Freg120',
            'email' => 'fregmarcel@gmail.com',
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
