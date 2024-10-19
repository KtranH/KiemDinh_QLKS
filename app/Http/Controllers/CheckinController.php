<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\KhachThue;
use App\Models\LoaiPhong;
use App\QueryDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckinController extends Controller
{
    //
    use QueryDB;
    public function Checkin()
    {
        $checkIn = Checkin::where('TinhTrang', 'Chờ xác nhận')->orWhere('TinhTrang', 'Đã nhận phòng')->get();
        return view('Checkin_Controller.Checkin', compact('checkIn'));
    }   
    public function AddCheckin()
    {
        $roomAvailable = LoaiPhong::where('TinhTrang', 1)->get();
        return view('Checkin_Controller.NewCheckin', compact('roomAvailable'));
    }
    public function UpdateCheckin($id)
    {
        $checkin = Checkin::where('_id', $id)->firstOrFail();
        $room = $this->Get_Room($checkin->Phong);
        $bill = $this->Number_Of_Days_InHotel($checkin->NgayCheckin, $checkin->NgayCheckOutDuKien) * $room[0]['GiaThue'];
        return redirect()->route('savedetailcheckin', ['id' => $checkin->_id, 'bill' => $bill, 'capacity' => $room[1]['SucChua']]);
    }
    public function CancelCheckin($id)
    {
        $checkin = Checkin::where('_id', $id)->firstOrFail();
        if($checkin->TinhTrang == "Đã nhận phòng")
        {
            return redirect()->back()->with('error', 'Không thể hủy vì đã nhận phòng');
        }
        else
        {
            $checkin->TinhTrang = "Đã hủy";
            $checkin->save();
            $this->Update_State_Available_Room($checkin->Phong);
        }
        return redirect()->route('showcheckin');
    }
    public function ConfirmCheckin($id, $bill)
    {
        $checkin = Checkin::where('_id', $id)->firstOrFail();
        $checkin->TinhTrang = "Đã nhận phòng";
        $checkin->save();

        $this->Update_State_NoAvailable_Room($checkin->Phong);

        $invoice = new Checkout();
        $invoice->Booking_Checkin = $id;
        $invoice->NgayLap = $checkin->NgayCheckOutDuKien;
        $invoice->ThanhToan = doubleval($bill);
        $invoice->TinhTrang = "Chưa thanh toán";
        $invoice->DanhSachDichVuDaSuDung = [];
        $invoice->save();
        return redirect()->route('showcheckin');
    }
    public function DetailCheckin(Request $request)
    {
        $roomAvailable = json_decode($request->input('roomavailable'), true);
        $room = $this->Get_Room($roomAvailable[0]['value']);
        if($room == false)
        {
            return redirect()->back()->with('error', 'Phòng không tồn tại');
        }

        $this->Update_State_Book_Room($roomAvailable[0]['value']);

        $employee = $this->Inf_User(Cookie::get('tokenLogin'));
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        $newCheckin = new Checkin();
        $newCheckin->NhanVienLap = $employee[0]['CMND'];
        $newCheckin->Phong = $roomAvailable[0]['value'];
        $newCheckin->NgayCheckin = $checkin;
        $newCheckin->NgayCheckOutDuKien = $checkout;
        $newCheckin->DanhSachKhachHang = [];
        $newCheckin->TinhTrang = "Chờ xác nhận";
        $newCheckin->save();

        $bill = $this->Number_Of_Days_InHotel($checkin, $checkout) * $room[0]['GiaThue'];
        
        return redirect()->route('savedetailcheckin', ['id' => $newCheckin->_id, 'bill' => $bill, 'capacity' => $room[1]['SucChua']]);
    }
    public function SaveDetailCheckin($id, $bill, $capacity)
    {
        $takeBill = $bill;
        $takeCapacity = $capacity;
        $takeCheckin = Checkin::where('_id', $id)->firstOrFail();
        $takeListCustomer = [];
        foreach($takeCheckin->DanhSachKhachHang as $item)
        {
            $takeListCustomer[] = $this->Find_Customer($item);
        }
        return view('Checkin_Controller.DetailCheckin', compact( 'takeBill', 'takeCapacity', 'takeCheckin', 'takeListCustomer'));
    }
    public function SearchCheckin(Request $request)
    {
        $cmnd = $request->input('makh');
        $result = KhachThue::where('CMND', $cmnd)->get();
        return response()->json($result);
    }
    public function AddCustomer(Request $request)
    {
        if($this->Check_Exist_Customer($request->input('cmnd'), $request->input('sdt')) == false)
        {
            return response()->json(['success' => false, 'message' => 'Lỗi: Khách hàng đã tồn tại không thể thêm mới']);
        }
        else if($this->Check_Capacity($request->input('capacity'), $request->input('idCheckin')) == false)
        {
            return response()->json(['success' => false, 'message' => 'Lỗi: Phòng đã đủ số lượng khách']);
        }
        $newCustomer = new KhachThue();
        $newCustomer->CMND = $request->input('cmnd');
        $newCustomer->TenKhachHang = $request->input('hoten');
        $newCustomer->SDT = $request->input('sdt');
        $newCustomer->save();
        
        $addCustomer = Checkin::where('_id', $request->input('idCheckin'))->firstOrFail();
        $addCustomer->push('DanhSachKhachHang', $newCustomer->CMND);
        $addCustomer->save();

        return response()->json(['success' => true, 'message' => 'Thêm khách hàng thành công', 'customer' => $newCustomer]);
    }
    public function AddCustomer2(Request $request)
    {
        if($this->Check_Customer_Exist_InCheckin($request->input('id'), $request->input('idCheckin')) == false)
        {
            return response()->json(['success' => false, 'message' => 'Lỗi: Khách hàng đã được thêm']);
        }
        else if($this->Check_Capacity($request->input('capacity'), $request->input('idCheckin')) == false)
        {
            return response()->json(['success' => false, 'message' => 'Lỗi: Phòng đã đủ số lượng khách']);
        }
       
        $addCustomer = Checkin::where('_id', $request->input('idCheckin'))->firstOrFail();
        $addCustomer->push('DanhSachKhachHang', $request->input('id'));
        $addCustomer->save();

        $newCustomer = KhachThue::where('CMND', $request->input('id'))->firstOrFail();

        return response()->json(['success' => true, 'message' => 'Thêm khách hàng thành công', 'customer' => $newCustomer]);
    }
    public function RemoveCustomer(Request $request)
    {
        $removeCustomer = Checkin::where('_id', $request->input('idCheckin'))->firstOrFail();
        $removeCustomer->pull('DanhSachKhachHang', $request->input('id'));
        $removeCustomer->save();
        return response()->json(['success' => true, 'message' => 'Xóa khách hàng thành công']);
    }
}
