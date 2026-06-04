<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 650px;
            margin: 0 auto;
            padding: 20px 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .logo-placeholder {
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
        }
        .logo-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .company-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .field {
            margin-bottom: 8px;
            border: 1px solid #000;
            padding: 5px;
        }
        .label {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            color: #333;
            margin-bottom: 2px;
        }
        .value {
            font-size: 14px;
            font-weight: normal;
            color: #000;
            min-height: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #000;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-placeholder">
                <img src="/Users/hudsonjuan/Documents/notas/ordens-carregamento/public/images/logo.jpg" alt="Logo" class="logo-image">
            </div>
            <div class="company-name">INOVA BIONERGIA LTDA</div>
        </div>

        <h1>ORDEM DE CARREGAMENTO</h1>

        <div class="field">
            <div class="label">NOME DO MOTORISTA</div>
            <div class="value">{{ $motorista->nome }}</div>
        </div>

        <div class="field">
            <div class="label">CPF</div>
            <div class="value">{{ $motorista->cpf }}</div>
        </div>

        @if($frota->tipo === 'LS')
            <div class="field">
                <div class="label">PLACA DO CAVALO</div>
                <div class="value">{{ $placas_utilizadas['cavalo'] ?? '' }}</div>
            </div>

            <div class="field">
                <div class="label">PLACA DA CARRETA</div>
                <div class="value">{{ $placas_utilizadas['carreta'] ?? '' }}</div>
            </div>

            <div class="field">
                <div class="label">VOLUME</div>
                <div class="value">{{ $ordem->volume }} M</div>
            </div>
        @else
            <div class="field">
                <div class="label">PLACA DO CAVALO</div>
                <div class="value">{{ $placas_utilizadas['cavalo'] ?? '' }}</div>
            </div>

            <div class="field">
                <div class="label">PLACA DO DOLLY</div>
                <div class="value">{{ $placas_utilizadas['dolly'] ?? '' }}</div>
            </div>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 8px;">
                <tr>
                    <td style="width: 50%; border: 1px solid #000; padding: 5px; vertical-align: top;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PLACA DA CARRETA 1</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $placas_utilizadas['carreta1'] ?? '' }}</div>
                    </td>
                    <td style="width: 50%; border: 1px solid #000; padding: 5px; vertical-align: top;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">PLACA DA CARRETA 2</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">{{ $placas_utilizadas['carreta2'] ?? '' }}</div>
                    </td>
                </tr>
            </table>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 8px;">
                <tr>
                    <td style="width: 50%; border: 1px solid #000; padding: 5px; vertical-align: top;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">VOLUME</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">60 M</div>
                    </td>
                    <td style="width: 50%; border: 1px solid #000; padding: 5px; vertical-align: top;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 10px; color: #333; margin-bottom: 2px;">VOLUME</div>
                        <div style="font-size: 14px; font-weight: normal; color: #000; min-height: 20px;">60 M</div>
                    </td>
                </tr>
            </table>
        @endif

        <div class="field">
            <div class="label">DESTINO</div>
            <div class="value">{{ $destino->nome }}</div>
        </div>

        <div class="field">
            <div class="label">PESO BRUTO</div>
            <div class="value">{{ $frota->tipo === '9 Eixos' ? '74.000' : $ordem->peso_bruto }} T</div>
        </div>

        <div class="field">
            <div class="label">DATA</div>
            <div class="value">{{ $ordem->created_at->format('d.m.Y') }}</div>
        </div>

        <div class="footer">
            INOVA BIONERGIA LTDA<br>
            Gerado por Hudson Juan
        </div>
    </div>
</body>
</html>
