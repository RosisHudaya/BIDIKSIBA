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
        Schema::create('bobot_pajaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk')->nullable();
            $table->double('pajak');
            $table->double('to_c3');
            $table->double('to_c4');
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
        Schema::dropIfExists('bobot_pajaks');
    }
};
