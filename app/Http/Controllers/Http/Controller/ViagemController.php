<?php

namespace App\Http\Controllers\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use Carbon\Carbon;

class ViagemController extends Controller
{
 
    public function obterDadosViagem()
    {
        try {
            // Lê o conteúdo do arquivo JSON de maneira mais simples
            $conteudoJson = file_get_contents(storage_path('app/data.json'));

            // Converte o JSON em um array associativo
            $dadosViagem = json_decode($conteudoJson, true);
           

            // Verifica se os dados foram lidos com sucesso
            if ($dadosViagem === null) {
                throw new \Exception('Erro na decodificação do JSON.');
            }

            // Adiciona cabeçalhos CORS
            return response()->json($dadosViagem)->header('Access-Control-Allow-Origin', '*');
        } catch (\Exception $e) {
            // Em caso de erro, retorna uma resposta JSON com uma mensagem de erro
            return response()->json(['error' => $e->getMessage()], 500)
                             ->header('Access-Control-Allow-Origin', '*');
        }
    }

    public function obterDailyDeparture()
    {
        try {
            // Lê o conteúdo do arquivo JSON
            $conteudoJson = file_get_contents(storage_path('app/data.json'));
    
            // Converte o JSON em um array associativo
            $dadosViagem = json_decode($conteudoJson, true);
    
            // Verifica se os dados foram lidos com sucesso
            if ($dadosViagem === null) {
                throw new \Exception('Erro na decodificação do JSON.');
            }
    
            // Obtém a data atual
            $dataAtual = now()->toDateString();
    
            // Filtra as atividades para o dia atual
            $atividadesDoDia = collect($dadosViagem['days'])->filter(function ($dia) use ($dataAtual) {
                // Verifica se a data do dia é igual à data atual
                return $dia['date'] === $dataAtual;
            })->pluck('activities')->flatten(1);
    
            // Monta a resposta no formato desejado
            $resposta = [
                'id' => $dadosViagem['id'],
                'date' => $dataAtual,
                'activities' => $atividadesDoDia,
            ];
    
            // Adiciona cabeçalhos CORS
            return response()->json($resposta)->header('Access-Control-Allow-Origin', '*');
        } catch (\Exception $e) {
            // Em caso de erro, retorna uma resposta JSON com uma mensagem de erro
            return response()->json(['error' => $e->getMessage()], 500)
                             ->header('Access-Control-Allow-Origin', '*');
        }
    }

  /*

    public function gerarPDF()
    {
        $conteudoJson = file_get_contents(storage_path('app/data.json'));
        $dadosViagem = json_decode($conteudoJson, true);
        $todasAsAtividades = collect($dadosViagem['days'] ?? [])
            ->flatMap(function ($dia) {
                return $dia['activities'] ?? [];
            });
    
        if ($todasAsAtividades->isEmpty()) {
            return "Nenhuma atividade encontrada.";
        }
    
        foreach ($todasAsAtividades as $atividade) {
            $resposta = ['activity' => $atividade];
            $pdf = PDF::loadView('nome_da_view_pdf', ['resposta' => $resposta]);
    
            // Salve o PDF em vez de usar o método download
            $pdf->save(storage_path("app/nome_do_arquivo_{$atividade['code']}.pdf"));
        }
    
        return "PDFs gerados com sucesso.";
        
    }

    */

/*
    public function gerarPDF()
    {
        $conteudoJson = file_get_contents(storage_path('app/data.json'));
        $dadosViagem = json_decode($conteudoJson, true);
        $todasAsAtividades = collect($dadosViagem['days'] ?? [])
            ->flatMap(function ($dia) {
                return $dia['activities'] ?? [];
            });

        if ($todasAsAtividades->isEmpty()) {
            return "Nenhuma atividade encontrada.";
        }

        // Crie um diretório temporário para armazenar os PDFs individuais
        $tempDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pdfs_' . uniqid();
        mkdir($tempDir);

        $pdfPaths = [];

        foreach ($todasAsAtividades as $atividade) {
            $dadosAtividade = ['activity' => $atividade];
            $pdf = PDF::loadView('nome_da_view_pdf', ['resposta' => $dadosAtividade]);

            // Salve cada PDF individualmente no diretório temporário
            $pdfPath = $tempDir . DIRECTORY_SEPARATOR . $atividade['code'] . '.pdf';
            $pdf->save($pdfPath);

            $pdfPaths[] = $pdfPath;
        }

        // Crie um arquivo zip contendo todos os PDFs individuais
        $zipFile = $tempDir . '.zip';
        $zip = new ZipArchive;
        $zip->open($zipFile, ZipArchive::CREATE);

        foreach ($pdfPaths as $pdfPath) {
            $zip->addFile($pdfPath, basename($pdfPath));
        }

        $zip->close();

        // Baixe o arquivo zip
        return response()->download($zipFile)->deleteFileAfterSend(true);

        
    }

    */



