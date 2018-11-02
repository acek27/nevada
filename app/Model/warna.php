<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class warna extends Model
{
    protected $table = 'warna';
    protected $primaryKey = 'id_warna';
    protected $fillable = ['warna'];

    public function produk()
    {
        return $this->hasMany(produk::class, 'id_warna', 'id_warna');
    }
}
