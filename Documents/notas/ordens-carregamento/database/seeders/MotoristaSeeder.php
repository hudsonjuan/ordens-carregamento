<?php

namespace Database\Seeders;

use App\Models\Motorista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotoristaSeeder extends Seeder
{
    public function run(): void
    {
        $motoristas = [
            ['nome' => 'João Silva', 'cpf' => '123.456.789-00'],
            ['nome' => 'Maria Santos', 'cpf' => '987.654.321-00'],
            ['nome' => 'Pedro Oliveira', 'cpf' => '456.789.123-00'],
            ['nome' => 'Ana Costa', 'cpf' => '321.654.987-00'],
            ['nome' => 'Carlos Ferreira', 'cpf' => '789.123.456-00'],
        ];

        foreach ($motoristas as $motorista) {
            Motorista::create($motorista);
        }
    }
}
