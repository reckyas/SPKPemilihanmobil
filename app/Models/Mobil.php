<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mobil_bekas';
    protected $fillable = ['nama', 'tahun_keluar', 'harga', 'model', 'transmisi', 'kapasitas_mesin', 'kapasitas_penumpang', 'konsumsi_bbm', 'ketersediaan_sparepart', 'gambar'];
}
