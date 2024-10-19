<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;


class NguoiDung extends Model
{
    use HasFactory;

    protected $collection = 'NguoiDung';
    protected $fillable = ['TenQuyenHan', 'DanhSachQuyenHan', 'DanhSachTaiKhoan'];

    public function taiKhoans()
    {
        return $this->embedsMany(TaiKhoan::class, 'DanhSachTaiKhoan');
    }
}
