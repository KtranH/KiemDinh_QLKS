<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\DichVu;
use App\Models\KhachThue;
use App\QueryDB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    //
    use QueryDB;
    public function SearchLog()
    {
        $customer = KhachThue::all();
        $checkin = Checkin::where('TinhTrang', 'Đã thanh toán')->orWhere('TinhTrang',  'Đã hủy')->get();
        $checkout = Checkout::where('TinhTrang', 'Đã thanh toán')->orWhere('TinhTrang', 'Đã hủy')->get();
        return view('StatisticalController.SearchLog', compact('customer', 'checkin', 'checkout'));
    }
    public function SearchCheckin($id)
    {
        $checkin = checkin::where("_id", $id)->firstOrFail();
        $takeListCustomer = [];
        foreach($checkin->DanhSachKhachHang as $item)
        {
            $takeListCustomer[] = $this->Find_Customer($item);
        }
        return view('StatisticalController.SearchCheckin', compact('checkin', 'takeListCustomer'));
    }
    public function SearchCheckout($id)
    {
        $checkout = checkout::where("_id", $id)->firstOrFail();
        $service = DichVu::all();
        $duration = Carbon::parse($checkout->bookingCheckin->NgayCheckin)->diffInDays(Carbon::parse($checkout->bookingCheckin->NgayCheckOutDuKien));
        $listServiceInCheckout = [];
        foreach($checkout->DanhSachDichVuDaSuDung as $item)
        {
            $get_service = DichVu::where('_id', $item['DichVu'])->firstOrFail();
            $listServiceInCheckout[] = 
            [
                '_id' => $get_service->_id,
                'TenDichVu' => $get_service->TenDichVu,
                'SoLuong' => $item['SoLuong'],
                'DonGia' => $item['DonGia'],
            ];
        }
        return view('StatisticalController.SearchCheckout', compact('checkout', 'service', 'listServiceInCheckout', 'duration'));
    }
}
