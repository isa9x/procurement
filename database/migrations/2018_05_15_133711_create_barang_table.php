<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('memo_id')->unsigned()->nullable();
            $table->foreign('memo_id')->references('id')->on('memo')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->string('spesifikasi');
            $table->integer('jumlah')->unsigned()->nullable();
            $table->string('satuan');
            $table->string('keterangan');
            $table->string('status_pi');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('barang');
    }
}
