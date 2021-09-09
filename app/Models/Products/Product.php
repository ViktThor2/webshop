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
      if($data->name) $this->name = $data->name;
      if($data->netto) $this->netto = $data->netto;
      if($data->vat_sum) $this->vat_sum =  $data->vat_sum;
      if($data->vat_id) $this->vat_id =  $data->vat_id;
      if($data->brutto) $this->brutto =  $data->brutto;
      if($data->main_category_id) $this->main_category_id = $data->main_category_id;
      if($data->sub_category_id) $this->sub_category_id = $data->sub_category_id;
      if($data->brand_id) $this->brand_id = $data->brand_id;
      if($data->amount_unit_id) $this->amount_unit_id = $data->amount_unit_id;
      if($data->description) $this->description = $data->description;
      if($data->active) $this->active = $data->active;
      if($data->qty) $this->qty = $data->qty;
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
