<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sala extends Model
{
    use SoftDeletes;

    protected $table = 'salas';

    protected $fillable = [
        // lógicos usados en código
        'name', 'capacity', 'sucursal_id',
        // columnas reales
        'nombre', 'capacidad',
    ];

    // name <-> nombre
    public function getNameAttribute(): ?string
    {
        return $this->attributes['nombre'] ?? null;
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['nombre'] = $value;
    }

    // capacity <-> capacidad
    public function getCapacityAttribute(): ?int
    {
        return $this->attributes['capacidad'] ?? null;
    }

    public function setCapacityAttribute($value): void
    {
        $this->attributes['capacidad'] = $value;
    }

    // Relaciones
    public function sucursal()
    {
        return $this->belongsTo(sucursal::class);
    }
}
