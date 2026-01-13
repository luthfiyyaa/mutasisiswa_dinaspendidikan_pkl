<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenjang extends Model
{
  protected $table = 'jenjang';
  protected $primaryKey = 'jenjang_id';

  protected $fillable = [
        'jenjang_nama',
        'jenjang_kode',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the sekolah for the jenjang.
     */
    public function sekolah(): HasMany
    {
        return $this->hasMany(Sekolah::class, 'jenjang_id', 'jenjang_id');
    }
}
