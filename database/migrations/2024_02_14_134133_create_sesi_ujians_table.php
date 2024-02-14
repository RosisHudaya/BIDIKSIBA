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
        Schema::create('sesi_ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ujian');
            $table->string('nama_sesi');
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_akhir')->nullable();
            $table->foreign('id_ujian')->references('id')->on('ujians')->restrictOnDelete;
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
        Schema::dropIfExists('sesi_ujians');
    }
};
