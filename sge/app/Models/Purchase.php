<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'supplier_id', 'numero_compra', 'fecha_compra', 'total', 'estado'
    ];

    protected static function booted()
    {
        static::creating(function ($purchase) {
            if (empty($purchase->numero_compra)) {
                $maxId = static::max('id') ?? 0;
                $purchase->numero_compra = 'C-' . str_pad($maxId + 1, 4, '0', STR_PAD_LEFT);
            }
            if (empty($purchase->fecha_compra)) {
                $purchase->fecha_compra = now()->toDateString();
            }
            if (empty($purchase->estado)) {
                $purchase->estado = 'Recibida';
            }
            if (!isset($purchase->total)) {
                $purchase->total = 0;
            }
            if (empty($purchase->supplier_id)) {
                $defaultSupplier = \App\Models\Supplier::first();
                if ($defaultSupplier) {
                    $purchase->supplier_id = $defaultSupplier->id;
                }
            }
        });
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
