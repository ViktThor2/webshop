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
      if($data->customer_id) $this->customer_id = $data->customer_id;
      if($data->netto) $this->netto = $data->netto;
      if($data->vat) $this->vat = $data->vat;
      if($data->brutto) $this->brutto = $data->brutto;
      if($data->status_id) $this->status_id = $data->status_id;
      if($data->delivery_mode_id) $this->delivery_mode_id = $data->delivery_mode_id;
      if($data->payment_method_id) $this->payment_method_id = $data->payment_method_id;
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
