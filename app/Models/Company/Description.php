<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function setData($name, $description)
    {
        if($name) $this->name = $name;
        if($description) $this->description = $description;
    }

    public function scopeSearch($query, $name)
    {
        $query->where('name', 'LIKE', "%{$name}%");
    }

}
