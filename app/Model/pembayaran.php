<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_bayar';
    public $timestamps = false;
    public $fillable = ['nama_bank', 'no_rek', 'tgl_bayar', 'bukti_bayar'];

    public function order()
    {
        return $this->belongsTo('App/Model/orderUser', 'id_order', 'id_order');
    }
}
