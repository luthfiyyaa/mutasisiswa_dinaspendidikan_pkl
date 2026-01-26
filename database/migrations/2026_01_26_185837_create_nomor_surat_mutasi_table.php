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
        Schema::create('nomor_surat_mutasi', function (Blueprint $table) {
            $table->unsignedInteger('no_id')
                ->autoIncrement()
                ->primary();

            // 🔑 FIX UTAMA
            $table->unsignedInteger('mutasi_id')->nullable();

            $table->integer('nomor')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nomor_surat', 255)->nullable();

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrentOnUpdate();

            $table->timestamp('updated_at')->nullable();

            $table->foreign('mutasi_id')
                ->references('mutasi_id')
                ->on('mutasi')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomor_surat_mutasi');
    }
};
