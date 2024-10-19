@extends('container')
@section('content')
    <!-- Link icon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <title>GTX - Chi tiết đặt và nhận phòng</title>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Nhận và đặt phòng</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item">Nhận và đặt phòng</li>
                    <li class="breadcrumb-item active">Chi tiết nhận và đặt phòng</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section profile">
            <div class="row">
                <div class="col-xl-8" style="width:100%">

                    <div class="card" style="border-radius:20px;">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ctpdkt">Chi tiết
                                        nhận và đặt phòng</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div style="display:flex; justify-content:space-between; margin-bottom:20px">
                                    <div style="display:flex; flex-wrap:wrap; max-width:350px">
                                        <h5 class="card-title"
                                            style="font-family: 'Montserrat', sans-serif;
                                  font-optical-sizing: auto;
                                  font-weight: 400; 
                                  font-style: bold;">
                                            Nhận phòng từ
                                            <span style="font-weight:bold;color:red">{{ $checkin->NgayCheckin }}</span>
                                            đến <span
                                                style="font-weight:bold;color:red">{{ $checkin->NgayCheckOutDuKien }}</span>
                                        </h5>
                                        <div style="marign-bottom:20px">
                                            <a href="{{ route("showsearchlog") }}" type="submit" class="btn btn-primary">Quay lại</a>
                                        </div>
                                    </div>

                                    <div style="display:flex; flex-wrap:wrap; justify-content:flex-end; max-width:350px">
                                        <h5 class="card-title"
                                            style="font-family: 'Montserrat', sans-serif;
                                  font-optical-sizing: auto;
                                  font-weight: 400;
                                  font-style: bold;
                                  ">
                                            Tổng tiền ({{ $checkin->TinhTrang }}): <span
                                                style="font-weight:bold;color:red; font-size:18px">{{ number_format($checkin->checkout->ThanhToan, 0, ',', '.') }}</span>
                                            <span style="font-weight:bold">VNĐ</span>
                                        </h5>
                                    </div>
                                </div>

                                <!-- Bảng hiển thị danh sách loại phòng -->
                                <h5 class="card-title"
                                        style="font-family: 'Montserrat', sans-serif;
                                        font-optical-sizing: auto;
                                        font-weight: bold;
                                        font-style: normal;
                                        ">
                                    Danh sách khách thuê phòng: {{ $checkin->Phong }}</h5>
                                    
                                <table class="table table-borderless datatable" id="CustomerTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tên khách</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">CMND</th>
                                            </tr>
                                        </thead>
                                        <tbody id="customerList">
                                            @foreach ($takeListCustomer as $item)
                                                <tr style="text-align:left" data-id="{{ $item['CMND'] }}">
                                                    <th scope="row"><a href="#" class="text-primary"><span style="font-weight:bold">{{ $item['TenKhachHang'] }}</span></a></th>
                                                    <td><a href="#" class="text-primary">{{ $item['SDT'] }}</a></td>
                                                    <td>{{ $item['CMND'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
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
