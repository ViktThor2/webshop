<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmountUnit extends Model
{
    use HasFactory;

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function setData($data)
    {
        $this->name = $data->name;
    }

    public function getEditForm()
    {
        return '<div class="form-floating mb-2">
                    <input type="text" class="form-control" name="name" id="editName"
                             value="'.$this->name.'" required>
                    <label for="editName">Név</label>
                </div>';
    }
}
