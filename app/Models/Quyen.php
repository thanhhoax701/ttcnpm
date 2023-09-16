<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;

    protected $table = 'quyen';
    
    protected $primarykey = 'Q_MaQ'; 

    protected $fillable = [
        'Q_MaQ', 
        'Q_TenQ'
    ];
    public $timestamps = true;

    public function quyennguoidungs()
    {
        return $this->hasMany(QuyenNguoiDung::class, 'Q_MaQ', 'Q_MaQ');
    }
}
