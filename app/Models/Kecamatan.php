<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
  protected $table = 'kecamatan';
  protected $primaryKey = 'kecamatan_id';

   protected $fillable = [
        'kecamatan_nama',
        'kecamatan_kode_wilayah',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the sekolah for the kecamatan.
     */
    public function sekolah(): HasMany
    {
        return $this->hasMany(Sekolah::class, 'kecamatan_id', 'kecamatan_id');
    }
}
