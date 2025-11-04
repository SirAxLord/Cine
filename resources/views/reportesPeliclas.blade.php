<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reporte de Películas por Sala</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            h1 {
                text-align: center;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h1>Reporte de Películas por Sala</h1>
        @foreach($salas as $sala)
            <h2>Sala: {{ $sala->nombre }}</h2>
            <table>
                <thead>
                    <tr>
                        <th>Título de la Película</th>
                        <th>Horario</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funciones->where('sala_id', $sala->id) as $funcion)
                        @php
                            $pelicula = $peliculas->firstWhere('id', $funcion->pelicula_id);
                        @endphp
                        <tr>
                            <td>{{ optional($pelicula)->titulo ?? '—' }}</td>
                            <td>
                                @if($funcion->fecha)
                                    {{ \Carbon\Carbon::parse($funcion->fecha)->format('d/m/Y H:i') }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if(!is_null($funcion->costo))
                                    ${{ number_format($funcion->costo, 2) }}
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </body>