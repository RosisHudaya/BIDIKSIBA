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
        Schema::create('sesi_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sesi');
            $table->unsignedBigInteger('id_user');
            $table->enum('status', ['sudah', 'belum']);
            $table->foreign('id_sesi')->references('id')->on('sesi_ujians')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('sesi_users');
    }
};
