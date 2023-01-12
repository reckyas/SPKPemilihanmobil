<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $fillable = ['nama', 'bobot'];
    public $timestamps = false;

    /**
     * Get all of the sub_kriteria for the Kriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_kriteria()
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id', 'id');
    }
}
