<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun_ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable()->unique();
            $table->string('token')->unique();
            $table->string('password')->unique();
            $table->foreign('id_user')->references('id')->on('users')->restrictOnDelete;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akun_ujians');
    }
};
