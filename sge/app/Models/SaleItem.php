<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'cantidad', 'precio', 'subtotal'
    ];

    protected static function booted()
    {
        static::creating(function ($item) {
            if (empty($item->cantidad)) {
                $item->cantidad = 1;
            }
            if (!isset($item->precio)) {
                $product = \App\Models\Product::find($item->product_id);
                $item->precio = $product ? $product->precio : 0;
            }
            if (empty($item->subtotal)) {
                $item->subtotal = $item->cantidad * $item->precio;
            }
        });
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
