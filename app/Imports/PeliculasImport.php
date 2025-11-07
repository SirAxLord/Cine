<?php

namespace App\Imports;

use App\Models\pelicula;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PeliculasImport implements ToModel, WithStartRow
{
    /**
     * Saltar la fila de encabezado si existe.
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Normalizar y evitar filas vacías
        $title = isset($row[0]) ? trim((string)$row[0]) : '';
        $genre = isset($row[1]) ? trim((string)$row[1]) : '';
        $duration = isset($row[2]) ? (int) $row[2] : null;
        $director = isset($row[3]) ? trim((string)$row[3]) : '';

        if ($title === '' && $genre === '' && is_null($duration) && $director === '') {
            return null; // Omitir filas totalmente vacías
        }

        return new pelicula([
            'title'    => $title,
            'genre'    => $genre,
            'duration' => $duration,
            'director' => $director,
        ]);
    }
}
