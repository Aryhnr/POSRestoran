<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable =[
        'diskon_id',
        'total_harga',
        'bayar',
        'kembalian',
        'status'
    ];
    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id');
    }

    public function detail()
    {
        return $this->hasMany(PesananDetail::class, 'pesanan_id');
    }
}
