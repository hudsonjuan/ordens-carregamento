@extends('layouts.app')

@section('title', 'Motoristas')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Motoristas</h1>
    <a href="{{ route('motoristas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Novo Motorista
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($motoristas as $motorista)
            <tr>
                <td>{{ $motorista->id }}</td>
                <td>{{ $motorista->nome }}</td>
                <td>{{ $motorista->cpf }}</td>
                <td>
                    <a href="{{ route('motoristas.edit', $motorista->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('motoristas.destroy', $motorista->id) }}" method="POST" style="display: inline;">
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
