<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\Frota;
use App\Models\Motorista;
use App\Models\OrdemCarregamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class OrdemCarregamentoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = OrdemCarregamento::with(['motorista', 'frota', 'destino']);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('numero_oc', 'like', "%{$search}%")
                  ->orWhere('numero_nf', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereHas('motorista', function($q) use ($search) {
                      $q->where('nome', 'like', "%{$search}%");
                  })
                  ->orWhereHas('destino', function($q) use ($search) {
                      $q->where('nome', 'like', "%{$search}%");
                  });
            });
        }
        
        $ordens = $query->orderBy('created_at', 'desc')->get();
        return view('ordens.index', compact('ordens'));
    }

    public function create()
    {
        $motoristas = Motorista::all();
        $frotas = Frota::with('placas')->get();
        $destinos = Destino::all();
        return view('ordens.create', compact('motoristas', 'frotas', 'destinos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motorista_id' => 'required|exists:motoristas,id',
            'frota_id' => 'required|exists:frotas,id',
            'destino_id' => 'required|exists:destinos,id',
        ]);

        $frota = Frota::with('placas')->findOrFail($request->frota_id);
        $motorista = Motorista::findOrFail($request->motorista_id);
        $destino = Destino::findOrFail($request->destino_id);

        // Generate OC number
        $year = date('Y');
        $lastOrder = OrdemCarregamento::where('numero_oc', 'like', "OC-{$year}-%")->orderBy('id', 'desc')->first();
        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder->numero_oc, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        $numero_oc = "OC-{$year}-{$newNumber}";

        // Collect placas from request (editable)
        $placas_utilizadas = [];
        foreach ($frota->placas as $placa) {
            $field_name = "placa_{$placa->tipo_placa}";
            $placas_utilizadas[$placa->tipo_placa] = $request->input($field_name, $placa->placa);
        }

        // Create order
        $ordem = OrdemCarregamento::create([
            'numero_oc' => $numero_oc,
            'motorista_id' => $motorista->id,
            'frota_id' => $frota->id,
            'destino_id' => $destino->id,
            'volume' => $frota->volume,
            'peso_bruto' => $frota->peso_bruto,
            'placas_utilizadas' => $placas_utilizadas,
            'pdf_path' => '',
        ]);

        // Generate PDF filename: OC [NOME DO MOTORISTA] [DESTINO] [DATA]
        $motoristaNome = strtoupper(preg_replace('/[^a-zA-Z\s]/', '', $motorista->nome));
        $destinoNome = strtoupper(preg_replace('/[^a-zA-Z\s]/', '', $destino->nome));
        $dataEmissao = $ordem->created_at->format('d.m.Y');
        $pdfFileName = "OC {$motoristaNome} {$destinoNome} {$dataEmissao}.pdf";
        $pdfFileName = preg_replace('/\s+/', ' ', trim($pdfFileName)); // Remove extra spaces

        // Generate PDF
        $pdf = PDF::loadView('ordens.pdf', compact('ordem', 'motorista', 'frota', 'destino', 'placas_utilizadas'));
        $pdfPath = 'ordens/' . $pdfFileName;
        Storage::disk('public')->put($pdfPath, $pdf->output());

        $ordem->pdf_path = $pdfPath;
        $ordem->save();

        return redirect()->route('ordens.index')->with('success', 'Ordem de Carregamento gerada com sucesso!');
    }

    public function show($id)
    {
        $ordem = OrdemCarregamento::with(['motorista', 'frota', 'destino'])->findOrFail($id);
        return view('ordens.show', compact('ordem'));
    }

    public function preview($id)
    {
        $ordem = OrdemCarregamento::with(['motorista', 'frota', 'destino'])->findOrFail($id);
        return view('ordens.preview', compact('ordem'));
    }

    public function download($id)
    {
        $ordem = OrdemCarregamento::with(['motorista', 'frota', 'destino'])->findOrFail($id);
        $frota = $ordem->frota;
        $motorista = $ordem->motorista;
        $destino = $ordem->destino;
        $placas_utilizadas = $ordem->placas_utilizadas;
        
        // Generate filename: OC [NOME DO MOTORISTA] [DESTINO] [DATA]
        $motoristaNome = strtoupper(preg_replace('/[^a-zA-Z\s]/', '', $motorista->nome));
        $destinoNome = strtoupper(preg_replace('/[^a-zA-Z\s]/', '', $destino->nome));
        $dataEmissao = $ordem->created_at->format('d.m.Y');
        $pdfFileName = "OC {$motoristaNome} {$destinoNome} {$dataEmissao}.pdf";
        $pdfFileName = preg_replace('/\s+/', ' ', trim($pdfFileName)); // Remove extra spaces
        
        // Regenerate PDF with current layout
        $pdf = PDF::loadView('ordens.pdf', compact('ordem', 'motorista', 'frota', 'destino', 'placas_utilizadas'));
        
        return $pdf->download($pdfFileName);
    }

    public function destroy($id)
    {
        $ordem = OrdemCarregamento::findOrFail($id);
        Storage::disk('public')->delete($ordem->pdf_path);
        $ordem->delete();
        return redirect()->route('ordens.index')->with('success', 'Ordem de Carregamento excluída com sucesso!');
    }

    public function updateNf(Request $request, $id)
    {
        $request->validate([
            'numero_nf' => 'nullable|string|max:50',
            'status' => 'required|in:PENDENTE,EM VIAGEM,CONCLUÍDO',
        ]);

        $ordem = OrdemCarregamento::findOrFail($id);
        $ordem->numero_nf = $request->numero_nf;
        $ordem->status = $request->status;
        $ordem->save();

        return redirect()->route('ordens.show', $id)->with('success', 'NF e Status atualizados com sucesso!');
    }
}
