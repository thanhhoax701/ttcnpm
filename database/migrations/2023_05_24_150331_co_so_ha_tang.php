<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Co_So_Ha_Tang', function (Blueprint $table) {
            $table->string('CSHT_MaCSHT')->primary();
            $table->string('CSHT_TenCSHT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Co_So_Ha_Tang');
    }
};