<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class TaiKhoan extends Model
{
    use HasFactory;
    protected $fillable = ['TenNhanVien', 'NgaySinh', 'NgayVaoLam', 'SDT', 'Email', 'DiaChi', 'CMND', 'MatKhau', 'IsDelete'];
}
