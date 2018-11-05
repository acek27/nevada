<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = false;
    protected $fillable = ['nama_produk', 'harga', 'deskripsi', 'gambar', 'id_size', 'id_warna', 'id_kategori'];

    public function warna()
    {
        return $this->belongsTo('App\Model\warna','id_warna','id_warna');
    }
    public function kategori()
    {
        return $this->belongsTo('App\Model\kategori','id_kategori','id_kategori');
    }
    public function size()
    {
        return $this->belongsTo('App\Model\size','id_size','id_size');
    }

    public function order()
    {
        return $this->hasMany(produk::class, 'id_produk', 'id_produk');
    }
}
