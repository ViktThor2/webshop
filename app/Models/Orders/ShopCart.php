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
      $this->order_id = (isset($data->order_id) ? $data->order_id : null);
      $this->product_id = (isset($data->product_id) ? $data->product_id : null);
      $this->product_name = (isset($data->product_name) ? $data->product_name : null);
      $this->product_netto = (isset($data->product_netto) ? $data->product_netto : null);
      $this->product_vat	 = (isset($data->product_vat	) ? $data->product_vat : null);
      $this->product_brutto = (isset($data->product_brutto) ? $data->product_brutto : null);
      $this->product_qty = (isset($data->product_qty) ? $data->product_qty : null);
    }

    public function order(){
      return $this->belongsTo(Order::class);
    }

    public function product(){
      return $this->belongsTo(Product::class);
    }
}
