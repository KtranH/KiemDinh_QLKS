<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\QueryDB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ListEmployee extends Controller
{
    //
    use QueryDB;
    public function Employee()
    {
        $employee = NguoiDung::all();
        return view('ManageController.Employee', compact('employee'));  
    }
    public function AddMoreEmployee(Request $request)
    {
        $request->validate([
            'tennhanvien' => 'required',
            'ngaysinh' => 'required',
            'ngayvaolam' => 'required',
            'cmnd' => 'required',
            'sdt' => 'required',
            'email' => 'required',
            'matkhau' => 'required',
            'diachi' => 'required',
        ],[
            'tennhanvien.required' => 'Vui lòng nhập họ tên',
            'ngaysinh.required' => 'Vui lòng nhập ngày sinh',
            'ngayvaolam.required' => 'Vui lòng nhập ngày vào làm',
            'cmnd.required' => 'Vui lòng nhập căn cước công dân',
            'sdt.required' => 'Vui lòng nhập số điện thoại',
            'email.required' => 'Vui lòng nhập email',
            'matkhau.required' => 'Vui lòng nhập mật khẩu',
            'diachi.required' => 'Vui lòng nhập địa chỉ',
        ]);
        if($this->Check_Date_BirthDay($request->input(key: 'ngaysinh')) == false)
        {
            return redirect()->back()->with('error', 'Ngày sinh không đúng định dạng');
        }
        else if($this->Check_Date_Worked($request->input(key: 'ngayvaolam')) == false)
        {
            return redirect()->back()->with('error', 'Ngày vào làm không đúng định dạng');
        }
        else if($this->Check_Unique_Ver2($request->input(key: 'email'), $request->input(key: 'sdt'), $request->input(key: 'cmnd')) == false)
        {
            return redirect()->back()->with('error', 'Email hoặc SDT đã được sử dụng');
        }
        try
        {
            $employee = NguoiDung::where('_id', $request->input(key: 'tenquyenhan'))->firstOrFail();
            $addEmployee = [
                "TenNhanVien" => $request->input(key: 'tennhanvien'),
                "NgaySinh" => Carbon::parse($request->input(key: 'ngaysinh'))->format('Y-m-d'),
                "NgayVaoLam" => Carbon::parse($request->input(key: 'ngayvaolam'))->format('Y-m-d'),
                "CMND" => $request->input(key: 'cmnd'),
                "SDT" => $request->input(key: 'sdt'),
                "Email" => $request->input(key: 'email'),
                "MatKhau" => Hash::make($request->input(key: 'matkhau')),
                "DiaChi" => $request->input(key: 'diachi'),
                'IsDelete' => 0
            ];

            $employee->push('DanhSachTaiKhoan', $addEmployee);
            $employee->save();
            return redirect()->back()->with('success', 'Thêm nhân viên thành công');
        }   
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Thêm nhân viên thất bại');
        }
    }
    public function UpdateEmployee(Request $request)
    {
        $request->validate([
            'tennhanvien' => 'required',
            'ngaysinh' => 'required',
            'ngayvaolam' => 'required',
            'cmnd' => 'required',
            'sdt' => 'required',
            'email' => 'required',
            'diachi' => 'required',
        ],[
            'tennhanvien.required' => 'Vui lòng nhập họ tên',
            'ngaysinh.required' => 'Vui lòng nhập ngày sinh',
            'ngayvaolam.required' => 'Vui lòng nhập ngày vào làm',
            'cmnd.required' => 'Vui lòng nhập cân cước này',
            'sdt.required' => 'Vui lòng nhập số điện thoại',
            'email.required' => 'Vui lòng nhập email',
            'diachi.required' => 'Vui lòng nhập địa chỉ',
        ]);
        if($this->Check_Date_BirthDay($request->input(key: 'ngaysinh')) == false)
        {
            return redirect()->back()->with('error', 'Ngày sinh không đúng định dạng');
        }
        else if($this->Check_Date_Worked($request->input(key: 'ngayvaolam')) == false)
        {
            return redirect()->back()->with('error', 'Ngày làm việc không đúng định dạng');
        }
        try
        {
            $employee = NguoiDung::where('DanhSachTaiKhoan.Email', $request->input(key: 'email'))->firstOrFail();
            $getEmployeeKey = collect($employee->DanhSachTaiKhoan)->where('Email', $request->input(key: 'email'))->keys()->firstOrFail();

            $data = $this->Check_Exist($request->input(key: 'email'), $request->input(key: 'sdt'), $request->input(key: 'cmnd'), 
            $employee['DanhSachTaiKhoan'][$getEmployeeKey]['Email'], $employee['DanhSachTaiKhoan'][$getEmployeeKey]['SDT'], $employee['DanhSachTaiKhoan'][$getEmployeeKey]['CMND']);
            if($data != null)
            {
                if($this->Check_Unique($data) == false)
                {
                    return redirect()->back()->with('error', 'Email hoặc số điện thoại đã tồn tại');
                }
            }

            $updatedEmployee = [
                "TenNhanVien" => $request->input(key: 'tennhanvien'),
                "NgaySinh" => Carbon::parse($request->input(key: 'ngaysinh'))->format('Y-m-d'),
                "NgayVaoLam" => Carbon::parse($request->input(key: 'ngayvaolam'))->format('Y-m-d'),
                "CMND" => $request->input(key: 'cmnd'),
                "SDT" => $request->input(key: 'sdt'),
                "Email" => $request->input(key: 'email'),
                "MatKhau" => $request->input(key: 'matkhau'),
                "DiaChi" => $request->input(key: 'diachi'),
                'IsDelete' => 0
            ];

            if($request->input('tenquyenhan') != $employee["TenQuyenHan"])
            {
                $employee->pull('DanhSachTaiKhoan', $employee->DanhSachTaiKhoan[$getEmployeeKey]);
                $employee->save();

                $newPostion = NguoiDung::where('_id', $request->input(key: 'tenquyenhan'))->firstOrFail();
                $newPostion->push('DanhSachTaiKhoan', $updatedEmployee);
                $newPostion->save();
            }
            else
            {
                $update = $employee->DanhSachTaiKhoan;
                $update[$getEmployeeKey] = $updatedEmployee;
                $employee->DanhSachTaiKhoan = $update;
    
                $employee->save();
            }
            return redirect()->back()->with('success', 'Cập nhật nhân viên thành công');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Cập nhật nhân viên thất bại' . $e->getMessage());
        }
    }
    public function ActiveEmployee($id)
    {
        try
        {
            $updated = NguoiDung::where('DanhSachTaiKhoan.CMND', $id)
            ->update(['DanhSachTaiKhoan.$.IsDelete' => 0]);
            return response()->json(['success' => true, 'message' => 'Kích hoạt nhân viên thành công']);
        }
        catch(\Exception $e)
        {
            return response()->json(['success' => false, 'message' => 'Kích hoạt nhân viên thất bại']);
        }
    }
    public function DisableEmployee($id)
    {
        try
        {
            $updated = NguoiDung::where('DanhSachTaiKhoan.CMND', $id)
            ->update(['DanhSachTaiKhoan.$.IsDelete' => 1]);
            return response()->json(['success' => true, 'message' => 'Khóa nhân viên thành công']);
        }
        catch(\Exception $e)
        {
            return response()->json(['success' => false, 'message' => 'Khóa nhân viên thất bại' . $e->getMessage()]);
        }
    }
    public function ShowUpdateEmployee($id)
    {
        $employee = $this->Get_User($id);
        if($employee == false)
        {
            return redirect()->back()->with('error', 'Không tìm thấy nhân viên');
        }
        $position = NguoiDung::all();
        return view('ManageController.Employee_Update', compact('employee', 'position'));
    }
}
