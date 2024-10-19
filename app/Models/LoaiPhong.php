<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class LoaiPhong extends Model
{
    use HasFactory;
    protected $collection = 'LoaiPhong';
    protected $fillable = ['MaLoai', 'SucChua', 'TinhTrang', 'DienTich', 'MoTa', 'NoiThat', 'QuyDinh', 'TienIch', 'DanhSachPhong'];

    public function DS_Phong()
    {
        return $this->embedsMany(Phong::class, 'DanhSachPhong');
    }
}
