<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'kategori_id',
        'name',
        'harga',
        'foto'

    ];
    public function kategori(){
        return $this->belongsTo(KategoriMenu::class, 'kategori_id');
    }
    public function pesanandetail(){
        return $this->hasMany(PesananDetail::class, 'menu_id');
    }
}
