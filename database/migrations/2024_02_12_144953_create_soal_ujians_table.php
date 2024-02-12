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
        Schema::create('soal_ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ujian');
            $table->string('soal');
            $table->string('jawaban_a');
            $table->string('jawaban_b');
            $table->string('jawaban_c');
            $table->string('jawaban_d');
            $table->string('jawaban_benar');
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
        Schema::dropIfExists('soal_ujians');
    }
};
