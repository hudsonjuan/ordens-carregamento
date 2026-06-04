@extends('layouts.app')

@section('title', 'Destinos')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Destinos</h1>
    <a href="{{ route('destinos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Novo Destino
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($destinos as $destino)
            <tr>
                <td>{{ $destino->id }}</td>
                <td>{{ $destino->nome }}</td>
                <td>
                    <a href="{{ route('destinos.edit', $destino->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('destinos.destroy', $destino->id) }}" method="POST" style="display: inline;">
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
