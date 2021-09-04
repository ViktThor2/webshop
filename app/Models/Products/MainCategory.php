<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $table = 'main_categories';
    protected $fillable = ['name'];

    public function setData($data)
    {
      $this->name = $data->name;
    }

    public function products(){
      return $this->hasMany(Product::class);
    }

    public function sub_categories(){
      return $this->hasMany(SubCategory::class);
    }

    public function getEditForm()
    {
        return '<div class="form-floating mb-2">
                    <input type="text" class="form-control" name="name" id="editMainName"
                             value="'.$this->name.'" required>
                    <label for="editMainName">Név</label>
                </div>';
    }

    public function deleteSub()
    {
      foreach($this->sub_categories as $sub):
        $sub->delete();
      endforeach;
    }
}
