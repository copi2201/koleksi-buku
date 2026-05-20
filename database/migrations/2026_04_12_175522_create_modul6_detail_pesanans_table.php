<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modul6_detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesanan_id');
            $table->unsignedBigInteger('menu_id');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('subtotal');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('pesanan_id')
                ->references('id')
                ->on('modul6_pesanans')
                ->onDelete('cascade');

            $table->foreign('menu_id')
                ->references('id')
                ->on('modul6_menus')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modul6_detail_pesanans');
    }
};