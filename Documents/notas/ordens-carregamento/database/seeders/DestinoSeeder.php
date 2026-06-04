<?php

namespace Database\Seeders;

use App\Models\Destino;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinoSeeder extends Seeder
{
    public function run(): void
    {
        $destinos = [
            ['nome' => 'AVB'],
            ['nome' => 'CMAA'],
            ['nome' => 'BP'],
            ['nome' => 'Porto Alegre'],
            ['nome' => 'São Paulo'],
        ];

        foreach ($destinos as $destino) {
            Destino::create($destino);
        }
    }
}
