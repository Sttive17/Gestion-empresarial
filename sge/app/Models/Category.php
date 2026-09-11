<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'name', 'description', 'active'];

    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->nombre)) {
                $category->nombre = 'Nueva Categoría';
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
    }

    public function getDescriptionAttribute()
    {
        return $this->descripcion;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['descripcion'] = $value;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
