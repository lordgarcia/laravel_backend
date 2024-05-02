<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura</title>
    <style>
          @page {
            size: auto; /* Define o tamanho da página como automático para ocupar a largura total */
        }
         body {
            font-family: Arial, sans-serif;
            margin: 2px;
            padding: 0;
            font-size: 14px; /* Tamanho de fonte padrão para o corpo do documento */
        }

        .invoice {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            margin: 2px auto; /* Centralize a .invoice na página */
        }

        .header{
            text-align: right;
            padding: 10px;
            background-color: #f2f2f2;
            font-size: 18px; /* Ajuste o tamanho da fonte do cabeçalho e do rodapé conforme necessário */
        }

         .footer {
            text-align: center;
            background-color: #f2f2f2;
            font-size: 18px; /* Ajuste o tamanho da fonte do cabeçalho e do rodapé conforme necessário */
        }

        .customer-info {
            margin-top: 2px;
            margin-bottom: 20px;
            font-size: 16px; /* Ajuste o tamanho da fonte para as informações do cliente */
           
        }

        .invoice-details {
            text-align: left;
            font-size: 14px; /* Ajuste o tamanho da fonte para os detalhes da fatura */
        }

        .separator {
            margin-top: 20px;
            border-top: 1px solid #333;
        }

        .body {
            font-size: 14px; /* Ajuste o tamanho da fonte para o corpo da fatura */
        }

        table {
            width: 100%;
            margin-bottom: 20px;
             /* Ajuste o tamanho da fonte para a tabela */
        }
        th{
            text-align: left;
            border-top: 1px solid #333; /* Adiciona uma borda superior de 2 pixels */
            border-bottom: 1px solid #999; /* Adiciona uma borda inferior de 2 pixels */
            font-size: 14px;
            margin-bottom: 20px;
            

            
            
        }
        td{
            font-size: 13px;
            vertical-align: top;
            align: left;
           
        }

        table {
            border-collapse: collapse;
        }

        .footer {
                                 /* Ajuste o tamanho da fonte para o rodapé */
            text-align: left;
            
        }

        .footer p {
                                 /* Ajuste o tamanho da fonte para o rodapé */
            font-size: 12px;
        }

         /* Estilo para a segunda tabela */
        .second-table {
            margin-top: 20px;
        }

       .referncia{
         width: 100%;

       }


        .referncia table {
            width: 100%;
            border: 0;
             margin-right: 20px;
        
        }  

         .referncia table th, .referncia table td {
            
            text-align: left;
            border: 0;
           
        }

    
        .referncia th {
            width: 55%; /* Defina a largura desejada para as th */
        }

        .referncia td {
            text-align: left;
            width: 100%; /* Defina a largura desejada para as td */
        }

       .referncia table th, .referncia table td {
            text-align: left;
        }

        .smaller-x {
        font-size: 10px; /* Defina o tamanho da fonte desejado para este caso específico */
        }

        .logo-agencia {
            max-width: 200px;
            height: auto;
            float: left;
        }

        th.align-left {
            text-align: left;
        }

        .rodape{
            border: 0px;
        }

        .rodape-confirm{
            text-align: center;
        }

        .rodape-size{
            font-size: 12px;
        }

        .qr-code {
            max-width: 78px;
            height: auto;
            float: right; /* Alterado de left para right */
        }

        .travel-tam{
            width: 140px;
        }

        .travel-tam{
             width: 130px;
        }

         .titulo{
            color: green;
        }

        .tam{
            width: 160px;

        }

        .pik-tam{
           width: 95px; 
        }

        .trans-tam{
            width: 170px; 
        }

        .tam-pax{
            width: 130px; 
        }

        .pik-drop{
            width: 150px; 
        }

    </style>
