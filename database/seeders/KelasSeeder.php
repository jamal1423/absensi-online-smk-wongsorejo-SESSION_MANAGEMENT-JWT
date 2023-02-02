<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'kelas' => 'X A'
        ]);
        Kelas::create([
            'kelas' => 'X B'
        ]);
        Kelas::create([
            'kelas' => 'X C'
        ]);
        Kelas::create([
            'kelas' => 'XI A'
        ]);
        Kelas::create([
            'kelas' => 'XI B'
        ]);
        Kelas::create([
            'kelas' => 'XI C'
        ]);
        Kelas::create([
            'kelas' => 'XII A'
        ]);
        Kelas::create([
            'kelas' => 'XII B'
        ]);
        Kelas::create([
            'kelas' => 'XII C'
        ]);
    }
}
