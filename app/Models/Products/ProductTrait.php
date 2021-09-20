<?php

namespace App\Models\Products;

trait ProductTrait
{
    public function main_category(){
        return $this->belongsTo(MainCategory::class);
      }
  
      public function sub_category(){
        return $this->belongsTo(SubCategory::class);
      }
  
      public function brand(){
        return $this->belongsTo(Brand::class);
      }
  
      public function vat(){
        return $this->belongsTo(Vat::class);
      }
  
      public function amount_unit(){
        return $this->belongsTo(AmountUnit::class);
      }
  
      public function shop_carts(){
        return $this->hasMany(ShopCart::class);
      }
  
      public function product_images(){
          return $this->hasMany(ProductImage::class);
      }  
}