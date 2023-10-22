<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => "B603",
                'keterangan' => "B603"
            ],
            [
                'nama' => "B604",
                'keterangan' => "B604"
            ],
            [
                'nama' => "B605",
                'keterangan' => "B605"
            ],
        ];
        Kelas::insert($data);
    }
}
