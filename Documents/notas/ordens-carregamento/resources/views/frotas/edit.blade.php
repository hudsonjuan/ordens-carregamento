@extends('layouts.app')

@section('title', 'Editar Frota')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Frota</h1>
    <a href="{{ route('frotas.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('frotas.update', $frota->id) }}" method="POST" id="frotaForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="numero_frota" class="form-label">Número da Frota</label>
                        <input type="text" class="form-control @error('numero_frota') is-invalid @enderror" id="numero_frota" name="numero_frota" value="{{ old('numero_frota', $frota->numero_frota) }}" required>
                        @error('numero_frota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required onchange="toggleTipo()">
                            <option value="">Selecione...</option>
                            <option value="LS" {{ $frota->tipo === 'LS' ? 'selected' : '' }}>LS</option>
                            <option value="9 Eixos" {{ $frota->tipo === '9 Eixos' ? 'selected' : '' }}>9 Eixos</option>
                        </select>
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @php
                        $placas = $frota->placas->keyBy('tipo_placa');
                    @endphp

                    <div id="ls-fields" style="display: {{ $frota->tipo === 'LS' ? 'block' : 'none' }};">
                        <h5>Placas LS</h5>
                        <div class="mb-3">
                            <label for="placa_cavalo" class="form-label">Placa do Cavalo</label>
                            <input type="text" class="form-control" id="placa_cavalo" name="placa_cavalo" value="{{ old('placa_cavalo', $placas['cavalo']->placa ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="placa_carreta" class="form-label">Placa da Carreta</label>
                            <input type="text" class="form-control" id="placa_carreta" name="placa_carreta" value="{{ old('placa_carreta', $placas['carreta']->placa ?? '') }}">
                        </div>
                    </div>

                    <div id="noveixos-fields" style="display: {{ $frota->tipo === '9 Eixos' ? 'block' : 'none' }};">
                        <h5>Placas 9 Eixos</h5>
                        <div class="mb-3">
                            <label for="placa_cavalo_9" class="form-label">Placa do Cavalo</label>
                            <input type="text" class="form-control" id="placa_cavalo_9" name="placa_cavalo" value="{{ old('placa_cavalo', $placas['cavalo']->placa ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="placa_dolly" class="form-label">Placa do Dolly</label>
                            <input type="text" class="form-control" id="placa_dolly" name="placa_dolly" value="{{ old('placa_dolly', $placas['dolly']->placa ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="placa_carreta1" class="form-label">Placa da Carreta 1</label>
                            <input type="text" class="form-control" id="placa_carreta1" name="placa_carreta1" value="{{ old('placa_carreta1', $placas['carreta1']->placa ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="placa_carreta2" class="form-label">Placa da Carreta 2</label>
                            <input type="text" class="form-control" id="placa_carreta2" name="placa_carreta2" value="{{ old('placa_carreta2', $placas['carreta2']->placa ?? '') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Atualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleTipo() {
    const tipo = document.getElementById('tipo').value;
    const lsFields = document.getElementById('ls-fields');
    const noveixosFields = document.getElementById('noveixos-fields');
    
    if (tipo === 'LS') {
        lsFields.style.display = 'block';
        noveixosFields.style.display = 'none';
    } else if (tipo === '9 Eixos') {
        lsFields.style.display = 'none';
        noveixosFields.style.display = 'block';
    } else {
        lsFields.style.display = 'none';
        noveixosFields.style.display = 'none';
    }
}
</script>
@endsection
