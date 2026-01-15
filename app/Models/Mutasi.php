<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mutasi extends Model
{
    protected $table = 'mutasi';
    protected $primaryKey = 'mutasi_id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mutasi_jenis',
        'mutasi_nama_siswa',
        'mutasi_sekolah_asal_id',
        'mutasi_sekolah_asal_nama',
        'mutasi_sekolah_asal_alamat',
        'mutasi_sekolah_asal_no_surat',
        'mutasi_tanggal_mutasi',
        'mutasi_nisn',
        'mutasi_noinduk',
        'mutasi_tempat_lahir',
        'mutasi_tanggal_lahir',
        'mutasi_tingkat_kelas',
        'mutasi_nama_wali',
        'mutasi_alamat',
        'mutasi_sekolah_tujuan_id',
        'mutasi_sekolah_tujuan_nama',
        'mutasi_sekolah_tujuan_alamat',
        'mutasi_sekolah_tujuan_no_surat',
        'mutasi_tanggal_surat_diterima',
        'jenjang_id',
        'mutasi_luar_kota',
        'mutasi_kode_scan',
        'mutasi_pejabat_nip',
        'mutasi_pejabat_nama',
        'mutasi_pejabat_pangkat',
        'mutasi_pejabat_jabatan',
        'mutasi_status',
        'mutasi_keterangan',
    ];
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'mutasi_tanggal_lahir' => 'date',
        'mutasi_tanggal_mutasi' => 'date',
        'mutasi_tanggal_surat_diterima' => 'date',
        'mutasi_sekolah_asal_id' => 'integer',
        'mutasi_sekolah_tujuan_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     // ============================================
    // TAMBAHKAN RELATIONSHIPS INI
    // ============================================

    /**
     * Get the sekolah asal (HARUS ADA INI!)
     */
    public function sekolahAsal(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'mutasi_sekolah_asal_id', 'sekolah_id');
    }

    /**
     * Get the sekolah tujuan (HARUS ADA INI!)
     */
    public function sekolahTujuan(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'mutasi_sekolah_tujuan_id', 'sekolah_id');
    }

    /**
     * Get the jenjang
     */
    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id', 'jenjang_id');
    }

    /**
     * Get the nomor surat
     */
    public function nomorSurat(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(NomorSuratMutasi::class, 'mutasi_id', 'mutasi_id');
    }

    // ============================================
    // SCOPES
    // ============================================

    /**
     * Scope untuk mutasi masuk
     */
    public function scopeMasuk($query)
    {
        return $query->where('mutasi_jenis', 1);
    }

    /**
     * Scope untuk mutasi keluar
     */
    public function scopeKeluar($query)
    {
        return $query->where('mutasi_jenis', 2);
    }

    /**
     * Scope untuk search siswa
     */
    public function scopeSearchSiswa($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('mutasi_nama_siswa', 'like', "%{$keyword}%")
              ->orWhere('mutasi_noinduk', 'like', "%{$keyword}%")
              ->orWhere('mutasi_nisn', 'like', "%{$keyword}%");
        });
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    /**
     * Generate unique QR code
     */
    public static function generateQrCode(): string
    {
        do {
            $code = 'MTS-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));
        } while (self::where('mutasi_kode_scan', $code)->exists());

        return $code;
    }

    /**
     * Constants untuk jenis mutasi
     */
    public const JENIS_MASUK = 1;
    public const JENIS_KELUAR = 2;
    
}