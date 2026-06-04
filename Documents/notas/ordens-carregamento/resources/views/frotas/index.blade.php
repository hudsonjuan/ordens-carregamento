@extends('layouts.app')

@section('title', 'Frotas')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Frotas</h1>
    <a href="{{ route('frotas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nova Frota
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Tipo</th>
                <th>Volume</th>
                <th>Peso Bruto</th>
                <th>Placas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($frotas as $frota)
            <tr>
                <td>{{ $frota->id }}</td>
                <td>{{ $frota->numero_frota }}</td>
                <td>{{ $frota->tipo }}</td>
                <td>{{ $frota->volume }} m³</td>
                <td>{{ $frota->peso_bruto }} t</td>
                <td>
                    @foreach($frota->placas as $placa)
                        <span class="badge bg-secondary">{{ $placa->tipo_placa }}: {{ $placa->placa }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('frotas.edit', $frota->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('frotas.destroy', $frota->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                            <i class="bi bi-trash"></i> Excluir
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
