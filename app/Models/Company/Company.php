<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = [
        'name', 'email', 'phone', 'tax', 'tax_vat', 
        'tax_country', 'zip', 'street', 'house_number'
    ];

    public function setData($data)
    {
        if($data->name) $this->name = $data->name;
        if($data->email) $this->email = $data->email;
        if($data->phone) $this->phone = $data->phone;
        if($data->tax) $this->tax = $data->tax;
        if($data->tax_vat) $this->tax_vat = $data->tax_vat;
        if($data->tax_country) $this->tax_country = $data->tax_country;
        if($data->zip) $this->zip = $data->zip;
        if($data->city) $this->city = $data->city;
        if($data->street) $this->street = $data->street;
        if($data->house_number) $this->house_number = $data->house_number;
    }
}
