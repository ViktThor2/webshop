<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = ['name' ];

    public function setData($data)
    {
      $this->name = $data->name;
    }

    public function products(){
      return $this->hasMany(Product::class);
    }
}
