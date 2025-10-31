<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class funcion extends Model
{
    use SoftDeletes;

    protected $table = 'funcions';

    protected $fillable = [
        // logical attributes
        'start_time', 'type', 'cost', 'sala_id', 'pelicula_id',
        // backing columns
        'fecha', 'tipo', 'costo',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    protected $appends = [
        'end_time',
    ];

    // start_time <-> fecha (datetime)
    public function getStartTimeAttribute(): ?Carbon
    {
        $value = $this->getAttribute('fecha');
        return $value instanceof Carbon ? $value : ($value ? Carbon::parse($value) : null);
    }

    public function setStartTimeAttribute($value): void
    {
        $this->attributes['fecha'] = $value instanceof Carbon ? $value : ($value ? Carbon::parse($value) : null);
    }

    // type <-> tipo
    public function getTypeAttribute(): ?string
    {
        return $this->attributes['tipo'] ?? null;
    }

    public function setTypeAttribute($value): void
    {
        $this->attributes['tipo'] = $value;
    }

    // cost <-> costo
    public function getCostAttribute(): float|int|null
    {
        if (! array_key_exists('costo', $this->attributes)) {
            return null;
        }
        return is_numeric($this->attributes['costo']) ? $this->attributes['costo'] + 0 : null;
    }

    public function setCostAttribute($value): void
    {
        $this->attributes['costo'] = $value;
    }

    // Relaciones
    public function sala()
    {
        return $this->belongsTo(sala::class);
    }
    public function pelicula()
    {
        return $this->belongsTo(pelicula::class);
    }

    // end_time (calculado): fecha + duración de la película (minutos)
    public function getEndTimeAttribute(): ?Carbon
    {
        $start = $this->start_time;
        if (! $start) {
            return null;
        }
        $duration = $this->pelicula?->duration; // mapeado a 'duracion' en modelo Pelicula
        if (! $duration) {
            return null;
        }
        return (clone $start)->addMinutes((int) $duration);
    }
}

