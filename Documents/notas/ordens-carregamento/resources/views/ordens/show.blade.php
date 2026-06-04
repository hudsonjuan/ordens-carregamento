@extends('layouts.app')

@section('title', 'Visualizar Ordem')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ordem de Carregamento: {{ $ordem->numero_oc }}</h1>
    <div>
        <a href="{{ route('ordens.download', $ordem->id) }}" class="btn btn-success">
            <i class="bi bi-download"></i> Baixar PDF
        </a>
        <a href="{{ route('ordens.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Detalhes da Ordem</h4>
                
                <form action="{{ route('ordens.updateNf', $ordem->id) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_nf">Número da Nota Fiscal (opcional)</label>
                                <input type="text" class="form-control" id="numero_nf" name="numero_nf" value="{{ $ordem->numero_nf ?? '' }}" placeholder="Informe o número da NF">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="PENDENTE" {{ $ordem->status === 'PENDENTE' ? 'selected' : '' }}>PENDENTE</option>
                                    <option value="EM VIAGEM" {{ $ordem->status === 'EM VIAGEM' ? 'selected' : '' }}>EM VIAGEM</option>
                                    <option value="CONCLUÍDO" {{ $ordem->status === 'CONCLUÍDO' ? 'selected' : '' }}>CONCLUÍDO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Atualizar NF e Status
                    </button>
                </form>
                
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Número OC</th>
                        <td>{{ $ordem->numero_oc }}</td>
                    </tr>
                    <tr>
                        <th>Data</th>
                        <td>{{ $ordem->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Motorista</th>
                        <td>{{ $ordem->motorista->nome }} (CPF: {{ $ordem->motorista->cpf }})</td>
                    </tr>
                    <tr>
                        <th>Frota</th>
                        <td>{{ $ordem->frota->numero_frota }} - {{ $ordem->frota->tipo }}</td>
                    </tr>
                    <tr>
                        <th>Destino</th>
                        <td>{{ $ordem->destino->nome }}</td>
                    </tr>
                    <tr>
                        <th>Volume</th>
                        <td>{{ $ordem->volume }} M</td>
                    </tr>
                    <tr>
                        <th>Peso Bruto</th>
                        <td>{{ $ordem->peso_bruto }} t</td>
                    </tr>
                    <tr>
                        <th>Placas Utilizadas</th>
                        <td>
                            @foreach($ordem->placas_utilizadas as $tipo => $placa)
                                <span class="badge bg-secondary">{{ $tipo }}: {{ $placa }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Número da NF</th>
                        <td>{{ $ordem->numero_nf ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $ordem->status === 'PENDENTE' ? 'warning' : ($ordem->status === 'EM VIAGEM' ? 'info' : 'success') }}">{{ $ordem->status }}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
