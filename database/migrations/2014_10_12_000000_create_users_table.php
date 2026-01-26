<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->nullable();

            $table->string('name');
            $table->string('email')->index();
            $table->string('password');
            $table->string('users_email', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('group_id')
                ->references('group_id')
                ->on('tbl_group')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
