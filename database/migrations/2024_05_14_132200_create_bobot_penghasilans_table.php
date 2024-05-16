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
        Schema::create('bobot_penghasilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk')->nullable();
            $table->double('penghasilan_ortu');
            $table->double('to_c1');
            $table->double('to_c5');
            $table->double('to_c6');
            $table->double('to_c8');
            $table->double('to_c9');
            $table->double('to_c10');
            $table->foreign('fk')->references('id')->on('bobot_pekerjaans')->restrictOnDelete();
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
        Schema::dropIfExists('bobot_penghasilans');
    }
};
