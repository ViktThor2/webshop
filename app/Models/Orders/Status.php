<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';
    protected $fillable = ['name'];

    public function setData($data)
    {
      $this->name = $data->name;
    }

    public function orders(){
      return $this->hasMany(Order::class);
    }
}
