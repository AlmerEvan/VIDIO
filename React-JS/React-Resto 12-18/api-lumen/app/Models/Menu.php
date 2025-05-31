<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus'; // pastikan sesuai dengan nama tabel
    protected $primaryKey = 'idmenu';
    public $timestamps = false;

    protected $fillable = [
        'idkategori', 'menu', 'gambar', 'harga'
    ];
}

