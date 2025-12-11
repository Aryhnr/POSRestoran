<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = 'diskon';

    protected $fillable = [
        'nama',
        'persen'
    ];
    public function pesanan(){
        return $this->hasMany(Pesanan::class, 'diskon_id');
    }
}
