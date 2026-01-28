<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'bidang';
    protected $primaryKey = 'bidang_id';
    protected $fillable = ['bidang_nama'];
    
    /**
     * Relasi ke jenjang (one to many)
     */
    public function jenjang()
    {
        return $this->hasMany(Jenjang::class, 'bidang_id', 'bidang_id');
    }
}