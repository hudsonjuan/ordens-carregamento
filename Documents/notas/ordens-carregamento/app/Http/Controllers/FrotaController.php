<?php

namespace App\Http\Controllers;

use App\Models\Frota;
use App\Models\Placa;
use Illuminate\Http\Request;

class FrotaController extends Controller
{
    public function index()
    {
        $frotas = Frota::with('placas')->get();
        return view('frotas.index', compact('frotas'));
    }

    public function create()
    {
        return view('frotas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_frota' => 'required|string|unique:frotas,numero_frota|max:50',
            'tipo' => 'required|in:LS,9 Eixos',
        ]);

        $volume = $request->tipo === 'LS' ? 100 : 150;
        $peso_bruto = $request->tipo === 'LS' ? 48 : 68;

        $frota = Frota::create([
            'numero_frota' => $request->numero_frota,
            'tipo' => $request->tipo,
            'volume' => $volume,
            'peso_bruto' => $peso_bruto,
        ]);

        if ($request->tipo === 'LS') {
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'cavalo',
                'placa' => $request->placa_cavalo,
            ]);
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'carreta',
                'placa' => $request->placa_carreta,
            ]);
        } else {
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'cavalo',
                'placa' => $request->placa_cavalo,
            ]);
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'dolly',
                'placa' => $request->placa_dolly,
            ]);
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'carreta1',
                'placa' => $request->placa_carreta1,
            ]);
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'carreta2',
                'placa' => $request->placa_carreta2,
            ]);
        }

        return redirect()->route('frotas.index')->with('success', 'Frota cadastrada com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $frota = Frota::with('placas')->findOrFail($id);
        return view('frotas.edit', compact('frota'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'numero_frota' => 'required|string|unique:frotas,numero_frota,' . $id . '|max:50',
            'tipo' => 'required|in:LS,9 Eixos',
        ]);

        $frota = Frota::findOrFail($id);
        $volume = $request->tipo === 'LS' ? 100 : 150;
        $peso_bruto = $request->tipo === 'LS' ? 48 : 68;

        $frota->update([
            'numero_frota' => $request->numero_frota,
            'tipo' => $request->tipo,
            'volume' => $volume,
            'peso_bruto' => $peso_bruto,
        ]);

        // Delete existing placas
        Placa::where('frota_id', $frota->id)->delete();

        // Create new placas
        if ($request->tipo === 'LS') {
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'cavalo',
                'placa' => $request->placa_cavalo,
            ]);
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'carreta',
                'placa' => $request->placa_carreta,
            ]);
        } else {
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'cavalo',
                'placa' => $request->placa_cavalo,
            ]);
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'dolly',
                'placa' => $request->placa_dolly,
            ]);
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'carreta1',
                'placa' => $request->placa_carreta1,
            ]);
            Placa::create([
                'frota_id' => $frota->id,
                'tipo_placa' => 'carreta2',
                'placa' => $request->placa_carreta2,
            ]);
        }

        return redirect()->route('frotas.index')->with('success', 'Frota atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $frota = Frota::findOrFail($id);
        $frota->delete();
        return redirect()->route('frotas.index')->with('success', 'Frota excluída com sucesso!');
    }
}