</head>
<body>

    <div class="invoice">
        <div class="header">
    
        <img src="{{ public_path('images/logos/logo.png') }}" alt="Logo da Agência" class="logo-agencia">

            <h2><i><span class="titulo">Transfer </span> Voucher</i></h2>
    </div>

            <div class="body">
            <!-- Seção de Itens Faturados -->
            <table width="100%">
                <tbody>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

    <div class="referncia">
            <!-- Seção de Itens Faturados -->
        <table width="100%" >
            <tbody>
                <tr>
                    <th>Booking date:</th>
                    <td>{{ htmlspecialchars($resposta['bookingDate'] ?? 'N/A') }}</td>
                
                    <td></td>
                    <td rowspan="4">
                        <img src="{{ public_path('images/logos/qr_code.png') }}" alt="Descrição da Imagem" class="qr-code">
                    </td>
                    
                </tr>
                 
                <tr>
                    <th>Reference No.:</th>
                    <td>{{ htmlspecialchars($resposta['id'] ?? 'N/A') }}</td>
                    
                    <td></td>
                   
                   
                </tr>
                <tr>
                    <th>Voucher No.:</th>
                    <td>{{ isset($resposta['activity']['id']) ? htmlspecialchars($resposta['activity']['id']) : 'N/A' }}</td>
                    
                    <td></td>
                    
                    
                </tr>
                <tr>
                    <th>Product code:</th>
                    <td>{{ isset($resposta['activity']['code']) ? htmlspecialchars($resposta['activity']['code']) : 'N/A' }}</td>
                   
                    <td></td> 
                </tr>
                <!-- Nova linha com a imagem -->
               
            </tbody>
              <tbody>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                     <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                  
                   
                </tbody>
        </table>

    </div>

     
    

    <div class="body">
            <!-- Seção de Itens Faturados -->
        
          
            <table width="100%">

                 <tbody>
                    <tr style="background-color: #f2f2f2;">
                        <td colspan="6" style="color: green; font-size: 17px; font-weight: bold;">
                            {{ isset($resposta['activity']['name']) ? htmlspecialchars($resposta['activity']['name']) : 'N/A' }}
                        </td>
                    </tr>
                </tbody>

                 <tbody>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                </tbody>

              
        
              
                <thead>
                    <tr>
                        <th class="tam">Traveler(s) Name(s)</th>  
                        <th class="tam-pax">No. of Pax:</th> 
                        <th>Veicle Type</th> 
                        <th class="trans-tam">Transfer type</th>   
                        <th>Baggage</th>
                         <th></th>
                        
                    </tr>
                </thead>
           
                
          
                <tbody>
                    <tr>
                        <td>

                            @foreach ($resposta['participants'] as $participant)
                          {{ $participant['name'] }} <br>
                           @endforeach
                         
                        </td>
                        <td>
                             @if (count($resposta['participants']) > 0)
                                {{ count(array_filter($resposta['participants'], function ($participant) {
                                    return $participant['age'] >= 18;
                                })) }}x
                                
                                    {{ count(array_filter($resposta['participants'], function ($participant) {
                                        return $participant['age'] >= 18;
                                    })) > 1 ? 'Adults' : 'Adult' }}
                                

                                {{ count(array_filter($resposta['participants'], function ($participant) {
                                    return $participant['age'] < 18;
                                })) }}x
                            
                                    {{ count(array_filter($resposta['participants'], function ($participant) {
                                        return $participant['age'] < 18;
                                    })) > 1 ? 'Children' : 'Child' }}<br>
                                
                            @else
                                0 x Adult 
                                0 x Child 
                            @endif

                        </td>
                        <td >
                                @foreach ($resposta['activity']['veicleType'] as $category)
                                {{ $category }}<br>
                                @endforeach
                        </td>
                        <td>  @foreach ($resposta['activity']['categories'] as $category)
                                {{ $category }}<br>
                            @endforeach
                        </td> 
                
                        <td >
                            
                        </td>

                        <td >
                      
                          
                        </td>
                       
                        
                    </tr>
                    <!-- Adicione mais linhas conforme necessário -->
                   
                </tbody>
                
                <tbody>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                </tbody>

                <thead>
                    <tr>
                        <th >Transfer Date</th> 
                        <th class="pik-tam">Pick-up time</th> 
                        <th class="pik-drop">Pick-up location</th>
                        <th >Drop-off location</th>
                        <th>Flight nº</th>
                        <th></th>
                       
        
                    </tr>
                </thead>

                 <tbody>
                    <tr>
                        
                        <td>{{ htmlspecialchars($resposta['startDate'] ?? 'N/A') }}</td>
                        <td>{{ $resposta['activity']['pickupTime'] }}</td>
                        <td>{{ $resposta['activity']['pickupLocation'] }}</td>
                        <td>{{ $resposta['activity']['dropoffLocation'] }}</td>
                        <td>{{ $resposta['activity']['numFlight'] }}</td>
                        <td></td>
                        
                        
                       
                        
                    
                    </tr>
                    <!-- Adicione mais linhas conforme necessário -->
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
        </div>

        <div class="body">
         <table width="100%">
         <thead>
                    <tr>
                        <th colspan="6">What's Included</th>
                        
                    </tr>
                </thead>

                <tbody>
                <tr>
                    <td colspan="6">
                       Flight tracking<br>
Pickup and drop-off <br>
One-way private transfer <br>
1-hour waiting time at the airport <br>
24-hour customer service support<br>
Any Parking Fees<br>
Baggage Allowance
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="body">
         <table width="100%">
         <thead>
                    <tr>
                        <th colspan="6">Remarks</th>
                        
                    </tr>
                </thead>

                <tbody>
                <tr>
                    <td colspan="6">
                        In case of flight delay, please let us know to avoid the No-Show.<br>
                        No-Show fee: 100% charged.<br>
                        The driver/Guide will take Your name printed in a board.<br> 
                        Any excessive luggage requirements (more than airlines permit under standard ticket terms) should be declared at the time of booking.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



    <br><br> <br><br>
    <div class="body">
            <!-- Seção de Itens Faturados -->
            <table width="100%" class="footer">
                <thead>
                    <tr>
                        <th >Supplier Address / Telephone</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                </tbody>
           
                <tbody>
                    <tr>
                        <td class="rodape-size">
                            Emergency Number/ Telefone de Emergência: +238 9235728 / Local Office: +238 9209620 / E-mail: info@bucountry.com
                        </td>
                    </tr>
                    <tr>
                        <td class="rodape-size">
                            Address: AV. Cidade de Lisboa, Entrada Bombeiros n.º 2, Fazenda, Praia - Cabo Verde // NIF: 276695208
                        </td>
                    </tr>
                     
                <tbody>
                    <tr>
                        <td colspan="7" style="height: 10px;"></td>
                    </tr>
                </tbody>

                     <tr>
                        <th class="rodape-confirm">
                            Booking Confirmed and guaranteed - Tour
                        </th>
                    </tr>
                    <!-- Adicione mais linhas conforme necessário -->
                </tbody>
            </table>

            <!-- Outras seções do corpo da fatura -->
        </div>

    </div>

</body>
</html>


