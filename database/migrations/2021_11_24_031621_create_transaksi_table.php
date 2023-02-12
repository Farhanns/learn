<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_outlet');
            $table->string('kode_invoice', 100);
            $table->unsignedBigInteger('id_member');
            $table->datetime('tgl');
            $table->datetime('batas_waktu');
            $table->datetime('tgl_bayar');
            $table->integer('biaya_tambahan')->nullable();
            $table->double('diskon')->nullable();
            $table->integer('pajak')->nullable();
            $table->enum('status', ['baru','proses','selesai','diambil']);
            $table->enum('dibayar', ['dibayar','belum_dibayar']);
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_outlet')->references('id')->on('outlet')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_member')->references('id')->on('member')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
