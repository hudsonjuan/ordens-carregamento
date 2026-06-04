@extends('layouts.app')

@section('title', 'Histórico de Ordens')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Histórico de Ordens</h1>
    <a href="{{ route('ordens.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nova Ordem
    </a>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <form action="{{ route('ordens.index') }}" method="GET" class="form-inline">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar por OC, NF, Motorista, Destino ou Status" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Buscar
                </button>
                @if(request('search'))
                    <a href="{{ route('ordens.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Limpar
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Número OC</th>
                <th>Data</th>
                <th>Motorista</th>
                <th>Frota</th>
                <th>Destino</th>
                <th>Tipo</th>
                <th>NF</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordens as $ordem)
            <tr>
                <td><strong>{{ $ordem->numero_oc }}</strong></td>
                <td>{{ $ordem->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $ordem->motorista->nome }}</td>
                <td>{{ $ordem->frota->numero_frota }}</td>
                <td>{{ $ordem->destino->nome }}</td>
                <td>{{ $ordem->frota->tipo }}</td>
                <td>{{ $ordem->numero_nf ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $ordem->status === 'PENDENTE' ? 'warning' : ($ordem->status === 'EM VIAGEM' ? 'info' : 'success') }}">{{ $ordem->status }}</span>
                </td>
                <td>
                    <a href="{{ route('ordens.preview', $ordem->id) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-eye"></i> Pré-visualizar
                    </a>
                    <a href="{{ route('ordens.show', $ordem->id) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-file-text"></i> Detalhes
                    </a>
                    <a href="{{ route('ordens.download', $ordem->id) }}" class="btn btn-sm btn-success">
                        <i class="bi bi-download"></i> PDF
                    </a>
                    <form action="{{ route('ordens.destroy', $ordem->id) }}" method="POST" style="display: inline;">
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
