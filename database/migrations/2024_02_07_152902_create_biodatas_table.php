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
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_asal_jurusan');
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_prodi');
            $table->string('nik');
            $table->string('kota_lahir');
            $table->string('tgl_lahir');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('no_telp');
            $table->string('nisn');
            $table->string('asal_sekolah');
            $table->enum('status', ['Pending', 'Diverifikasi', 'Gagal Diverifikasi']);
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
