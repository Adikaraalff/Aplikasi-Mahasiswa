<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => "Teknik Informatike",
                'keterangan' => "Teknik Informatike"
            ],
            [
                'nama' => "Teknik Komputer",
                'keterangan' => "Teknik Komputer"
            ],
            [
                'nama' => "Sistem Informasi",
                'keterangan' => "Sistem Informasi"
            ],
        ];
        Prodi::insert($data);
    }
}
