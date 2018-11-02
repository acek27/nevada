<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];

    public function produk()
    {
        return $this->hasMany(produk::class, 'id_kategori', 'id_kategori');
    }
}
