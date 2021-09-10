<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    public function setData($product, $image)
    {
        $this->product_id = $product;
        $this->image = $image;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function scopeProductImage($query, $product, $image)
    {
        $query->where('product_id', $product)
            ->where('image', 'LIKE', "%{$image}%");
    }
}
