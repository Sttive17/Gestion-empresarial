<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'codigo', 'nombre', 'descripcion', 
        'precio', 'stock', 'estado',
        'name', 'description', 'price', 'active'
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->codigo)) {
                $maxId = static::max('id') ?? 0;
                $product->codigo = 'PROD-' . str_pad($maxId + 1, 3, '0', STR_PAD_LEFT);
            }
            if (empty($product->estado)) {
                $product->estado = 'Activo';
            }
            if (empty($product->category_id)) {
                $defaultCategory = \App\Models\Category::first();
                if ($defaultCategory) {
                    $product->category_id = $defaultCategory->id;
                }
            }
            if (!isset($product->precio)) {
                $product->precio = 0;
            }
            if (!isset($product->stock)) {
                $product->stock = 0;
            }
        });
    }

    public function getNameAttribute()
    {
        return $this->nombre;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nombre'] = $value;
        if (empty($this->attributes['codigo'])) {
            $this->attributes['codigo'] = 'PROD-' . str_pad((static::max('id') ?? 0) + 1, 3, '0', STR_PAD_LEFT);
        }
    }

    public function getDescriptionAttribute()
    {
        return $this->descripcion;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['descripcion'] = $value;
    }

    public function getPriceAttribute()
    {
        return $this->precio;
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['precio'] = $value;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
