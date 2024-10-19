@extends('container')
@section('content')

<!-- Link icon -->
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

  <title>GTX - Quản lý thống kê</title>
  <main id="main" class="main">

    <div class="pagetitle">
        <h1>Tra cứu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Tra chủ</a></li>
                <li class="breadcrumb-item">Thống kê</li>
                <li class="breadcrumb-item active">Tra cứu</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-8" style="width:100%">

                <div class="card" style="border-radius:20px;">
                    <div class="card-body pt-4">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#khachhang">Khách hàng lưu trú</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nhanvadat">Danh sách nhận và đặt phòng</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#traphong">Danh sách trả phòng</button>
                            </li>
                        </ul>
                                <div class="tab-content pt-1">

                          <div class="tab-pane fade active show profile-overview" id="khachhang">
                             <h5 class="card-title" style="font-family: 'Montserrat', sans-serif;
                             font-optical-sizing: auto;
                             font-weight: 400;
                             font-style: normal;">Khách hàng lưu trú</h5>

                            <!-- Bảng hiển thị danh khách hàng từng lưu trú -->

                            <table class="table table-borderless datatable">
                                <thead>
                                  <tr>
                                    <th scope="col">Mã khách</th>
                                    <th scope="col">Tên khách</th>
                                    <th scope="col">Căn cước</th>
                                    <th scope="col">Điện thoại</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer as $item)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $item->_id }}</a></th>
                                            <td>{{ $item->TenKhachHang }}</td>
                                            <td><a href="#" class="text-primary">{{ $item->CMND }}</a></td>
                                            <td>{{ $item->SDT }}</td>
                                        </tr>              
                                    @endforeach
                                </tbody>
                              </table>

                          </div>
                          <div class="tab-content pt-2">

                            <div class="tab-pane fade show profile-overview" id="nhanvadat">
                                
                                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: 400;
                                font-style: normal;">Danh sách nhận và đặt phòng</h5>
                                
                                <!-- Bảng hiển thị tài khoản khách hàng -->
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã phiếu</th>
                                            <th scope="col">Nhân viên</th>
                                            <th scope="col">Tên phòng</th>
                                            <th scope="col">Ngày nhận phòng</th>
                                            <th scope="col">Ngày trả phòng</th>
                                            <th scope="col">Tình trạng</th>
                                            <th scope="col">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checkin as $item)
                                            <tr>
                                                <th scope="row"><a href="#">{{ $item->_id }}</a></th>
                                                <td>{{ $item->NhanVienLap }}</td>
                                                <td><a href="#" class="text-primary" style="text-align:center">{{ $item->Phong }}</a></td>
                                                <td>{{ $item->NgayCheckin }}</td>
                                                <td>{{ $item->NgayCheckOutDuKien }}</td>
                                                <td>
                                                    @if ($item->TinhTrang == 'Đã thanh toán')
                                                        <span class="badge bg-success">{{ $item->TinhTrang }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $item->TinhTrang }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('showsearchcheckin', ['id' => $item->_id]) }}" type="button" class="btn" style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC"><i class="fi fi-rr-file-edit"></i></a>
                                                </td>
                                            </tr>             
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                        <div class="tab-content pt-3">

                            <div class="tab-pane fade show profile-overview" id="traphong">
                                
                                <h5 class="card-title" style="margin-top:-25px; font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: 400;
                                font-style: normal;">Danh sách trả phòng</h5>
                                
                                <!-- Bảng hiển thị danh sách đánh giá chờ duyệt -->
                                <table class="table table-borderless datatable">
                                    <thead>
                                      <tr>
                                        <th scope="col">Mã checkout</th>
                                        <th scope="col">Mã checkin</th>
                                        <th scope="col">Nhân viên</th>
                                        <th scope="col">Tên phòng</th>
                                        <th scope="col">Ngày nhận</th>
                                        <th scope="col">Ngày lập</th>
                                        <th scope="col">Tình trạng</th>
                                        <th scope="col">Chức năng</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($checkout as $item)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $item->_id}}</a></th>
                                            <td>{{ $item->bookingCheckin->_id }}</td>
                                            <td>{{ $item->bookingCheckin->NhanVienLap }}</td>
                                            <td>{{ $item->bookingCheckin->Phong }}</td>
                                            <td>{{ $item->bookingCheckin->NgayCheckin}}</td>
                                            <td>{{ $item->NgayLap }}</td>
                                            <td>
                                                @if ($item->TinhTrang == "Đã thanh toán")
                                                    <span class="badge bg-success">{{ $item->TinhTrang }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $item->TinhTrang }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('showsearchcheckout', ['id' => $item->_id ]) }}" type="button" class="btn" style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC"><i class="fi fi-rr-file-edit"></i></a>
                                            </td>
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