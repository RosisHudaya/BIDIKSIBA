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
        Schema::create('asal_jurusan_pivots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_asal_jurusan');
            $table->unsignedBigInteger('id_jurusan');
            $table->foreign('id_asal_jurusan')->references('id')->on('asal_jurusans')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('cascade');
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
        Schema::dropIfExists('asal_jurusan_pivot');
    }
};
