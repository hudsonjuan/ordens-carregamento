<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    public function index()
    {
        $destinos = Destino::all();
        return view('destinos.index', compact('destinos'));
    }

    public function create()
    {
        return view('destinos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|unique:destinos,nome|max:255',
        ]);

        Destino::create($request->all());
        return redirect()->route('destinos.index')->with('success', 'Destino cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $destino = Destino::findOrFail($id);
        return view('destinos.edit', compact('destino'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|unique:destinos,nome,' . $id . '|max:255',
        ]);

        $destino = Destino::findOrFail($id);
        $destino->update($request->all());
        return redirect()->route('destinos.index')->with('success', 'Destino atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $destino = Destino::findOrFail($id);
        $destino->delete();
        return redirect()->route('destinos.index')->with('success', 'Destino excluído com sucesso!');
    }
}
