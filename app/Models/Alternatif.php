<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';
    protected $fillable = ['mobil_id', 'tahun_keluar', 'harga', 'model', 'transmisi', 'kapasitas_mesin', 'kapasitas_penumpang', 'konsumsi_bbm', 'ketersediaan_sparepart'];

    /**
     * Get the mobil that owns the Alternatif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }
}
