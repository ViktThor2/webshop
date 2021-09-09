<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;

class ShopCart extends Model
{
    use HasFactory;

    protected $table = 'shop_carts';
    protected $guarded = array();

    public function setData($data)
    {
      if($data->order_id) $this->order_id = $data->order_id;
      if($data->product_id) $this->product_id = $data->product_id;
      if($data->product_name) $this->product_name = $data->product_name;
      if($data->product_netto) $this->product_netto = $data->product_netto;
      if($data->product_vat) $this->product_vat = $data->product_vat;
      if($data->product_brutto) $this->product_brutto = $data->product_brutto;
      if($data->product_qty) $this->product_qty = $data->product_qty;
    }

    public function order(){
      return $this->belongsTo(Order::class);
    }

    public function product(){
      return $this->belongsTo(Product::class);
    }
}
