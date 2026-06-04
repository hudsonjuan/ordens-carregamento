<?php

namespace Database\Seeders;

use App\Models\Frota;
use App\Models\Placa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrotaSeeder extends Seeder
{
    public function run(): void
    {
        // LS Frotas
        $frotaLS1 = Frota::create([
            'numero_frota' => 'LS-001',
            'tipo' => 'LS',
            'volume' => 100,
            'peso_bruto' => 48,
        ]);
        Placa::create(['frota_id' => $frotaLS1->id, 'tipo_placa' => 'cavalo', 'placa' => 'ABC-1234']);
        Placa::create(['frota_id' => $frotaLS1->id, 'tipo_placa' => 'carreta', 'placa' => 'DEF-5678']);

        $frotaLS2 = Frota::create([
            'numero_frota' => 'LS-002',
            'tipo' => 'LS',
            'volume' => 100,
            'peso_bruto' => 48,
        ]);
        Placa::create(['frota_id' => $frotaLS2->id, 'tipo_placa' => 'cavalo', 'placa' => 'GHI-9012']);
        Placa::create(['frota_id' => $frotaLS2->id, 'tipo_placa' => 'carreta', 'placa' => 'JKL-3456']);

        // 9 Eixos Frotas
        $frota9Eixos1 = Frota::create([
            'numero_frota' => '9E-001',
            'tipo' => '9 Eixos',
            'volume' => 120,
            'peso_bruto' => 74,
        ]);
        Placa::create(['frota_id' => $frota9Eixos1->id, 'tipo_placa' => 'cavalo', 'placa' => 'MNO-7890']);
        Placa::create(['frota_id' => $frota9Eixos1->id, 'tipo_placa' => 'dolly', 'placa' => 'PQR-1234']);
        Placa::create(['frota_id' => $frota9Eixos1->id, 'tipo_placa' => 'carreta1', 'placa' => 'STU-5678']);
        Placa::create(['frota_id' => $frota9Eixos1->id, 'tipo_placa' => 'carreta2', 'placa' => 'VWX-9012']);

        $frota9Eixos2 = Frota::create([
            'numero_frota' => '9E-002',
            'tipo' => '9 Eixos',
            'volume' => 120,
            'peso_bruto' => 74,
        ]);
        Placa::create(['frota_id' => $frota9Eixos2->id, 'tipo_placa' => 'cavalo', 'placa' => 'YZA-3456']);
        Placa::create(['frota_id' => $frota9Eixos2->id, 'tipo_placa' => 'dolly', 'placa' => 'BCD-7890']);
        Placa::create(['frota_id' => $frota9Eixos2->id, 'tipo_placa' => 'carreta1', 'placa' => 'EFG-1234']);
        Placa::create(['frota_id' => $frota9Eixos2->id, 'tipo_placa' => 'carreta2', 'placa' => 'HIJ-5678']);
    }
}
