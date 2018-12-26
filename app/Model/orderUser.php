<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class orderUser extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    public $timestamps = false;
    protected $fillable = ['no_order', 'nama_penerima', 'tgl_pesanan','alamat', 'no_hp', 'qty', 'total', 'status', 'resi', 'tgl_kirim', 'tgl_diterima', 'id_produk','id_user', 'id_ekpedisi'];

    public function produk()
    {
        return $this->belongsTo('App\Model\produk','id_produk','id_produk');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\user','id_user','id_user');
    }

    public function ekspedisi()
    {
        return $this->belongsTo('App\Model\ekspedisi','id_ekspedisi', 'id_ekspedisi');
    }

    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class, 'id_order', 'id_order');
    }
}
