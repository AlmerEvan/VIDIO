<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'idmenu';  // ini penting!
    public $timestamps = false; // jika tidak pakai timestamp

    // fillable atau guarded sesuai kebutuhan
}
