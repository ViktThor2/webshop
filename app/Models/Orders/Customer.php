<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = ['name', 'email', 'password', 'phone' ];

    public function setData($data)
    {
      if($data->name) $this->name = $data->name;
      if($data->email) $this->email = $data->email;
      if($data->password) $this->password = \Hash::make($data->password);
      if($data->phone) $this->phone = $data->phone;
    }

    public function orders(){
      return $this->hasMany(Order::class);
    }

    public function delivery_adress(){
      return $this->hasOne(DeliveryAdress::class);
    }

    public function invoice_adress(){
      return $this->hasOne(InvoiceAdress::class);
    }
}
