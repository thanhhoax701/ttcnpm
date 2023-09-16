<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'ND_MaND',
        'avatar',
        'name',
        'ND_GioiTinh',
        'ND_DiaChi',
        'email',
        'email_verified_at',
        'password',
        'ND_SDT',
        'remember_token'
    ];

    public $timestamps = true;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function quyennguoidungs()
    {
        return $this->hasMany(QuyenNguoiDung::class, 'ND_MaND');
    }
    
    public function hopdongs()
    {
        return $this->hasMany(HopDong::class, 'ND_MaND');
    }

    public function nguoidungdonvis()
    {
        return $this->hasMany(NguoiDungDonVi::class, 'ND_MaND');
    }
}
