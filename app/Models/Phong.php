<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;
    protected $fillable = ['MaPhong', 'TenPhong', 'ViTri', 'GiaThue', 'TinhTrang'];
}
