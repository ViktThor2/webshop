<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $fillable = ['name', 'main_category_id'];

    public function setData($data)
    {
      $this->name = (isset($data->name) ? $data->name : null);
      $this->main_category_id = (isset($data->main_category_id) ? $data->main_category_id : null);
    }

    public function products(){
      return $this->hasMany(Product::class);
    }

    public function main_category(){
      return $this->belongsTo(MainCategory::class);
    }
}
