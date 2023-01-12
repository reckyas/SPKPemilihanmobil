<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobil_bekas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->year('tahun_keluar');
            $table->double('harga', 11,2);
            $table->enum('model', ['Pick-up', 'Sedan', 'City car', 'SUV', 'MVP']);
            $table->enum('transmisi', ['Manual', 'Automatic']);
            $table->integer('kapasitas_mesin');
            $table->smallInteger('kapasitas_penumpang');
            $table->enum('konsumsi_bbm', ['Boros', 'Sedang', 'Irit']);
            $table->enum('ketersediaan_sparepart', ['Langka', 'Mahal', 'Murah', 'Banyak Tersedia']);
            $table->string('gambar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil_bekas');
    }
};
