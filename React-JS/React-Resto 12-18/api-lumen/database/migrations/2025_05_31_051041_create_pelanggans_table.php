<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->increments('idpelanggan');  // primary key auto-increment
            $table->string('pelanggan');        // nama pelanggan
            $table->string('alamat');            // alamat pelanggan
            $table->string('telp');              // telepon pelanggan
            $table->timestamps();                // created_at & updated_at
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
