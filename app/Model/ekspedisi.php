<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ekspedisi extends Model
{
    protected $table = 'ekspedisi';
    protected $primaryKey = 'id_ekspedisi';
    public $timestamps = false;
    protected $fillable = ['nama','telp'];

    public function order()
    {
        return $this->hasMany(orderUser::class,'id_ekspedisi', 'id_ekspedisi');
    }
}
