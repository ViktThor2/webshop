<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\{Permission};

class RoleForm extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['name'];

    public function getEditForm()
    {
        $optionPermission = '';
        $permissions = Permission::all();
        foreach ($permissions as $permission):
            $optionPermission .= '<option value="'.$permission->id.'">
                                    '.$permission->name.'
                                 </option>';    
        endforeach;

        return '<div class="form-floating mb-2">
                    <input type="text" class="form-control" 
                            name="name" id="editName" placeholder="Név" value="'.$this->name.'" required>
                    <label for="name">Név</label>
                </div>
                <div class="form-group">
                    <div class="select2-purple">
                      <select class="select2" multiple="multiple" style="width: 100%;"
                        data-placeholder="Kérem válasszon jogosultságokat" id="editPermission_id">
                            '.$optionPermission.'
                      </select>
                    </div>';
    }
}
