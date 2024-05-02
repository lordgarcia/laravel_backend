<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Template</title>
    <style>
        /* Estilos para a logo na capa */
        .logo-container {
            text-align: center;
            margin-top: 20px;
            width: 100%; /* Adicionando largura 100% para centralizar */
        }

        .logo-agencia {
            max-width: 200px;
            margin: 0 auto; /* Adicionando margem automática para centralizar */
            display: block; /* Garante que a margem automática funcione corretamente */
        }

        /* Estilos para a visualização das informações */
        .info-box {
            background-color: #f0f0f0;
            padding: 8px;
            margin-bottom: 8px;
            border-radius: 20px;
        }

        .info-box p {
            margin: 3px 0;
        }

        /* Estilos para o rodapé */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

    .icone {
    width: 20px; /* Ajuste o tamanho conforme necessário */
    height: 20px; /* Ajuste o tamanho conforme necessário */
    vertical-align: middle; /* Alinhar verticalmente com o texto */
    }

    .info-label {
    display: inline-block;
    width: 250px; /* Ou qualquer largura desejada */
    vertical-align: top;
}

.info-data {
    display: inline-block;
    vertical-align: top;
}

.info-separator {
    margin: 0 5px; /* Ajuste a margem conforme necessário */
}

 /* Estilos para a logo na capa */
        .qr-container {
            text-align: right;
            margin-top: 20px;
            width: 100%; /* Adicionando largura 100% para centralizar */
        }

          .qr-code {
            max-width: 150px;
            margin: 0 auto; /* Adicionando margem automática para centralizar */
            display: block; /* Garante que a margem automática funcione corretamente */
        }

       
    </style>
</head>
<body>
    <!-- Página 1: Capa -->
    <div>
        <!-- Container para a capa do PDF -->
        <div class="logo-container">
            <!-- Logo da Agência -->
            <img src="{{ public_path('images/logos/logo.png') }}" alt="Logo da Agência" class="logo-agencia">
        </div>
        <!-- Rodapé da capa -->
        <footer>
            <p>www.bucountrytours.com</p>
        </footer>
    </div>

    <div style="page-break-before: always;">
    <!-- Adicione informações gerais aqui -->
    <div class="logo-container">
        <img src="{{ public_path('images/logos/logo.png') }}" alt="Logo da Agência" class="logo-agencia">
    </div>
    <!-- Espaço maior após a segunda imagem -->
    <div style="margin-top: 40px;"></div>
    @foreach($data['participants'] as $participant)
    <div class="info-box">
        <span class="info-label">NOME DO VIAJANTE PRINCIPAL:</span>
        <span class="info-separator" style="color: green;">|</span>
        <span class="info-data">{{ $participant['name'] }}</span>
    </div>
    @endforeach
    <div class="info-box">
        <span class="info-label">Nº DE VIAJANTES:</span>
        <span class="info-separator" style="color: green;">|</span>
        <span class="info-data">{{ count($data['participants']) }}</span>
    </div>
    <div class="info-box">
        <span class="info-label">DATA DE INÍCIO:</span>
        <span class="info-separator" style="color: green;">|</span>
        <span class="info-data">{{ $data['startDate'] }}</span>
    </div>
    <div class="info-box">
        <span class="info-label">DATA DE TÉRMINO:</span>
        <span class="info-separator" style="color: green;">|</span>
        <span class="info-data">{{ $data['endDate'] }}</span>
    </div>
    <div class="info-box">
        <span class="info-label">DURAÇÃO TOTAL:</span>
        <span class="info-separator" style="color: green;">|</span>
        <span class="info-data">{{ $data['duration'] }} dias</span>
    </div>
    <div class="info-box">
        <span class="info-label">INÍCIO EM:</span>
        <span class="info-separator" style="color: green;">|</span>
        <span class="info-data">{{ $data['sp'] }}</span>
    </div>
    <div class="info-box">
        <span class="info-label">TÉRMINO EM:</span>
        <span class="info-separator" style="color: green;">|</span>
        <span class="info-data">{{ $data['ep'] }}</span>
    </div>
    <!-- Restante das informações -->
