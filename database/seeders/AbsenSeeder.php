<?php

namespace Database\Seeders;

use App\Models\Absen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Absen::create([
            'kelas' => 'XII A',
            'nama' => 'Mochammad Jamal',
            'userlog' => 'jamal1',
            'clock_in' => 'YES',
            'tgl_clock_in' => '2023-02-02 06:45:04',
            'clock_out' => 'YES',
            'tgl_clock_out' => '2023-02-02 13:45:04',
            'longitude' => '114.39535834973755',
            'latitude' => '-7.98929298619609',
            'lokasi' => 'SMKN 1 Wongsorejo',
            'created_at' => '2023-02-02 06:45:04',
            'updated_at' => '2023-02-02 06:45:04',
        ]);
        Absen::create([
            'kelas' => 'XII A',
            'nama' => 'Mochammad Jamal',
            'userlog' => 'jamal1',
            'clock_in' => 'YES',
            'tgl_clock_in' => '2023-02-03 06:45:04',
            'clock_out' => 'YES',
            'tgl_clock_out' => '2023-02-03 13:45:04',
            'longitude' => '114.39535834973755',
            'latitude' => '-7.98929298619609',
            'lokasi' => 'SMKN 1 Wongsorejo',
            'created_at' => '2023-02-03 06:45:04',
            'updated_at' => '2023-02-03 06:45:04',
        ]);
    }
}
