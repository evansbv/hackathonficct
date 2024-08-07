<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Evans Balcazar',
            'email' => 'evansbv@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Miguel Peinado',
            'email' => 'miguelpp@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'rol' => 'Admin',
        ]);
    }
}
