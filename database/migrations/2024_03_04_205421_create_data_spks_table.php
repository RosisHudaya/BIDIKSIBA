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
        Schema::create('data_spks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->double('C1');
            $table->double('C2');
            $table->double('C3');
            $table->double('C4');
            $table->double('C5');
            $table->double('C6');
            $table->double('C7');
            $table->double('C8');
            $table->double('C9');
            $table->double('C10');
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
        Schema::dropIfExists('data_spks');
    }
};
