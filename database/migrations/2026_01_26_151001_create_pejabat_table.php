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
        Schema::create('pejabat', function (Blueprint $table) {
            $table->bigIncrements('pejabat_id'); // BIGINT UNSIGNED
            $table->char('pejabat_nip', 50)->nullable();
            $table->string('pejabat_nama', 255);
            $table->string('pejabat_pangkat', 255)->nullable();
            $table->string('pejabat_jabatan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabat');
    }
};
