<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function setData($data)
    {
        if($data->name) $this->name = $data->name;
        if($data->email) $this->email = $data->email;
        if($data->password) $this->password = \Hash::make($data->password);
    }

    public function getEditForm()
    {
        $optionsRole = '';
        $roles = Role::pluck('name','name')->all();

        foreach($roles as $role):
        //    if($role->id == $this->role_id) continue; 
            $optionsRole.='<option value="'.$role.'">'.$role.'</option>';
        endforeach;

        return '<div class="form-floating mb-2">
                    <input type="text" class="form-control" 
                            name="name" id="editName" placeholder="Név" value="'.$this->name.'" required>
                    <label for="name">Név</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" 
                            name="email" id="editEmail" placeholder="Email cím" value="'.$this->email.'" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" 
                            name="password" id="editPassword" placeholder="Jelszó" required>
                    <label for="password">Jelszó</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" 
                            name="password_confirmation" id="editPassword_confirmation"
                            placeholder="Jelszó megerősítése" required>
                    <label for="password_confirmation">Jelsó megerősítése</label>
                </div>      
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="role" id="editRole" required>
                        <option selected disabled>Kérem válasszon szerepet</option>
                        '.$optionsRole.'
                    </select>
                    <label for="role">Szerep</label>
                </div>';
    }

}
