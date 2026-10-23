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
            $table->string('nama', 100);
            $table->string('kecamatan', 100);
            $table->string('desa', 100);
            $table->decimal('tinggi_genangan', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapor_banjirs');
    }
};