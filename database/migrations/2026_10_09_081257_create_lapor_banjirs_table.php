<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapor_banjirs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor');
            $table->string('no_hp', 15);
            $table->string('lokasi');
            $table->string('kecamatan', 100);
            $table->unsignedInteger('tinggi_air');            // dalam cm
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();               // path foto di storage
            $table->string('status')->default('Menunggu');    // Menunggu / Diproses / Selesai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapor_banjirs');
    }
};