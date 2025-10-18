<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sucursal extends Model
{
    use SoftDeletes;

    protected $table = 'sucursals';

    protected $fillable = [
        // Logical attributes used in code
        'name', 'address', 'phone', 'director',
        // Backing columns to allow mass-assign in updates when needed
        'nombre', 'direccion', 'telefono',
    ];

    // Attribute mapping: name <-> nombre
    public function getNameAttribute(): ?string
    {
        return $this->attributes['nombre'] ?? null;
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['nombre'] = $value;
    }

    // address <-> direccion
    public function getAddressAttribute(): ?string
    {
        return $this->attributes['direccion'] ?? null;
    }

    public function setAddressAttribute($value): void
    {
        $this->attributes['direccion'] = $value;
    }

    // phone <-> telefono
    public function getPhoneAttribute(): ?string
    {
        return $this->attributes['telefono'] ?? null;
    }

    public function setPhoneAttribute($value): void
    {
        $this->attributes['telefono'] = $value;
    }

    // director stays the same, but ensure it is fillable via fillable above
}
