<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'idkategori';  // ini penting!
    public $timestamps = false; // jika tidak pakai timestamp

    // jika kolom bukan auto increment
    // public $incrementing = false;

    // fillable atau guarded sesuai kebutuhan
}
