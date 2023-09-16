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
        Schema::create('File_Hop_Dong', function (Blueprint $table) {
            $table->string('F_MaFile')->primary();
            $table->string('HD_MaHD');
            $table->foreign('HD_MaHD')->references('HD_MaHD')->on('Hop_Dong');
            $table->string('F_Loai');
            $table->date('F_NgayTao');
            $table->date('F_NgaySua');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('File_Hop_Dong');
    }
};