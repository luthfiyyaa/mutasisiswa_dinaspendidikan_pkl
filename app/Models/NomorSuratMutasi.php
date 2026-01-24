<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NomorSuratMutasi extends Model
{ 
    protected $table = 'nomor_surat_mutasi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'mutasi_id',
        'nomor',
        'tanggal',
        'nomor_surat',
    ];

    protected $casts = [
        'mutasi_id' => 'integer',
        'nomor' => 'integer',
        'tanggal' => 'date',
    ];

    /**
     * Get the mutasi that owns the nomor surat
     */
    public function mutasi(): BelongsTo
    {
        return $this->belongsTo(Mutasi::class, 'mutasi_id', 'mutasi_id');
    }

    /**
     * Get formatted nomor surat
     */
    public function getFormattedNomorSuratAttribute(): string
    {
        return $this->nomor_surat;
    }

    /**
     * Scope for current year
     */
    public function scopeCurrentYear($query)
    {
        return $query->whereYear('tanggal', now()->year);
    }
}


