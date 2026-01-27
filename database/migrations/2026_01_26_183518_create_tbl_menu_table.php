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
        Schema::create('tbl_menu', function (Blueprint $table) {
            $table->unsignedInteger('menu_id')
                ->autoIncrement()
                ->primary();

            $table->string('menu_nama', 200);
            $table->string('menu_link', 200)->nullable();
            $table->unsignedInteger('menu_id_parent')->nullable(); // ✅ FIX

            $table->timestamp('created_at')
                ->useCurrent()
                ->useCurrentOnUpdate();

            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_menu');
    }
};
