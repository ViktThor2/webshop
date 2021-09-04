<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $fillable = ['name', 'main_category_id'];

    public function setData($data)
    {
      $this->name = (isset($data->name) ? $data->name : null);
      $this->main_category_id = (isset($data->main_category_id) ? $data->main_category_id : null);
    }

    public function products(){
      return $this->hasMany(Product::class);
    }

    public function main_category(){
      return $this->belongsTo(MainCategory::class);
    }

    public function getEditForm()
    {
      $mainCategories = MainCategory::all();
      $optionsMainCategories = '';

      foreach($mainCategories as $mainCategory):
          if($mainCategory->id == $this->main_category_id) continue;
          $optionsMainCategories.='<option value="'.$mainCategory->id.'">'.$mainCategory->name.' </option>';
      endforeach;
      
      return '<div class="form-floating mb-2">
                  <select class="form-control select2" name="main_category_id" id="editMain_category_id" required>
                      <option  selected>Kérem válasszon főkategóriát</option>
                      <option value="'.$this->main_category->id.'" selected="selected">'.$this->main_category->name.'</option>
                      '.$optionsMainCategories.'
                  </select>
                  <label for="editMain_category_id">Főkategória</label>
              </div>
              <div class="form-floating mb-2">
                <input type="text" class="form-control" name="name" id="editSubName"
                        value="'.$this->name.'" required>
                <label for="editName">Név</label>
              </div>';
  }
}
