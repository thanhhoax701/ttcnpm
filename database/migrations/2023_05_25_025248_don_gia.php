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
        Schema::create('Don_Gia', function (Blueprint $table) {
            $table->string('DG_MaDG')->primary();
            $table->string('HD_MaHD');
            $table->foreign('HD_MaHD')->references('HD_MaHD')->on('Hop_Dong');
            $table->string('DG_Thang');
            $table->string('DG_Nam');
            $table->string('DG_Gia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Don_Gia');
    }
};