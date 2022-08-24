<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('meja');
            $table->bigInteger('total');
            $table->bigInteger('bayar')->default(0);
            $table->bigInteger('kembalian')->default(0);
            $table->foreignId('cashier')->nullable();
            $table->text('referensi')->default('-');
            $table->enum('status',['aktif','finish'])->default('aktif');
            $table->enum('waitress',['aktif','finish'])->default('aktif');
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
        Schema::dropIfExists('pemesanans');
    }
}
