<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id', 'numero_venta', 'fecha_venta', 'total', 'estado'
    ];

    protected static function booted()
    {
        static::creating(function ($sale) {
            if (empty($sale->numero_venta)) {
                $maxId = static::max('id') ?? 0;
                $sale->numero_venta = 'V-' . str_pad($maxId + 1, 4, '0', STR_PAD_LEFT);
            }
            if (empty($sale->fecha_venta)) {
                $sale->fecha_venta = now()->toDateString();
            }
            if (empty($sale->estado)) {
                $sale->estado = 'Completada';
            }
            if (!isset($sale->total)) {
                $sale->total = 0;
            }
            if (empty($sale->client_id)) {
                $defaultClient = \App\Models\Client::first();
                if ($defaultClient) {
                    $sale->client_id = $defaultClient->id;
                }
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
