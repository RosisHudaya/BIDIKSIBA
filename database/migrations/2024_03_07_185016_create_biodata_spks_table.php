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
        Schema::create('biodata_spks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pekerjaan_ortu_id')->nullable();
            $table->string('detail_pekerjaan')->nullable();
            $table->unsignedBigInteger('gaji_ortu_id')->nullable();
            $table->string('slip_gaji')->nullable();
            $table->unsignedBigInteger('luas_tanah_id')->nullable();
            $table->string('shm')->nullable();
            $table->unsignedBigInteger('kamar_id')->nullable();
            $table->string('foto_kmr')->nullable();
            $table->unsignedBigInteger('kamar_mandi_id')->nullable();
            $table->string('foto_kmr_mandi')->nullable();
            $table->unsignedBigInteger('tagihan_listrik_id')->nullable();
            $table->string('slip_tagihan')->nullable();
            $table->unsignedBigInteger('pajak_id')->nullable();
            $table->string('slip_pbb')->nullable();
            $table->unsignedBigInteger('hutang_id')->nullable();
            $table->string('det_hutang')->nullable();
            $table->unsignedBigInteger('saudara_id')->nullable();
            $table->string('surat_ket_sdr')->nullable();
            $table->unsignedBigInteger('status_ortu_id')->nullable();
            $table->string('surat_ket_yatim')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('pekerjaan_ortu_id')->references('id')->on('pekerjaan_ortus')->restrictOnDelete();
            $table->foreign('gaji_ortu_id')->references('id')->on('gaji_ortus')->restrictOnDelete();
            $table->foreign('luas_tanah_id')->references('id')->on('luas_tanahs')->restrictOnDelete();
            $table->foreign('kamar_id')->references('id')->on('jumlah_kamars')->restrictOnDelete();
            $table->foreign('kamar_mandi_id')->references('id')->on('kamar_mandis')->restrictOnDelete();
            $table->foreign('tagihan_listrik_id')->references('id')->on('tagihan_listriks')->restrictOnDelete();
            $table->foreign('pajak_id')->references('id')->on('pajaks')->restrictOnDelete();
            $table->foreign('hutang_id')->references('id')->on('hutangs')->restrictOnDelete();
            $table->foreign('saudara_id')->references('id')->on('saudaras')->restrictOnDelete();
            $table->foreign('status_ortu_id')->references('id')->on('status_ortus')->restrictOnDelete();
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
        Schema::dropIfExists('biodata_spks');
    }
};
