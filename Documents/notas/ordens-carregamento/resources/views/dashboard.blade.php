@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Motoristas</h5>
                <p class="card-text display-4">{{ App\Models\Motorista::count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Frotas</h5>
                <p class="card-text display-4">{{ App\Models\Frota::count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Destinos</h5>
                <p class="card-text display-4">{{ App\Models\Destino::count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Ordens Geradas</h5>
                <p class="card-text display-4">{{ App\Models\OrdemCarregamento::count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ações Rápidas</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('ordens.create') }}" class="btn btn-primary btn-lg me-2">
                    <i class="bi bi-plus-circle"></i> Nova Ordem de Carregamento
                </a>
                <a href="{{ route('motoristas.create') }}" class="btn btn-outline-primary btn-lg me-2">
                    <i class="bi bi-person-plus"></i> Cadastrar Motorista
                </a>
                <a href="{{ route('frotas.create') }}" class="btn btn-outline-success btn-lg me-2">
                    <i class="bi bi-truck"></i> Cadastrar Frota
                </a>
                <a href="{{ route('destinos.create') }}" class="btn btn-outline-info btn-lg">
                    <i class="bi bi-geo-alt"></i> Cadastrar Destino
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
