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
        Schema::create('tbl_t_user', function (Blueprint $table) {
            $table->bigIncrements('t_user_id');

            $table->unsignedBigInteger('group_id')->nullable();   // tbl_group = bigIncrements
            $table->unsignedInteger('menu_id')->nullable();       // tbl_menu = unsignedInteger

            $table->timestamps();

            $table->foreign('group_id')
                ->references('group_id')
                ->on('tbl_group')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('tbl_menu')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_t_user');
    }
};
