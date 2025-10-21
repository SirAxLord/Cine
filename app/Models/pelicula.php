<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pelicula extends Model
{
    use SoftDeletes;

    protected $table = 'peliculas';

    protected $fillable = [
        // logical attributes
        'title', 'genre', 'duration', 'director',
        // backing columns
        'titulo', 'genero', 'duracion',
    ];

    // title <-> titulo
    public function getTitleAttribute(): ?string
    {
        return $this->attributes['titulo'] ?? null;
    }

    public function setTitleAttribute($value): void
    {
        $this->attributes['titulo'] = $value;
    }

    // genre <-> genero
    public function getGenreAttribute(): ?string
    {
        return $this->attributes['genero'] ?? null;
    }

    public function setGenreAttribute($value): void
    {
        $this->attributes['genero'] = $value;
    }

    // duration <-> duracion
    public function getDurationAttribute(): ?int
    {
        return $this->attributes['duracion'] ?? null;
    }

    public function setDurationAttribute($value): void
    {
        $this->attributes['duracion'] = $value;
    }
}
