<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmountUnit extends Model
{
    use HasFactory;

    public function product(){
        return $this->hasMany(Product::class);
    }
}
