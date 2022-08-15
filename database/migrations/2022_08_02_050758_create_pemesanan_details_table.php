<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan');
            $table->foreignId('id_produk');
            $table->string('nama');
            $table->string('meja');
            $table->text('keterangan')->default('-')->nullable();
            $table->bigInteger('jumlah');
            $table->bigInteger('harga');
            $table->bigInteger('total');
            $table->enum('progress', ['cook', 'waitress', 'cashier', 'barista', 'finish'])->default('cook');
            $table->enum('status', ['antri', 'diproses', 'selesai', 'habis'])->default('antri');
            $table->enum('waitress', [0,1])->default(0);
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
        Schema::dropIfExists('pemesanan_details');
    }
}
