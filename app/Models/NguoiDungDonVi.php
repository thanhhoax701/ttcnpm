<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguoiDungDonVi extends Model
{
    use HasFactory;

    protected $table = 'nguoi_dung_don_vi';

    protected $primarykey = 'id'; 

    protected $fillable = [
        'id',
        'ND_MaND',
        'DV_MaDV',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->hasOne(User::class, 'ND_MaND', 'ND_MaND');
    }

    public function donvi()
    {
        return $this->hasOne(DonVi::class, 'DV_MaDV', 'DV_MaDV');
    }
}
