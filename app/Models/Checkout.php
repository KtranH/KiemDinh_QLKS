<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $collection = 'Checkout';
    protected $fillable = ['Booking_Checkin', 'NgayLap', 'ThanhToan', 'DanhSachDichVuDaSuDung'];

    public function bookingCheckin()
    {
        return $this->belongsTo(Checkin::class, 'Booking_Checkin', '_id');
    }
}
