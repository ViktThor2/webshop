<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAdress extends Model
{
    use HasFactory;

    protected $table = 'delivery_adresses';
    protected $guarded = array();

    public function setData($data)
    {
      $this->order_id = (isset($data->order_id) ? $data->order_id : null);
      $this->customer_id = (isset($data->customer_id) ? $data->customer_id : null);
      $this->name = (isset($data->name) ? $data->name : null);
      $this->email = (isset($data->email) ? $data->email : null);
      $this->phone = (isset($data->phone) ? $data->phone : null);
      $this->post_code = (isset($data->post_code) ? $data->post_code : null);
      $this->city = (isset($data->city) ? $data->city : null);
      $this->street = (isset($data->street) ? $data->street : null);
      $this->house_number = (isset($data->house_number) ? $data->house_number : null);
    }

    public function order(){
      return $this->belongsTo(Order::class);
    }

    public function customer(){
      return $this->belongsTo(Customer::class);
    }
}
