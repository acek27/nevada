<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class orderUser extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    public $timestamps = false;
    protected $fillable = ['tgl_pesanan','status','id_produk','id_user'];

    public function produk()
    {
        return $this->belongsTo('App\Model\produk','id_produk','id_produk');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\user','id_user','id_user');
    }
}
