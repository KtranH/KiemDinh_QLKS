@extends('container')
@section('content')
    <!-- Link icon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <title>GTX - Quản lý trả phòng</title>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Xử lý trả phòng</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item">Trả phòng</li>
                    <li class="breadcrumb-item active">Xử lý trả phòng</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section profile">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div style="display:flex;">
                            <div style="width:60%">
                                <div class="col-12">
                                    <div class="card" style="border-radius:20px">
                                        <div class="card-body">
                            
                                            <h5 class="card-title"
                                                style="font-family: 'Montserrat', sans-serif;
                                                font-optical-sizing: auto;
                                                font-weight: 600;
                                                font-style: normal;">
                                                Dịch vụ<span>/Danh sách dịch vụ</span>
                                            </h5>
                                            <div class="row bg-white" style="padding:20px;border-radius:20px;width:100%;display:flex;justify-content: space-between;">
                                                <table class="table table-borderless datatable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Mã dịch vụ</th>
                                                            <th scope="col">Tên dịch vụ</th>
                                                            <th scope="col">Đơn giá</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($service as $item)
                                                            <tr id="service-{{ $item->_id }}">
                                                                <th scope="row"><a href="#">{{ $item->_id }}</a></th>
                                                                <td>{{ $item->TenDichVu }}</td>
                                                                <td>{{ $item->GiaDichVu }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Recent Sales -->
                            </div>
                            <div style="width:40%; margin-left:30px">
                                <div class="col-12">
                                    <div class="card" style="border-radius:20px">
                                        <div class="card-body">
                                            <h5 class="card-title"
                                                style="font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: 600;
                                font-style: normal;">
                                                Chi tiết<span>/Các dịch vụ</span></h5>
                                            <div class="row bg-white"
                                                style="padding:20px;border-radius:20px;width:100%;display:flex;justify-content: space-between;">

                                                <table class="table" id="ServiceTable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tên dịch vụ</th>
                                                            <th scope="col">Số lượng</th>
                                                            <th scope="col">Tổng tiền</th>
                                                            <th scope="col">Chức năng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($listServiceInCheckout as $item)
                                                            <tr>
                                                                <th scope="row">{{ $item['TenDichVu'] }}</th>
                                                                <td>{{ $item['SoLuong'] }}</td>
                                                                <td>{{ $item['DonGia'] }}</td>
                                                                <td>
                                                                    <a href="{{ route('cancelservicecheckout', ['idCheckout' => $checkout->_id, 'idService' => $item['_id']]) }}" class="btn" 
                                                                            style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:red">
                                                                        <i class="fi fi-br-cross "></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <p>Thời gian: <span style="font-weight:bold">{{ $checkout->bookingCheckin->NgayCheckin }}</span> tới <span style="font-weight:bold">{{ $checkout->bookingCheckin->NgayCheckOutDuKien }}</span> 
                                                            tổng cộng:
                                                            <span style="font-weight:bold">{{ $duration }} Ngày</span></p>
                                                    <p>Tiền phòng: <span style="font-weight:bold">{{ number_format($checkout->ThanhToan, 0, ',', '.') }} VNĐ</span></p>
                                                </table>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="card" style="border-radius:20px">
                                        <div class="card-body">
                                            <h5 class="card-title"
                                                style="font-family: 'Montserrat', sans-serif;
                                                font-optical-sizing: auto;
                                                font-weight: 600;
                                                font-style: normal;">
                                                Thanh toán cho phòng: <span style="font-weight:bold">{{ $checkout->bookingCheckin->Phong }}</span>
                                            </h5>

                                            <h5 class="card-title"
                                                style="font-family: 'Montserrat', sans-serif;
                                                font-optical-sizing: auto;
                                                font-weight: 600;
                                                font-style: normal;">
                                                Tổng tiền<span>/{{ $checkout->TinhTrang }}</span></h5>
                                            <div class="row bg-white"
                                                style="padding:20px;border-radius:20px;width:100%;display:flex;justify-content: space-between;">

                                                <p style="display:flex; justify-content: space-between;margin-bottom:30px; font-weight:bold">
                                                    <span style="font-weight:bold">Tạm tính:</span>{{ number_format($checkout->ThanhToan, 0, ',', '.') }} VNĐ</p>
                                                <p style="display:flex; justify-content: space-between;"><span
                                                        style="font-weight:bold">Tổng tiền: </span><span
                                                        style="margin-top:-10px; color: red;font-size:25px; font-weight:bold">{{ number_format($checkout->ThanhToan, 0, ',', '.') }} VNĐ</span></p>
                                            </div>
                                            <div class="text-center" style="margin-bottom:20px">
                                                <a href="{{ route("showsearchlog") }}" class="btn btn-primary"
                                                     style="border-radius:20px;width:90%"><i class="fa-solid fa-arrow-left" style="color: #ffff"></i> Quay lại
                                                 </a>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
