<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = array();

    public function setData($data)
    {
      $this->customer_id = (isset($data->customer_id) ? $data->customer_id : null);
      $this->netto = (isset($data->netto) ? $data->netto : null);
      $this->vat = (isset($data->vat) ? $data->vat : null);
      $this->brutto = (isset($data->brutto) ? $data->brutto : null);
      $this->status_id = (isset($data->status_id) ? $data->status_id : null);
      $this->delivery_mode_id = (isset($data->delivery_mode_id) ? $data->delivery_mode_id : null);
      $this->payment_method_id = (isset($data->payment_method_id) ? $data->payment_method_id : null);
    }

    public function customer(){
      return $this->belongsTo(Customer::class);
    }

    public function status(){
      return $this->belongsTo(Statuses::class);
    }

    public function delivery_mode(){
      return $this->belongsTo(DeliveryMode::class);
    }

    public function payment_method(){
      return $this->belongsTo(PaymentMethod::class);
    }

    public function delivery_adress(){
      return $this->hasOne(DeliveryAdress::class);
    }

    public function invoice_adress(){
      return $this->hasOne(InvoiceAdress::class);
    }

    public function shop_carts(){
      return $this->hasMany(ShopCart::class);
    }
}
