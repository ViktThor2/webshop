<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders\ShopCart;

class Product extends Model
{
    use HasFactory, ProductTrait;
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

    public function scopeSearch($query, $data)
    {
      if ($data->search_main_category) {
        $query->where('main_category_id', $data->search_main_category);
      }

      if ($data->search_sub_category) {
        $query->where('sub_category_id', $data->search_sub_category);
      }

      if ($data->search_brand) {
        $query->where('brand_id', $data->search_brand);
      }

      if( $data->search_min_price || $data->search_max_price ) {
          $priceMin = $data->search_min_price ? : 0;
          $priceMax = $data->search_max_price ? : static::max('brutto');
          $query->whereBetween('brutto', [$priceMin, $priceMax]);
      }
    } 

    public function getTableColumns()
    {
        $this->main_category_id = $this->main_category->name ??'';
        $this->sub_category_id = $this->sub_category->name ??'';
        $this->brand_id = $this->brand->name ??'';
        $this->qty .= ' ' .$this->amount_unit->name;
        $this->netto = number_format($this->netto, 2, ',', '.'). ' Ft';
        $this->brutto = number_format($this->brutto, 2, ',', '.'). ' Ft';
        $this->vat_sum = number_format($this->vat_sum, 2, ',', '.'). ' Ft (' .$this->vat_id. '%)';
        $this->image1 = $this->product_images[0]->image ??'';
        $this->image2  = $this->product_images[1]->image ??'';
        $this->image3  = $this->product_images[2]->image ??'';
        $this->image4  = $this->product_images[3]->image ??'';
    }
  
}