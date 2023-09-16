<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'ND_MaND' => 'ND_01',
            'name' => 'admin',
            'ND_GioiTinh' => 'Nam',
            'ND_DiaChi' => 'Can Tho',
            'email' => 'admin@gmail.com',
            'password' => '123123',
            'ND_SDT' => '123123',
        ]);
    }
}
