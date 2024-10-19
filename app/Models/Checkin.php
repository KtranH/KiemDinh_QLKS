<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;
    protected $collection = 'Checkin';
    protected $fillable = ['NhanVienLap', 'Phong', 'NgayCheckin', 'NgayCheckOutDuKien', 'DanhSachKhachHang', 'TinhTrang'];

    public function khachThue()
    {
        return $this->belongsToMany(KhachThue::class, null, 'DanhSachKhachHang', 'CMND'); 
    }
    public function checkout()
    {
        return $this->hasOne(Checkout::class, 'Booking_Checkin', '_id');
    }
}
