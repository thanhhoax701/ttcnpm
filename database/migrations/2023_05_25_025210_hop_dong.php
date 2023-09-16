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
        Schema::create('Hop_Dong', function (Blueprint $table) {
            $table->string('HD_MaHD')->primary();
            $table->bigInteger('ND_MaND')->unsigned();
            $table->foreign('ND_MaND')->references('id')->on('users');
            $table->string('T_MaTram');
            $table->foreign('T_MaTram')->references('T_MaTram')->on('Tram');
            $table->string('DV_MaDV');
            $table->foreign('DV_MaDV')->references('DV_MaDV')->on('Don_Vi');
            $table->string('HD_MaCSHT');
            $table->string('T_TenTram');
            $table->date('HD_NgayDangKy');
            $table->date('HD_NgayHetHan');
            $table->date('HD_NgayPhuLuc');
            $table->string('HD_GiaGoc');
            $table->string('HD_GiaHienTai');
            $table->string('HD_SoTaiKhoan');
            $table->string('HD_TenCTK');
            $table->string('HD_TenNH');
            $table->string('HD_TenChuDauTu');
            $table->string('HD_HDScan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Hop_Dong');
    }
};