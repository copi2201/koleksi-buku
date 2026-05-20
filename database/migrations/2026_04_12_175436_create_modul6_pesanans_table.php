<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modul6_pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan')->unique();
            $table->string('nama_customer');
            $table->integer('total')->default(0);
            $table->string('metode_bayar')->nullable();
            $table->string('status_bayar')->default('pending');
            $table->string('status_pesanan')->default('menunggu');
            $table->string('snap_token')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamp('waktu_bayar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modul6_pesanans');
    }
};