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
        Schema::create('Nguoi_Dung_Don_Vi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ND_MaND')->unsigned();
            $table->foreign('ND_MaND')->references('id')->on('users');
            $table->string('DV_MaDV');
            $table->foreign('DV_MaDV')->references('DV_MaDV')->on('Don_Vi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Nguoi_Dung_Don_Vi');
    }
};