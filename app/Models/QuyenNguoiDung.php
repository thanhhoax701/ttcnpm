<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyenNguoiDung extends Model
{
    use HasFactory;
    protected $table = 'quyen_nguoi_dung';

    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'Q_MaQ',
        'ND_MaND'
    ];
    public $timestamps = true;

    public function nguoidung()
    {
        return $this->hasOne(HopDong::class, 'ND_MaND', 'ND_MaND');
    }

    public function quyen()
    {
        return $this->hasOne(Quyen::class, 'Q_MaQ', 'Q_MaQ');
    }
}
