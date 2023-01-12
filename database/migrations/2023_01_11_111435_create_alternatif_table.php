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
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobil_id')->references('id')->on('mobil_bekas')->onDelete('cascade');
            $table->float('tahun_keluar',3,2);
            $table->float('harga',3,2);
            $table->float('model',3,2);
            $table->float('transmisi',3,2);
            $table->float('kapasitas_mesin',3,2);
            $table->float('kapasitas_penumpang',3,2);
            $table->float('konsumsi_bbm',3,2);
            $table->float('ketersediaan_sparepart',3,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternatif');
    }
};
