<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceAdress extends Model
{
    use HasFactory;

    protected $table = 'invoice_adresses';
    protected $guarded = array();

    public function setData($data)
    {
      if($data->order_id) $this->order_id = $data->order_id;
      if($data->customer_id) $this->customer_id = $data->customer_id;
      if($data->name) $this->name = $data->name;
      if($data->email) $this->email = $data->email;
      if($data->phone) $this->phone = $data->phone;
      if($data->post_code) $this->post_code = $data->post_code;
      if($data->city) $this->city = $data->city;
      if($data->street) $this->street = $data->street;
      if($data->house_number) $this->house_number = $data->house_number;
    }

    public function order(){
      return $this->belongsTo(Order::class);
    }

    public function customer(){
      return $this->belongsTo(Customer::class);
    }
}
