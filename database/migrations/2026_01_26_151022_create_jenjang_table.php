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
            $table->bigIncrements('jenjang_id'); // ✅ BIGINT UNSIGNED + PK + AUTO_INCREMENT
            $table->string('jenjang_nama', 100);
            $table->unsignedBigInteger('pejabat_id')->nullable();
            $table->timestamps();

            $table->foreign('pejabat_id')
                ->references('pejabat_id')
                ->on('pejabat')
                ->onUpdate('cascade')
                ->onDelete('set null');
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
