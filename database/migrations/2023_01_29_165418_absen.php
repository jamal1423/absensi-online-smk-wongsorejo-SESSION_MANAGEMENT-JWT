<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function(Blueprint $table){
            $table->id();
            $table->string('kelas');
            $table->string('nama');
            $table->string('userlog');
            $table->enum('clock_in',['YES','NO']);
            $table->dateTime('tgl_clock_in');
            $table->enum('clock_out',['YES','NO']);
            $table->dateTime('tgl_clock_out');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('lokasi');
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
        Schema::dropIfExists('absen');
    }
};
