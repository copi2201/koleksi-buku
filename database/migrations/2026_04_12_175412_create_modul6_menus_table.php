<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modul6_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->string('nama_menu');
            $table->integer('harga');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('modul6_vendors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modul6_menus');
    }
};