<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pejabat extends Model
{
  protected $table = 'pejabat';
  protected $primaryKey = 'pejabat_id';
  public $incrementing = true;
  protected $keyType = 'int';
  public $timestamps = true;
   protected $fillable = [
        'pejabat_nip',
        'pejabat_nama',
        'pejabat_pangkat',
        'pejabat_jabatan',
    ];

  protected $casts = [
        'pejabat_nip' => 'string',
        'pejabat_nama' => 'string',
        'pejabat_pangkat' => 'string',
        'pejabat_jabatan' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     /**
     * Get jenjang for this pejabat
     */
    public function jenjang(): HasMany
    {
        return $this->hasMany(Jenjang::class, 'pejabat_id', 'pejabat_id');
    }
}
