<?php

namespace App\Http\Controllers;

use App\Models\LoaiPhong;
use Illuminate\Http\Request;

class CategoryRoomController extends Controller
{
    //

    public function CategoryRoom()
    {
        $listCategoriesRoom = LoaiPhong::all();
        return view('ManageController.CategoryRoom', compact('listCategoriesRoom'));
    }
    public function AddMoreCategoryRoom(Request $request)
    {
        $request->validate([
            'tenloaiphong' => 'required',
            'succhua' => 'required',
            'dientich' => 'required',
            'tienich' => 'required',
            'noithat' => 'required',
            'quydinh' => 'required',
            'mota' => 'required'
        ], 
[
            'tenloaiphong.required' => 'Vui lòng nhập tên loại phòng',
            'succhua.required' => 'Vui lòng nhập sức chứa',
            'dientich.required' => 'Vui lòng nhập diện tích',
            'tienich.required' => 'Vui lòng nhập tiện ích',
            'noithat.required' => 'Vui lòng nhập nội thất',
            'quydinh.required' => 'Vui lòng nhập quy định',
            'mota.required' => 'Vui lòng nhập mô tả'
        ]);

       try
       {
        $categoryRoom = new LoaiPhong();
        $categoryRoom->MaLoai = $request->tenloaiphong;
        $categoryRoom->SucChua = intval($request->succhua);
        $categoryRoom->DienTich = doubleval($request->dientich);
        $categoryRoom->TienIch = $request->tienich;
        $categoryRoom->NoiThat = $request->noithat;
        $categoryRoom->QuyDinh = $request->quydinh;
        $categoryRoom->MoTa = $request->mota;
        $categoryRoom->TinhTrang = 1;
        $categoryRoom->DanhSachPhong = [];
        $categoryRoom->save();

        return redirect()->back()->with('success', 'Thêm thành công');
       }
       catch(\Exception $e)
       {
        return redirect()->back()->with('error', "Có lỗi xảy ra, không thể thêm!");
       }
    }
    public function UpdateCategoryRoom(Request $request, $id)
    {
        $request->validate([
            'tenloaiphong' => 'required',
            'succhua' => 'required',
            'dientich' => 'required',
            'tienich' => 'required',
            'noithat' => 'required',
            'quydinh' => 'required',
            'mota' => 'required'
        ],[
            'tenloaiphong.required' => 'Vui lòng nhập tên loại phòng',
            'succhua.required' => 'Vui lòng nhập sức chứa',
            'dientich.required' => 'Vui lòng nhập diện tích',
            'tienich.required' => 'Vui lòng nhập tiện ích',
            'noithat.required' => 'Vui lòng nhập nội thất',
            'quydinh.required' => 'Vui lòng nhập quy định',
            'mota.required' => 'Vui lòng nhập mô tả'
        ]);

        try
        {
            $categoryRoom = LoaiPhong::where('_id', $id)->firstOrFail();
            foreach ($categoryRoom->DanhSachPhong as $phong) {
                if ($phong['TinhTrang'] == 3 || $phong['TinhTrang'] == 2) {
                    return redirect()->back()->with('error', 'Có lỗi xảy ra, Có 1 phòng trong loại này đang được sử dụng');
                }
            }
            $categoryRoom->MaLoai = $request->tenloaiphong;
            $categoryRoom->SucChua = intval($request->succhua);
            $categoryRoom->DienTich = doubleval($request->dientich);
            $categoryRoom->TienIch = $request->tienich;
            $categoryRoom->NoiThat = $request->noithat;
            $categoryRoom->QuyDinh = $request->quydinh;
            $categoryRoom->MoTa = $request->mota;
            $categoryRoom->save();
            return redirect()->back()->with('success', 'Cập nhật thay đổi thành công');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', "Có lỗi xảy ra, không thể thêm!");
        }
    }
    public function ActiveCategoryRoom($id)
    {
        try
        {
            $check = LoaiPhong::where('_id', $id)->first();
            foreach ($check->DanhSachPhong as $phong) {
                if ($phong['TinhTrang'] == 3 || $phong['TinhTrang'] == 2) {
                    return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, phòng này đang được sử dụng']);
                }
            }
            LoaiPhong::where('_id', $id)->update(['TinhTrang' => 1, '$set' => ['DanhSachPhong.$[].TinhTrang' => 1]]);
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
        }
        catch(\Exception $e)
        {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, không thể thay đổi! ' . $e->getMessage()], 500);
        }
    }
    public function DisableCategoryRoom($id)
    {
        try
        {
            $check = LoaiPhong::where('_id', $id)->first();
            foreach ($check->DanhSachPhong as $phong) {
                if ($phong['TinhTrang'] == 3 || $phong['TinhTrang'] == 2) {
                    return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, phòng này đang được sử dụng']);
                }
            }
            LoaiPhong::where('_id', $id)->update(['TinhTrang' => 0, '$set' => ['DanhSachPhong.$[].TinhTrang' => 0]]);
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
        }
        catch(\Exception $e)
        {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, không thể thay đổi! ' . $e->getMessage()], 500);
        }
    }
    public function ShowUpdateCategoryRoom($id)
    {
        $category_room = LoaiPhong::where('_id', $id)->firstOrFail();
        return view('ManageController.CategoryRoom_Update', compact('category_room'));
    }
}
