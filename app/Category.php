<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // validar
    public static $messages = [
        'name.required' => 'El campo categoría es obligatorio.',
        'name.min' => 'El campo categoría requiere mínimo tres caracteres.',
        'description.max' => 'El campo descripción corta no puede contener más de 250 caracteres.'
    ];

    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'max:250'
    ];

    protected $fillable = ['name', 'description'];

    // $category->products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        $featuredProduct = $this->products()->first();
        return $featuredProduct->featured_image_url;
    }
}
