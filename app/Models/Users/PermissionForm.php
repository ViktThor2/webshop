<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionForm extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $fillable = ['name'];

    public function getEditForm()
    {
        return '<div class="form-floating mb-2">
                    <input type="text" class="form-control" 
                            name="name" id="editName" placeholder="Név" value="'.$this->name.'" required>
                    <label for="name">Név</label>
                </div>';
    }
}
