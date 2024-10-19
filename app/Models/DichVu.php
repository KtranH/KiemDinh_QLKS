<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class DichVu extends Model
{
    use HasFactory;

    protected $collection = 'DichVu';

    protected $fillable = [
        'TenDichVu',
        'GiaDichVu',
        'MoTa'
    ];
}
