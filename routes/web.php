<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryRoomController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListEmployee;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StatisticalController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

//Truy cập trang đăng nhập
Route::get('/login', [AccountController::class, 'Login'])->name("showlogin");

//Gửi yêu cầu đăng nhập
Route::post('/loadLogin', [AccountController::class, 'checkLogin'])->name("loadlogin");

Route::middleware([CheckLogin::class])->group(function () {

    //Truy cập trang chủ
    Route::get('/', [HomeController::class, 'Home'])->name("showhome");

    //Làm mới dữ liệu
    Route::get('/reload', [HomeController::class, 'ReloadHome'])->name("reloadhome");

    //Truy cập trang quản lý loại phòng
    Route::get('/manage/categoryroom', [CategoryRoomController::class, 'CategoryRoom'])->name("showcategoryroom");

    //Truy cập trang tùy chỉnh loại phòng
    Route::get('/setting/categoryroom{id}', [CategoryRoomController::class, 'ShowUpdateCategoryRoom'])->name("showupdatecategoryroom");

    //Xác nhận tùy chỉnh loại phòng
    Route::post('/setting/updatecategoryroom{id}', [CategoryRoomController::class, 'UpdateCategoryRoom'])->name("updatecategoryroom");

    //Xác nhận thêm loại phòng
    Route::post('/setting/addmorecategoryroom', [CategoryRoomController::class, 'AddMoreCategoryRoom'])->name("addmorecategoryroom");

    //Tùy chỉnh tình trạng loại phòng sang hoạt động
    Route::get('/setting/activecategoryroom/{id}', [CategoryRoomController::class, 'ActiveCategoryRoom'])->name("activecategoryroom");

    //Tùy chỉnh tình trạng loại phòng sang không hoạt động
    Route::get('/setting/disablecategoryroom/{id}', [CategoryRoomController::class, 'DisableCategoryRoom'])->name("disablecategoryroom");

    //Truy cập trang quản lý phòng
    Route::get('/manage/room', [RoomController::class, 'Room'])->name("showroom");

    //Truy cập trang tùy chỉnh phòng
    Route::get('/setting/room{id}', [RoomController::class, 'ShowUpdateRoom'])->name("showupdateroom");

    //Xác nhận thêm phòng
    Route::post('/setting/addmoreroom', [RoomController::class, 'AddMoreRoom'])->name('addroom');

    //Xác nhận tùy chỉnh phòng
    Route::post('/setting/updateroom{id}', [RoomController::class, 'UpdateRoom'])->name("updateroom");

    //Tùy chỉnh tình trạng phòng sang hoạt động
    Route::get('/setting/activeroom/{id}', [RoomController::class, 'ActiveRoom'])->name("activeroom");

    //Tùy chỉnh tình trạng phòng sang không hoạt động
    Route::get('/setting/disableroom/{id}', [RoomController::class, 'DisableRoom'])->name("disableroom");

    //Truy cập trang quản lý dịch vụ
    Route::get('/manage/service', [ServiceController::class, 'Service'])->name("showservice");

    //Xác nhận thêm dịch vụ
    Route::post('/manage/addservice', [ServiceController::class, 'AddService'])->name("addservice");

    //Truy cập trang tùy chỉnh dịch vụ
    Route::get('/setting/service{id}', [ServiceController::class, 'ShowUpdateService'])->name("showupdateservice");

    //Xác nhận tùy chỉnh dịch vụ
    Route::post('/setting/updateservice{id}', [ServiceController::class, 'UpdateService'])->name("updateservice");

    //Xác nhận thêm dịch vụ
    Route::post('/manage/addmorerservice', [ServiceController::class, 'AddMoreService'])->name("addmorerservice");

    //Truy cập trang quản lý dịch vụ
    Route::get('/manage/service', [ServiceController::class, 'Service'])->name("showservice");

    //Tùy chỉnh tình trạng dịch vụ sang hoạt động
    Route::get('/setting/activeservice/{id}', [ServiceController::class, 'ActiveService'])->name("activeservice");

    //Tùy chỉnh tình trạng dịch vụ sang không hoạt động
    Route::get('/setting/disableservice/{id}', [ServiceController::class, 'DisableService'])->name("disableservice");

    Route::middleware([CheckUserRole::class])->group(function () {
        //Truy cập trang quản lý nhân viên
        Route::get('/manage/employee', [ListEmployee::class, 'Employee'])->name("showemployee");

        //Truy cập trang tùy chỉnh nhân viên
        Route::get('/setting/employee/{id}', [ListEmployee::class, 'ShowUpdateEmployee'])->name("showupdateemployee");

        //Xác nhận thêm một nhân viên
        Route::post('/setting/addmoreemployee', [ListEmployee::class, 'AddMoreEmployee'])->name("addmoreemployee");

        //Xác nhận tùy chỉnh nhân viên
        Route::post('/setting/updateemployee', [ListEmployee::class, 'UpdateEmployee'])->name("updateemployee");

        //Tùy chỉnh tình trạng nhân viên sang hoạt động
        Route::get('/setting/activeemployee/{id}', [ListEmployee::class, 'ActiveEmployee'])->name("activeemployee");

        //Tùy chỉnh tình trạng nhân viên sang không hoạt động
        Route::get('/setting/disableemployee/{id}', [ListEmployee::class, 'DisableEmployee'])->name("disableemployee");
    });
    //Truy cập trang đặt và nhận phòng
    Route::get('/checkin', [CheckinController::class, 'Checkin'])->name("showcheckin");

    //Truy cập trang thêm mới đặt và nhận phòng
    Route::get('/addcheckin', [CheckinController::class, 'AddCheckin'])->name("showaddcheckin");

    //Xác nhận mới đặt và nhận phòng
    Route::post('/detailcheckin', [CheckinController::class, 'DetailCheckin'])->name("showdetailcheckin");

    //Truy cập trang tùy chỉnh đặt và nhận phòng
    Route::get('/setting/detailcheckin{id}', [CheckinController::class, 'UpdateCheckin'])->name("showupdatedetailcheckin");

    //Truy cập trang chi tiết đặt và nhận phòng
    Route::get('/detailcheckin/{id}/{bill}/{capacity}', [CheckinController::class, 'SaveDetailCheckin'])->name("savedetailcheckin");

    //Tìm kiếm khách trong một checkin
    Route::post('/searchcheckin', [CheckinController::class, 'SearchCheckin'])->name("searchcheckin");

    //Xác nhận thêm một khách hàng
    Route::post('/setting/addmorecustomer', [CheckinController::class, 'AddCustomer'])->name("addmorecustomer");

    //Xác nhận thêm một khách hàng ver2
    Route::get('/setting/addmorecustomer2', [CheckinController::class, 'AddCustomer2'])->name("addmorecustomer2");

    //Xác nhận xóa một khách hàng ra khỏi checkin
    Route::get('/setting/removecustomer', [CheckinController::class, 'RemoveCustomer'])->name("removecustomer");

    //Xác nhận hủy checkin
    Route::get('/setting/cancelcheckin/{id}', [CheckinController::class, 'CancelCheckin'])->name("cancelcheckin");

    //Xác nhận hoàn thành checkin
    Route::get('/setting/confirmcheckin/{id}/{bill}', [CheckinController::class, 'ConfirmCheckin'])->name("confirmcheckin");

    //Truy cập trang trả phòng
    Route::get('/checkout', [CheckoutController::class, 'Checkout'])->name("showcheckout");

    //Truy cập xử lý trả phòng
    Route::get('/manage/detailcheckout/{id}', [CheckoutController::class, 'DetailCheckout'])->name("showdetailcheckout");

    //Xác nhận dịch vụ vào trả phòng
    Route::get('/manage/addservicecheckout/{idCheckout}/{idService}/{price}', [CheckoutController::class, 'AddServiceToCheckout'])->name("addservicecheckout");

    //Xác nhận hủy dịch vụ trong trả phòng
    Route::get('/manage/cancelservicecheckout/{idCheckout}/{idService}', [CheckoutController::class, 'CancelServiceCheckout'])->name("cancelservicecheckout");

    //Xác nhận thanh toán trả phòng
    Route::post('/manage/confirmcheckout', [CheckoutController::class, 'ConfirmCheckout'])->name("confirmcheckout");

    //Xác nhận hủy trả phòng
    Route::post('/manage/cancelcheckout', [CheckoutController::class, 'CancelCheckout'])->name("cancelcheckout");

    //Truy cập trang thống kê tìm kiếm
    Route::get('/searchlog', [StatisticalController::class, 'SearchLog'])->name("showsearchlog");

    //Truy cập trang thống kê tìm kiếm checkin
    Route::get('/searchlogcheckin/{id}', [StatisticalController::class, 'SearchCheckin'])->name("showsearchcheckin");

    //Truy cập trang thống kê tìm kiếm checkout
    Route::get('/searchlogcheckout/{id}', [StatisticalController::class, 'SearchCheckout'])->name("showsearchcheckout");

    //Truy cập trang tài khoản
    Route::get('/account', [AccountController::class, 'Account'])->name("showaccount");

    //Đổi mật khẩu tài khoản
    Route::post('/setting/updatepassword', [AccountController::class, 'UpdatePassword'])->name("updatepassword");

    //Đăng xuất tài khoản
    Route::get('/logout', [AccountController::class, 'Logout'])->name("logout");
});