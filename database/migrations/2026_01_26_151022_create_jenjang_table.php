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
        Schema::create('jenjang', function (Blueprint $table) {
            $table->bigIncrements('jenjang_id');
            $table->string('jenjang_nama', 100);
            $table->unsignedInteger('bidang_id')->nullable();
            $table->unsignedBigInteger('pejabat_id')->nullable();
            $table->timestamps();

            $table->foreign('bidang_id')
                ->references('bidang_id')
                ->on('bidang')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('pejabat_id')
                ->references('pejabat_id')
                ->on('pejabat')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenjang');
    }
};
