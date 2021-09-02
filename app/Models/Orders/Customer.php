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
      $this->name = (isset($data->name) ? $data->name : null);
      $this->email = (isset($data->email) ? $data->email : null);
      $this->password = (isset($data->password) ? \Hash::make($data->password) : null);
      $this->phone = (isset($data->phone) ? $data->phone : null);
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
