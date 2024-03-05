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
            $table->unsignedBigInteger('id_user');
            $table->enum('pekerjaan_ortu', ['Tidak Bekerja', 'Honorer', 'Serabutan', 'Outsourcing', 'Wiraswasta'])->nullable();
            $table->string('detail_pekerjaan')->nullable();
            $table->string('gaji_ortu')->nullable();
            $table->string('slip_gaji')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('shm')->nullable();
            $table->integer('jml_kmr')->nullable();
            $table->string('foto_kmr')->nullable();
            $table->enum('jml_kmr_mandi', ['Memiliki', 'Tidak Memiliki'])->nullable();
            $table->string('foto_kmr_mandi')->nullable();
            $table->enum('tagihan_listrik', ['Tidak Memiliki', '450 Watt', '900 Watt', '1300 Watt'])->nullable();
            $table->string('slip_tagihan')->nullable();
            $table->string('pbb')->nullable();
            $table->string('slip_pbb')->nullable();
            $table->string('jml_hutang')->nullable();
            $table->integer('jml_sdr')->nullable();
            $table->string('surat_ket_sdr')->nullable();
            $table->enum('status_ortu', ['Yatim Piatu', 'Yatim', 'Piatu', 'Tidak Semuanya'])->nullable();
            $table->string('surat_ket_yatim')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->restrictOnDelete();
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
