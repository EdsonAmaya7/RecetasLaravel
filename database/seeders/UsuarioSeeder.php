<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name' => 'Edson',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://keep.google.com/',
        ]);
        // $user->perfil()->create();

        $user2 = User::create([
            'name' => 'Gera',
            'email' => 'correo2@correo.com',
            'password' => hash::make('12345678'),
            'url' => 'https://keep.google.com/',
        ]);
        // $user2->perfil()->create();

        // manera antigua de insertar en el seed sin modelo
        // DB::table('users')->insert([
        //     'name' => 'Edson',
        //     'email' => 'correo@correo.com',
        //     'password' => Hash::make('12345678'),
        //     'url' => 'https://keep.google.com/',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);








    }
}
