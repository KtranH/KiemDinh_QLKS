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
            <div class="col-xl-8" style="width:100%">
                <div class="card" style="border-radius:20px;">
                    <div class="card-body pt-1">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#hoadon">Lựa chọn trả phòng</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-1">
                            <div class="tab-pane fade active show profile-overview" id="hoadon">
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                                @endif
                                <table class="table table-borderless datatable">
                                    <thead>
                                      <tr>
                                        <th scope="col">Mã checkout</th>
                                        <th scope="col">Mã checkin</th>
                                        <th scope="col">Nhân viên</th>
                                        <th scope="col">Tên phòng</th>
                                        <th scope="col">Ngày đặt</th>
                                        <th scope="col">Ngày trả phòng</th>
                                        <th scope="col">Tình trạng</th>
                                        <th scope="col">Chức năng</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($checkout as $item)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $item->_id}}</a></th>
                                            <td>{{ $item->bookingCheckin->_id}}</td>
                                            <td>{{ $item->bookingCheckin->NhanVienLap }}</td>
                                            <td>{{ $item->bookingCheckin->Phong }}</td>
                                            <td>{{ $item->bookingCheckin->NgayCheckin}}</td>
                                            <td>{{ $item->bookingCheckin->NgayCheckOutDuKien }}</td>
                                            <td>
                                                @if ($item->TinhTrang == "Chưa thanh toán")
                                                    <span class="badge bg-warning">{{ $item->TinhTrang }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $item->TinhTrang }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('showdetailcheckout', ['id' => $item->_id ]) }}" type="button" class="btn" style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC"><i class="fi fi-rr-file-edit"></i></a>
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
    </section>
</main>
@endsection