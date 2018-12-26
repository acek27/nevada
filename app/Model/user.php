<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password'];

    public function order()
    {
        return $this->hasMany(orderUser::class, 'id_user', 'id_user');
    }

    public function wishlist()
    {
        return $this->hasMany(wishlist::class, 'id_user', 'id_user');
    }
}
