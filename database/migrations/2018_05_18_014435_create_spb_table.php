<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spb', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('po_id')->unsigned();
            $table->foreign('po_id')->references('id')->on('po')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_spb')->nullable();
            $table->string('scan_spb')->nullable();
            $table->integer('tanggal_spb')->nullable();
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
        Schema::dropIfExists('spb');
    }
}
