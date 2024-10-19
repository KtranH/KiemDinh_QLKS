<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class KhachThue extends Model
{
    use HasFactory;
    protected $collection = 'KhachThue'; 
    protected $fillable = ['TenKhachHang', 'CMND', 'SDT'];
    public function bookingCheckins()
    {
        return $this->belongsToMany(Checkin::class, null, 'CMND', 'DanhSachKhachHang');
    }
}