</div>

    <!-- Página 3: Itinerário -->
    <div style="page-break-before: always;">
        <!-- Adicione o itinerário aqui -->
        <!-- Adicione o itinerário aqui -->
       <h2 style="text-align: center; color: green;">TRAVEL ITINERARY</h2>
        <table border="0" style="width: 100%; width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: green; height: 30px;">
                <th style="width: 60px;  height: 30px; color: white; font-size: 20px; text-align: center;">DAYS</th>
                <th style="width: 80px;  color: white; font-size: 20px; text-align: center;">DATE</th>
                <th style="width: 128px; color: white; font-size: 20px; text-align: center;">START TIME</th>
                <th style="width: auto;  color: white; font-size: 20px; text-align: left; padding-left: 10px;">DESCRIPTION</th>
            </tr>
        </thead>
        <tbody>
            @php
                $previousDay = null;
            @endphp
            @foreach($data['dropZones'] as $zone)
                @foreach($zone['cards'] as $card)
                    @php
                        $currentDay = $zone['title'];
                    @endphp
                    @if($currentDay !== $previousDay)
                        <tr>
                            <td rowspan="{{ count($zone['cards']) }}" style="<?php echo strpos($zone['title'], 'Dia') === 0 ? 'background-color: #f0f0f0;' : ''; ?>">{{ $currentDay }}</td>
                            <td style="text-align: center;">{{ $zone['data'] }}</td>
                            <td style="text-align: center;">{{ $card['hour'] }}:{{ $card['minute'] }}</td>
                            <td style="padding-left: 10px;">{{ $card['name'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $zone['data'] }}</td>
                            <td>{{ $card['hour'] }}:{{ $card['minute'] }}</td>
                            <td style="padding-left: 10px;">{{ $card['name'] }}</td>
                        </tr>
                    @endif
                    @php
                        $previousDay = $currentDay;
                    @endphp
                @endforeach
            @endforeach
        </tbody>
    </table>
        <!-- Restante do itinerário -->
    </div>


    <!-- Div que cria as paginas -->
       @foreach($data['dropZones'] as $dropZone)
    <div style="page-break-before: always;">
        <div>
            <table>
                <tr>
                    <td><h1 style="color: green;">{{ $dropZone['title'] }} | </h1></td>
                    <td><h2>{{ $dropZone['cards'][0]['name'] }}</h2></td>
                </tr>
            </table>
        </div>

        <!-- Restante das inclusões e exclusões -->
        <div style="margin-top: 50px;"></div>

        <div style="display: flex; justify-content: space-between;">
            @php
                $images = $dropZone['cards'][0]['images']; // Todas as imagens disponíveis
            @endphp
            @foreach($images as $image)
                <img src="{{ $image }}" alt="Imagem" style="width: 32.7%; height: auto; margin-bottom: 10px;">
            @endforeach
        </div>
         <p>{{ $dropZone['cards'][0]['languages'][0]['longDescription'] }}</p>
    </div>

    <!-- Adicionar descrição longa -->


     <!-- Renderizar inclusões -->
        <div>
        <img src="{{ public_path('images/logos/v.png') }}" alt="Visto" class="icone">
        <p style="display: inline-block;"> Inclusões | 
            @foreach($dropZone['cards'][0]['inclusions'] as $index => $inclusion)
                {{ $inclusion }}
                @if($index < count($dropZone['cards'][0]['inclusions']) - 1)
                    |
                @endif
            @endforeach
        </p>
    </div>
        <!-- Renderizar exclusões -->
            <div>
            <img src="{{ public_path('images/logos/x.png') }}" alt="X" class="icone">
            <p style="display: inline-block;"> Exclusões | 
                @foreach($dropZone['cards'][0]['exclusions'] as $index => $exclusion)
                    {{ $exclusion }} <!-- Corrigido $inclusion para $exclusion -->
                    @if($index < count($dropZone['cards'][0]['exclusions']) - 1)
                        |
                    @endif
                @endforeach
            </p>
        </div>
    @endforeach
        </div>

    <!-- Página 5: Inclusões e Exclusões -->
    <div style="page-break-before: always;">
        <!-- Adicione as inclusões e exclusões aqui -->

        <h2 style="text-align: center; color: green;">INCLUDED & EXCLUDED FOODS</h2>

            <table border="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: center;">
                    <th style="width: 100px; background-color: green; height: 30px; color: white; font-size: 20px;">DAYS</th>
                    <th style="width: 100px; background-color: green; color: white; font-size: 20px;">Breakfast</th>
                    <th style="width: 130px; background-color: green; color: white; font-size: 20px;">Lunch</th>
                    <th style="width: auto; background-color: green; color: white; font-size: 20px;">Dinner</th>
                    <th style="width: auto; background-color: green; color: white; font-size: 20px;">Notes</th>
                </tr>
            </thead>
        <tbody>
        @foreach($data['dropZones'] as $dropZone)
            <tr style="text-align: center;">
                <td style="<?php echo strpos($zone['title'], 'Dia') === 0 ? 'background-color: #f0f0f0;' : ''; ?>">{{ $dropZone['title'] }}</td>
                <td>
                    @if($dropZone['breakfast'] == 'Yes')
                        <img src="{{ public_path('images/logos/v.png') }}" alt="Visto" class="icone">
                    @else
                        <img src="{{ public_path('images/logos/x.png') }}" alt="X" class="icone">
                    @endif
                </td>
                <td>
                    @if($dropZone['lunch'] == 'Yes')
                        <img src="{{ public_path('images/logos/v.png') }}" alt="Visto" class="icone">
                    @else
                        <img src="{{ public_path('images/logos/x.png') }}" alt="X" class="icone">
                    @endif
                </td>
                <td>
                    @if($dropZone['dinner'] == 'Yes')
                        <img src="caminho/para/v.png" alt="Visto" class="icone">
                    @else
                        <img src="{{ public_path('images/logos/x.png') }}" alt="X" class="icone">
                    @endif
                </td>
                <td>{{ implode(', ', $dropZone['notas']) }}</td>
            </tr>
        @endforeach
    </tbody>
        </table>

        <!-- Restante das inclusões e exclusões -->

    </div>

            <!-- Página 6: Cancelamentos -->
        <div style="page-break-before: always;">
            <!-- Adicione informações sobre cancelamentos aqui -->
            <div class="logo-container">
                <img src="{{ public_path('images/logos/logo.png') }}" alt="Logo da Agência" class="logo-agencia">
            </div>
        
        @php
            $allInclusions = [];
            $allExclusions = [];

            foreach ($data['dropZones'] as $dropZone) {
                foreach ($dropZone['cards'] as $card) {
                    if (isset($card['inclusions']) && is_array($card['inclusions'])) {
                        $allInclusions = array_merge($allInclusions, $card['inclusions']);
                    }

                    if (isset($card['exclusions']) && is_array($card['exclusions'])) {
                        $allExclusions = array_merge($allExclusions, $card['exclusions']);
                    }
                }
            }

            // Remove duplicatas
            $uniqueInclusions = array_unique($allInclusions);
            $uniqueExclusions = array_unique($allExclusions);
        @endphp

        @if (!empty($uniqueInclusions))
            <h2>
                <span style="border-bottom: 1px solid green;">WHAT'S INCLUDED ?</span>
            </h2>
            @isset($data['accommodation'])
            <p>Accommodation: {{ $data['accommodation'] }} Night(s)</p>
            @endisset

            <p>
            <ul> 
            <img src="{{ public_path('images/logos/v.png') }}" alt="Visto" class="icone"> Meals:
            {{ isset($data['breakfast']) && $data['breakfast'] ? 'Breakfast | ' : 'Breakfast | 0 | ' }}
            {{ isset($data['lunch']) && $data['lunch'] ? 'Lunch | ' : 'Lunch | 0 | ' }}
            {{ isset($data['dinner']) && $data['dinner'] ? 'Dinner' : 'Dinner | 0' }}
            </ul>
            </p>
            <ul>
                @foreach ($uniqueInclusions as $inclusion)
                    <img src="{{ public_path('images/logos/v.png') }}" alt="Visto" class="icone">
                    {{ $inclusion }}<br>
                @endforeach
            </ul>
        @endif

        @if (!empty($uniqueExclusions))
        <h2>
                <span style="border-bottom: 1px solid green;">WHAT'S EXCLUDED ?</span>
            </h2>
            <ul>
                @foreach ($uniqueExclusions as $exclusion)
                    
                    <img src="{{ public_path('images/logos/x.png') }}" alt="Visto" class="icone">
                    {{ $exclusion }}
                @endforeach
            </ul>
        @endif
    </div>

    <div style="page-break-before: always;">
    <h2>
        <span style="border-bottom: 1px solid green;">
            GENERAL CONDITIONS
        </span>
    </h2>
    </div>

    <div style="page-break-before: always;">
        <!-- Adicione informações sobre cancelamentos aqui -->
        <div class="logo-container">
            <img src="{{ public_path('images/logos/logo.png') }}" alt="Logo da Agência" class="logo-agencia">
        </div>
        <h2 style="color: green; text-align: center;">
            Depth of Experience
        </h2>
        <p>We are local experts with in-depth knowlege of your destination. We put our expertise 
        at the service of our partners providing them the highest quality of service possible.
        </p>
        <h2 style="color: green; text-align: center;">
            Integrity & Communication 
        </h2>
         <p>We conduct our business with unwarvering honesty and complete transparency. Our 
         partnerschip is build on a solid foundation of trust and natural success.
        </p>
        <h2 style="color: green; text-align: center;">
           Safety and Security
        </h2>
         <p>Safety is our top priority. We prioritise the well-being of our costumers throughout
         their entire journey. Our risk managment assessment provides essential guidance on health
         and safety measures and offers supports to navigate any potential challenges that may arise.
        </p>
        <h2 style="color: green; text-align: center;">
            24/7 Support
        </h2>
        <p>We offer round-the-clock support to ensure your peace of mind throughout your travels.
        Whether you need assistance with changes, emergency support, or have questions, our 
        dedicated team is always available to help.
        </p>
        <h2 style="color: green; text-align: center;">
           Sustainable Travel
        </h2>
        <p>By booking with us, you contribute to sustainable travel pratices. We minimise our
        environmental impact, promote cultural preservation, and support local communities,
        ensuring your travel have a positive and lasting impact.
        </p>
    </div>

    <div style="page-break-before: always;">
        <div class="logo-container">
            <img src="{{ public_path('images/logos/logo.png') }}" alt="Logo da Agência" class="logo-agencia">
        </div>
        <p style="text-align: center; font-size: 31px;">
            WE LOOK FORWARD TO WELCOMING YOU ON UNFORGETTABLE ADVENTURES ACROSS THE
            ENCHANTING
            <span style="color: green;">CABO VERDE</span> ISLANDS!
        </p>
        <div style="text-align: right;">
            <p>www.bucountrytours.com</p>
            <p>booking@bucountry.com</p>
            <p>@bucountrytours</p>
            <p>(+238) 923 57 28</p>
        </div>
        <div class="qr-container">
            <img src="{{ public_path('images/logos/qr_code.png') }}" alt="Logo da Agência" class="qr-code">
        </div>
       <div class="qr-container">
            <img src="{{ public_path('images/logos/qr_code.png') }}" alt="Logo da Agência" class="qr-code">
        </div>
    </div>
</body>
</html>