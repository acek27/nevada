<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    protected $table = 'size';
    protected $primaryKey = 'id_size';
    protected $fillable = ['size'];

    public function produk()
    {
        return $this->hasMany(produk::class, 'id_size', 'id_size');
    }
}
