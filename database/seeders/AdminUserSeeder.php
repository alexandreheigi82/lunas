<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_tabela')->insert([
            'nome' => 'Admin',
            'sobrenome' => 'User',
            'email' => 'lunas.tours.tcc@gmail.com',
            'senha' => Hash::make('Unialfa.01'),
            'situacao' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
