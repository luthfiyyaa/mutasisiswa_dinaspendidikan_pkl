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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->unsignedInteger('sekolah_id')
                ->autoIncrement()
                ->primary();

            $table->unsignedInteger('kecamatan_id')->nullable(); // ✅ FIX
            $table->unsignedBigInteger('jenjang_id')->nullable(); // ⚠️ lihat catatan di bawah

            $table->char('sekolah_npsn', 50)->nullable();
            $table->string('sekolah_nama', 255)->nullable();
            $table->string('sekolah_alamat', 255)->nullable();

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrentOnUpdate();

            $table->timestamp('updated_at')->nullable();

            $table->foreign('kecamatan_id')
                ->references('kecamatan_id')
                ->on('kecamatan')
                ->onDelete('restrict')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('sekolah');
    }
};
