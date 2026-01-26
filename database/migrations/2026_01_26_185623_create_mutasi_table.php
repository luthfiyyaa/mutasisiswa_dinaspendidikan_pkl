<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mutasi', function (Blueprint $table) {
            $table->integer('mutasi_id', false, true)
                ->autoIncrement()
                ->primary();

            // enum('1','2')
            $table->enum('mutasi_jenis', ['1', '2'])->nullable();

            $table->string('mutasi_nama_siswa', 255)->nullable();
            $table->integer('mutasi_sekolah_asal_id')->nullable();
            $table->string('mutasi_sekolah_asal_nama', 255)->nullable();
            $table->string('mutasi_sekolah_asal_alamat', 255)->nullable();
            $table->string('mutasi_sekolah_asal_no_surat', 255)->nullable();

            $table->date('mutasi_tanggal_mutasi')->nullable();
            $table->string('mutasi_nisn', 200)->nullable();
            $table->string('mutasi_noinduk', 200)->nullable();
            $table->string('mutasi_tempat_lahir', 200)->nullable();
            $table->date('mutasi_tanggal_lahir')->nullable();
            $table->string('mutasi_tingkat_kelas', 200)->nullable();
            $table->string('mutasi_nama_wali', 200)->nullable();
            $table->string('mutasi_alamat', 200)->nullable();

            // sekolah tujuan
            $table->integer('mutasi_sekolah_tujuan_id')->nullable();
            $table->string('mutasi_sekolah_tujuan_nama', 255)->nullable();
            $table->string('mutasi_sekolah_tujuan_alamat', 255)->nullable();
            $table->string('mutasi_sekolah_tujuan_no_surat', 255)->nullable();

            $table->date('mutasi_tanggal_surat_diterima')->nullable();

            $table->unsignedBigInteger('jenjang_id')->nullable();

            // enum('0','1')
            $table->enum('mutasi_luar_kota', ['0', '1'])->nullable();

            $table->string('mutasi_kode_scan', 255)->nullable();

            // pejabat
            $table->char('mutasi_pejabat_nip', 50)->nullable();
            $table->string('mutasi_pejabat_nama', 255)->nullable();
            $table->string('mutasi_pejabat_pangkat', 255)->nullable();
            $table->string('mutasi_pejabat_jabatan', 255)->nullable();

            // timestamp legacy
            $table->timestamp('created_at')
                ->nullable()
                ->useCurrentOnUpdate();

            $table->timestamp('updated_at')->nullable();

            // Foreign key
            $table->foreign('jenjang_id')
                ->references('jenjang_id')
                ->on('jenjang')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi');
    }
};