    public function gerarPDF()
{

  
    
        
        $conteudoJson = file_get_contents(storage_path('app/data.json'));
            
        
        $dadosViagem = json_decode($conteudoJson, true);
            $todasAsAtividades = collect($dadosViagem['days'] ?? [])
                ->flatMap(function ($dia) {
                    return $dia['activities'] ?? [];
                });


        if ($todasAsAtividades->isEmpty()) {
            return "Nenhuma atividade encontrada.";
        }

        

        // Create a temporary directory within Laravel's storage directory
        $tempDir = storage_path('app/temp_pdfs_' . uniqid());     
        mkdir($tempDir);

     

        foreach ($todasAsAtividades as $atividade) {
            $idbooking = $dadosViagem['id'] ?? 'N/A';
            $bookingDate = $dadosViagem['bookingDate'] ?? 'N/A';
            // Obtém a data de início e fim da viagem
            $startDate = $dadosViagem['startDate'] ?? 'N/A';
            $endDate = $dadosViagem['endDate'] ?? 'N/A';
            $resposta = $dadosViagem['endDate'] ?? 'N/A';

           

            // Adiciona informações de datas e atividade ao array $dadosAtividade
            $dadosAtividade = [
                'id' => $idbooking,
                'activity' => $atividade,
                'bookingDate' => $bookingDate,
                'startDate' => $startDate,
                'endDate' => $endDate, 
                

                
            ];

          
            // Determine which view to use based on the presence of specific fields
            if (isset($atividade['tipe']) && $atividade['tipe'] == 'Tour') {
                $rooms = $atividade['rooms'] ?? [];
              
              


                $viewName = 'view_activity_tour';
                $participantsKey = 'participants';
            }
            else{

                $viewName = 'view_activity_acomodation';
                $participantsKey = 'rooms';

            }

            

            
           // Verifique se os participantes existem antes de usá-los
            $participantIds = $atividade[$participantsKey] ?? [];

            $participantDetails = [];
            $participantDetailsAcomodation = [];

          
            foreach ($dadosViagem['participants'] as $participante) {
                if (in_array($participante['id'], $participantIds)) {
                    
            
                $participantDetails[] = $participante;

                
                $participantDetailsAcomodation[] = $participante;
                
            
                }
                
            }
           


            $dadosAtividade['participantDetails'] = $participantDetails;
            $dadosAtividade['participantDetailsAcomodation'] = $participantDetailsAcomodation;

          
           
            $dadosAtividade['viagemDetails'] = [
                'id' => $idbooking,
                'bookingDate' => $bookingDate,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'participants' => $atividade[$participantsKey] ?? [],
                
            ];

            // Check if the view file exists
            if (view()->exists($viewName)) {

            // Load the corresponding Blade view
                
                $pdf = PDF::loadView($viewName, ['resposta' => $dadosAtividade]);
        
                // Save each PDF individually in the temporary directory
                $pdfPath = $tempDir . DIRECTORY_SEPARATOR . $atividade['code'] . '.pdf';
                $pdf->save($pdfPath);
            } 
      
            else {
            // Handle the case where a specific view file is not found
            // For example, you can log an error or take appropriate action
            }
        }

        // Create a zip file containing all individual PDFs
        $zipFile = $tempDir . '.zip';
        $zip = new ZipArchive;
        $zip->open($zipFile, ZipArchive::CREATE);

    

        // Add each PDF to the zip file
        foreach ($todasAsAtividades as $atividade) {
                $pdfPath = $tempDir . DIRECTORY_SEPARATOR . $atividade['code'] . '.pdf';
                $zip->addFile($pdfPath, $atividade['code'] . '.pdf');  
            
        }
        
        $zip->close();
        // Download the zip file
        return response()->download($zipFile)->deleteFileAfterSend(true);
}


}






