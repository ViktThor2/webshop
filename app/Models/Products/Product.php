<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders\ShopCart;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = array();

    public function setData($data)
    {
      $this->name = $data->name ??'';
      $this->netto = $data->netto ??'';
      $this->vat_sum =  $data->vat_sum ??'';
      $this->vat_id =  $data->vat_id ??'';
      $this->brutto =  $data->brutto ??'';
      $this->qty	 = $data->qty ??'';
      $this->main_category_id = $data->main_category_id ??'';
      $this->sub_category_id = $data->sub_category_id ??'';
      $this->brand_id = $data->brand_id ??'';
      $this->amount_unit_id = $data->amount_unit_id ??'';
      $this->description = $data->description ??'';
      $this->active = $data->active ??'';
    }

    public function main_category(){
      return $this->belongsTo(MainCategory::class);
    }

    public function sub_category(){
      return $this->belongsTo(SubCategory::class);
    }

    public function brand(){
      return $this->belongsTo(Brand::class);
    }

    public function shop_carts(){
      return $this->hasMany(ShopCart::class);
    }

    public function vat(){
      return $this->belongsTo(Vat::class);
    }

    public function amount_unit(){
      return $this->belongsTo(AmountUnit::class);
    }
}
