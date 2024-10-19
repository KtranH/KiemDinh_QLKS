<?php

namespace App\Http\Controllers;

use App\Models\DichVu;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function Service()
    {
        $service = DichVu::all();
        return view('ManageController.Service', compact('service'));
    }
    public function AddService(Request $request)
    {
        $request->validate([
            'tendv' => 'required',
            'giadv' => 'required',
            'mota' => 'required',
        ],[
            'tendv.required' => 'Vui lòng nhập tên dịch vụ',
            'giadv.required' => 'Vui lòng nhập giá dịch vụ',
            'mota.required' => 'Vui lòng nhập mô tả dịch vụ',
        ]);

        try
        {
            $service = new DichVu();
            $service->TenDichVu = $request->tendv;
            $service->GiaDichVu = Intval($request->giadv);
            $service->MoTa = $request->mota;
            $service->TinhTrang = 1;
            $service->save();

            return redirect()->back()->with('success', 'Thêm dịch vụ thành công');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Thêm dịch vụ thất bại');
        }
    }
    public function UpdateService(Request $request, $id)
    {
        $request->validate([
            'tendv' => 'required',
            'giadv' => 'required',
            'mota' => 'required',
        ],[
            'tendv.required' => 'Vui lòng nhập tên dịch vụ',
            'giadv.required' => 'Vui lòng nhập giá dịch vụ',
            'mota.required' => 'Vui lòng nhập mô tả dịch vụ',
        ]);

        try
        {
            $service = DichVu::where('_id', $id)->firstOrFail();
            $service->TenDichVu = $request->tendv;
            $service->GiaDichVu = Intval($request->giadv);
            $service->MoTa = $request->mota;
            $service->save();
            return redirect()->back()->with('success', 'Cập nhật dịch vụ thành công');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Cập nhật dịch vụ thất bại');
        }
    }
    public function ActiveService($id)
    {
        try
        {
            $service = DichVu::where('_id', $id)->firstOrFail();
            $service->TinhTrang = 1;
            $service->save();
            return response()->json(['success' => true, 'message' => 'Kích hoạt dịch vụ thành công']);
        }
        catch(\Exception $e)
        {
            return response()->json(['success' => false, 'message' => 'Kích hoạt dịch vụ thất bại']);
        }
    }
    public function DisableService($id)
    {
        try
        {
            $service = DichVu::where('_id', $id)->firstOrFail();
            $service->TinhTrang = 0;
            $service->save();
            return response()->json(['success' => true, 'message' => 'Khóa dịch vụ thành công']);
        }
        catch(\Exception $e)
        {
            return response()->json(['success' => false, 'message' => 'Khóa dịch vụ thất bại']);
        }
    }
    public function ShowUpdateService($id)
    {
        $service = DichVu::where('_id', $id)->firstOrFail();
        return view('ManageController.Service_Update', compact('service'));
    }
}
