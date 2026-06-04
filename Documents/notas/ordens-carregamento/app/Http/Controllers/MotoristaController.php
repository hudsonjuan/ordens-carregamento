<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function index()
    {
        $motoristas = Motorista::all();
        return view('motoristas.index', compact('motoristas'));
    }

    public function create()
    {
        return view('motoristas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:motoristas,cpf|max:14',
        ]);

        Motorista::create($request->all());
        return redirect()->route('motoristas.index')->with('success', 'Motorista cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $motorista = Motorista::findOrFail($id);
        return view('motoristas.edit', compact('motorista'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:motoristas,cpf,' . $id . '|max:14',
        ]);

        $motorista = Motorista::findOrFail($id);
        $motorista->update($request->all());
        return redirect()->route('motoristas.index')->with('success', 'Motorista atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $motorista = Motorista::findOrFail($id);
        $motorista->delete();
        return redirect()->route('motoristas.index')->with('success', 'Motorista excluído com sucesso!');
    }
}
