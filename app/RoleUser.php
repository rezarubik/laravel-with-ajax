<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'user_role';
    protected $fillable = ['id_user', 'id_role'];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_user');
    }

    public function role()
    {
        // return $this->hasMany(RoleUser::class, 'id', 'id_role');
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }
}
