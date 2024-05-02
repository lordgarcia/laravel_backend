<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

class PacoteController extends Controller
{
    
   
    public function generatePDF(Request $request)
    {
        // Capture os dados enviados via POST
        $data = $request->all();

        // Renderiza a visualização com os dados
        $pdf = PDF::loadView('pdf', compact('data'));

        // Retorna o PDF para ser exibido ou baixado
        return $pdf->stream('documento.pdf');
    }
    
}