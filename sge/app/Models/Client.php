<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'empresa', 'nit', 'correo', 'telefono', 'ciudad', 'direccion', 'estado',
        'name', 'email', 'phone'
    ];

    protected static function booted()
    {
        static::creating(function ($client) {
            if (empty($client->nit)) {
                $client->nit = 'NIT-' . rand(100000000, 999999999);
            }
            if (empty($client->estado)) {
                $client->estado = 'Activo';
            }
            if (empty($client->direccion)) {
                $client->direccion = 'Calle Principal';
            }
            if (empty($client->ciudad)) {
                $client->ciudad = 'Cartago';
            }
            if (empty($client->telefono)) {
                $client->telefono = '3000000000';
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

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
