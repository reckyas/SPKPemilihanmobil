<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $table = 'sub_kriteria';
    protected $fillable = ['nama', 'bobot', 'kriteria_id'];
    public $timestamps = false;

    /**
     * Get the kriteria associated with the SubKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kriteria()
    {
        return $this->hasOne(Kriteria::class, 'kriteria_id', 'id');
    }
}
