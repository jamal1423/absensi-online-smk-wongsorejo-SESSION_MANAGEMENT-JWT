<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'username' => 'jamal',
            'password' => bcrypt('Masuk1945'),
            'nama' => 'Mochammad Jamal',
            'role' => 'Administrator',
            'foto' => '',
        ]);
    }
}
