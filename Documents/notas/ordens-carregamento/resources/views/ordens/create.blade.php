@extends('layouts.app')

@section('title', 'Nova Ordem de Carregamento')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nova Ordem de Carregamento</h1>
    <a href="{{ route('ordens.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('ordens.store') }}" method="POST" id="ordemForm">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="motorista_id" class="form-label">Motorista</label>
                        <select class="form-select @error('motorista_id') is-invalid @enderror" id="motorista_id" name="motorista_id" required>
                            <option value="">Selecione...</option>
                            @foreach($motoristas as $motorista)
                                <option value="{{ $motorista->id }}">{{ $motorista->nome }} - {{ $motorista->cpf }}</option>
                            @endforeach
                        </select>
                        @error('motorista_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="frota_id" class="form-label">Frota</label>
                        <select class="form-select @error('frota_id') is-invalid @enderror" id="frota_id" name="frota_id" required onchange="loadFrotaData(this.value)">
                            <option value="">Selecione...</option>
                            @foreach($frotas as $frota)
                                <option value="{{ $frota->id }}" data-tipo="{{ $frota->tipo }}" data-volume="{{ $frota->volume }}" data-peso="{{ $frota->peso_bruto }}">
                                    {{ $frota->numero_frota }} - {{ $frota->tipo }}
                                </option>
                            @endforeach
                        </select>
                        @error('frota_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="destino_id" class="form-label">Destino</label>
                        <select class="form-select @error('destino_id') is-invalid @enderror" id="destino_id" name="destino_id" required>
                            <option value="">Selecione...</option>
                            @foreach($destinos as $destino)
                                <option value="{{ $destino->id }}">{{ $destino->nome }}</option>
                            @endforeach
                        </select>
                        @error('destino_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="frota-details" style="display: none;" class="alert alert-info">
                        <h5>Detalhes da Frota</h5>
                        <p><strong>Tipo:</strong> <span id="tipo-composicao"></span></p>
                        <p><strong>Volume:</strong> <span id="volume"></span> M</p>
                        <p><strong>Peso Bruto:</strong> <span id="peso-bruto"></span> T</p>
                        
                        <hr>
                        <h5>Placas (editáveis para correções temporárias)</h5>
                        <div id="placas-container"></div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="bi bi-file-earmark-pdf"></i> Gerar Ordem de Carregamento
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const frotasData = @json($frotas);

function loadFrotaData(frotaId) {
    const frota = frotasData.find(f => f.id == frotaId);
    const detailsDiv = document.getElementById('frota-details');
    const placasContainer = document.getElementById('placas-container');
    
    if (!frota) {
        detailsDiv.style.display = 'none';
        return;
    }
    
    detailsDiv.style.display = 'block';
    document.getElementById('tipo-composicao').textContent = frota.tipo;
    document.getElementById('volume').textContent = frota.volume;
    document.getElementById('peso-bruto').textContent = frota.peso_bruto;
    
    placasContainer.innerHTML = '';
    
    frota.placas.forEach(placa => {
        const div = document.createElement('div');
        div.className = 'mb-2';
        div.innerHTML = `
            <label class="form-label">${getLabel(placa.tipo_placa)}</label>
            <input type="text" class="form-control" name="placa_${placa.tipo_placa}" value="${placa.placa}">
        `;
        placasContainer.appendChild(div);
    });
}

function getLabel(tipoPlaca) {
    const labels = {
        'cavalo': 'Placa do Cavalo',
        'carreta': 'Placa da Carreta',
        'dolly': 'Placa do Dolly',
        'carreta1': 'Placa da Carreta 1',
        'carreta2': 'Placa da Carreta 2'
    };
    return labels[tipoPlaca] || tipoPlaca;
}
</script>
@endsection
