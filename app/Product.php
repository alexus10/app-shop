<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // $product->category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // $product->images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // accessor
    public function getFeaturedImageUrlAttribute()
    {
        $featureImage = $this->images()->where('featured', true)->first();

        if(!$featureImage)
            $featureImage = $this->images()->first();

        if($featureImage){
            return $featureImage->url;
        }

        return '/images/products/default.png';
    }
}
