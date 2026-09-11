<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'empresa', 'nit', 'correo', 'telefono', 'ciudad', 'direccion', 'estado',
        'name', 'email', 'phone'
    ];

    protected static function booted()
    {
        static::creating(function ($supplier) {
            if (empty($supplier->nit)) {
                $supplier->nit = 'NIT-' . rand(100000000, 999999999);
            }
            if (empty($supplier->estado)) {
                $supplier->estado = 'Activo';
            }
            if (empty($supplier->direccion)) {
                $supplier->direccion = 'Calle Principal';
            }
            if (empty($supplier->ciudad)) {
                $supplier->ciudad = 'Cartago';
            }
            if (empty($supplier->telefono)) {
                $supplier->telefono = '3000000000';
            }
        });
    }

    public function getNameAttribute()
    {
        return $this->empresa;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['empresa'] = $value;
    }

    public function getEmailAttribute()
    {
        return $this->correo;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['correo'] = $value;
    }

    public function getPhoneAttribute()
    {
        return $this->telefono;
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['telefono'] = $value;
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
