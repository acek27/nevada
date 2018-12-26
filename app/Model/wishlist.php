<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'id_wish';
    public $timestamps = false;
    public $fillable = ['wish', 'id_produk', 'id_user'];

    public function produk()
    {
        return $this->belongsTo('App\Model\produk', 'id_produk', 'id_produk');
    }
    public function user()
    {
        return $this->belongsTo('App\Model\user', 'id', 'id');
    }
}
