<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\QueryDB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    use QueryDB;
    public function Account()
    {
        $user = $this->Inf_User(Cookie::get('tokenLogin'));
        return view('AccountController.Account', compact('user'));
    }
    public function Login()
    {
        return view('AccountController.Login');
    }
    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->Inf_User($email);

        if (!$user) {
            return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
        }
        if (!Hash::check($password, $user[0]["MatKhau"])) {
            return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
        }
        $cookie = Cookie::make('tokenLogin', $user[0]["Email"], 0);
        return redirect()->route('showhome')->withCookie($cookie);
    }
    public function Logout()
    {
        Auth::logout();
        Cookie::forget('tokenLogin');
        return redirect()->route('showlogin');
    }
    public function UpdatePassword(Request $request)
    {
        $user = NguoiDung::where('DanhSachTaiKhoan.Email', Cookie::get('tokenLogin'))->firstOrFail();
        $getUserKey = collect($user->DanhSachTaiKhoan)->keys()->firstOrFail();
        if($request->input('newPassword') != $request->input('renewPassword'))
        {
            return response()->json(['success' => false, 'message' => 'Mật khẩu nhập lại không đúng!']);
        }
        else if(!Hash::check($request->input('currentPassword'), $user->DanhSachTaiKhoan[$getUserKey]['MatKhau']))
        {
            return response()->json(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng!']);
        }
        else
        {
            NguoiDung::where('DanhSachTaiKhoan.Email', Cookie::get('tokenLogin'))->update(['DanhSachTaiKhoan.$.MatKhau' => Hash::make($request->input('newPassword'))]);
            return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
        }
    }

    public function Setting()
    {
        return view('AccountController.Setting');
    }
}
