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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable;
            $table->unsignedBigInteger('id_asal_jurusan')->nullable;
            $table->unsignedBigInteger('id_jurusan')->nullable;
            $table->unsignedBigInteger('id_prodi')->nullable;
            $table->string('nik')->nullable;
            $table->string('nama')->nullable;
            $table->string('kota_lahir')->nullable;
            $table->string('tgl_lahir')->nullable;
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable;
            $table->string('no_telp')->nullable;
            $table->string('nisn')->nullable;
            $table->string('asal_sekolah')->nullable;
            $table->enum('status', ['Pending', 'Diverifikasi', 'Gagal Diverifikasi'])->nullable;
            $table->foreign('id_user')->references('id')->on('users')->restrictOnDelete;
            $table->foreign('id_asal_jurusan')->references('id')->on('asal_jurusans')->restrictOnDelete;
            $table->foreign('id_jurusan')->references('id')->on('jurusans')->restrictOnDelete;
            $table->foreign('id_prodi')->references('id')->on('prodis')->restrictOnDelete;
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
        Schema::dropIfExists('biodatas');
    }
};
