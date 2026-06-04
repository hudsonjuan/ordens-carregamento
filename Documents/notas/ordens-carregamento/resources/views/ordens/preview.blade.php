@extends('layouts.app')

@section('title', 'Pré-visualização da Ordem')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pré-visualização: {{ $ordem->numero_oc }}</h1>
    <div>
        <a href="{{ route('ordens.download', $ordem->id) }}" class="btn btn-success">
            <i class="bi bi-download"></i> Baixar PDF
        </a>
        <a href="{{ route('ordens.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<div class="alert alert-info">
    <i class="bi bi-info-circle"></i> Revise as informações abaixo antes de baixar o PDF.
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div style="border: 1px solid #ddd; padding: 15px; background: white;">
                    <div style="text-align: center; margin-bottom: 15px;">
                        <div style="width: 60px; height: 60px; margin: 0 auto 10px;">
                            <img src="/images/logo.jpg" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div style="font-size: 14px; font-weight: bold; margin-bottom: 10px;">INOVA BIONERGIA LTDA</div>
                    </div>

                    <h1 style="text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">ORDEM DE CARREGAMENTO</h1>

                    <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">NOME DO MOTORISTA</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->motorista->nome }}</div>
                    </div>

                    <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">CPF</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->motorista->cpf }}</div>
                    </div>

                    @if($ordem->frota->tipo === 'LS')
                        <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                            <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PLACA DO CAVALO</div>
                            <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->placas_utilizadas['cavalo'] ?? '' }}</div>
                        </div>

                        <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                            <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PLACA DA CARRETA</div>
                            <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->placas_utilizadas['carreta'] ?? '' }}</div>
                        </div>

                        <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                            <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">VOLUME</div>
                            <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->volume }} M</div>
                        </div>
                    @else
                        <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                            <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PLACA DO CAVALO</div>
                            <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->placas_utilizadas['cavalo'] ?? '' }}</div>
                        </div>

                        <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                            <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PLACA DO DOLLY</div>
                            <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->placas_utilizadas['dolly'] ?? '' }}</div>
                        </div>

                        <div style="display: flex; gap: 10px; margin-bottom: 8px;">
                            <div style="flex: 1; border: 1px solid #000; padding: 5px;">
                                <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PLACA DA CARRETA 1</div>
                                <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->placas_utilizadas['carreta1'] ?? '' }}</div>
                            </div>
                            <div style="flex: 1; border: 1px solid #000; padding: 5px;">
                                <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PLACA DA CARRETA 2</div>
                                <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->placas_utilizadas['carreta2'] ?? '' }}</div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 10px; margin-bottom: 8px;">
                            <div style="flex: 1; border: 1px solid #000; padding: 5px;">
                                <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">VOLUME</div>
                                <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">60 M</div>
                            </div>
                            <div style="flex: 1; border: 1px solid #000; padding: 5px;">
                                <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">VOLUME</div>
                                <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">60 M</div>
                            </div>
                        </div>
                    @endif

                    <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">DESTINO</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->destino->nome }}</div>
                    </div>

                    <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PESO BRUTO</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->frota->tipo === '9 Eixos' ? '74.000' : $ordem->peso_bruto }} T</div>
                    </div>

                    <div style="margin-bottom: 8px; border: 1px solid #000; padding: 5px;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">DATA</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $ordem->created_at->format('d.m.Y') }}</div>
                    </div>

                    <div style="text-align: center; margin-top: 20px; padding-top: 10px; border-top: 2px solid #000; font-size: 12px; font-weight: bold;">
                        INOVA BIONERGIA LTDA<br>
                        Gerado por Hudson Juan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="text-center">
            <a href="{{ route('ordens.download', $ordem->id) }}" class="btn btn-success btn-lg">
                <i class="bi bi-download"></i> Confirmar e Baixar PDF
            </a>
            <a href="{{ route('ordens.index') }}" class="btn btn-secondary btn-lg">
                <i class="bi bi-arrow-left"></i> Voltar ao Histórico
            </a>
        </div>
    </div>
</div>
@endsection
