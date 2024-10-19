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

                                            @if (Session::has('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ Session::get('success') }}
                                                </div>
                                            @endif

                                            @if (Session::has('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ Session::get('error') }}
                                            </div>
                                            @endif

                                            <div class="row bg-white" style="padding:20px;border-radius:20px;width:100%;display:flex;justify-content: space-between;">
                                                <table class="table table-borderless datatable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Mã dịch vụ</th>
                                                            <th scope="col">Tên dịch vụ</th>
                                                            <th scope="col">Đơn giá</th>
                                                            <th scope="col">Chức năng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($service as $item)
                                                            <tr id="service-{{ $item->_id }}">
                                                                <th scope="row"><a href="#">{{ $item->_id }}</a></th>
                                                                <td>{{ $item->TenDichVu }}</td>
                                                                <td>{{ $item->GiaDichVu }}</td>
                                                                <td>
                                                                    <a href="{{ route('addservicecheckout', ['idCheckout' => $checkout->_id, 'idService' => $item->_id, 'price' => $item->GiaDichVu]) }}" class="btn edit-room" 
                                                                            style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC">
                                                                        <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                                                    </a>
                                                                </td>
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

                                    @php
                                        $sum = 0;
                                        $sumService = 0;
                                        foreach ($listServiceInCheckout as $item) {
                                            $sumService += $item['DonGia'];
                                        }
                                        $sum = $sumService + $checkout->ThanhToan;
                                    @endphp

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
                                                Tổng tiền<span>/Tạm tính</span></h5>
                                            <div class="row bg-white"
                                                style="padding:20px;border-radius:20px;width:100%;display:flex;justify-content: space-between;">

                                                <p style="display:flex; justify-content: space-between;margin-bottom:30px; font-weight:bold">
                                                    <span style="font-weight:bold">Tạm tính:</span>{{ number_format($sum, 0, ',', '.') }} VNĐ</p>
                                                <p style="display:flex; justify-content: space-between;"><span
                                                        style="font-weight:bold">Tổng tiền: </span><span
                                                        style="margin-top:-10px; color: red;font-size:25px; font-weight:bold">{{ number_format($sum, 0, ',', '.') }} VNĐ</span></p>
                                            </div>
                                        </div>
                                        <div class="text-center" style="margin-bottom:20px">
                                           <form action="{{ route('confirmcheckout') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idCheckout" value="{{ $checkout->_id }}">
                                            <input type="hidden" name="sum" value="{{ $sum }}">
                                            <button type="submit" class="btn btn-primary confirm-checkout"
                                                style="border-radius:20px;width:90%"><i class="fa-solid fa-check"
                                                style="color: #ffffff;"></i> Hoàn thành
                                            </button>
                                           </form>
                                        </div>
                                        <div class="text-center" style="margin-bottom:20px">
                                            <form action="{{ route('cancelcheckout') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="idCheckout" value="{{ $checkout->_id }}">
                                             <button type="submit" class="btn btn-danger cancel-checkout"
                                                 style="border-radius:20px;width:90%"><i class="fa-solid fa-xmark" 
                                                 style="color: #ffffff;"></i> Hủy bỏ
                                             </button>
                                            </form>
                                         </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('.confirm-checkout').click(function (e) {
                                                    e.preventDefault();
                                                    Swal.fire({ title: 'Bạn có chắc chắn muốn hoàn thành trả phòng?', text: "Bạn sẽ không thể khôi phục lại quyết định này!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Đồng ý', cancelButtonText: 'Hủy bỏ'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            Swal.fire(
                                                                'Đã xác nhận!',
                                                                'Đang tiến hành xác nhận!',
                                                                'success'
                                                            );
                                                            setTimeout(() => {
                                                                    $(this).closest('form').submit();
                                                            }, 2000);
                                                        }
                                                    });
                                                })
                                                $('.cancel-checkout').click(function (e) {
                                                    e.preventDefault();
                                                    Swal.fire({ title: 'Bạn có chắc chắn muốn hủy bỏ trả phòng?', text: "Bạn sẽ không thể khôi phục lại quyết định này!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Đồng ý', cancelButtonText: 'Hủy bỏ'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            Swal.fire(
                                                                'Đã xác nhận!',
                                                                'Đang tiến hành xác nhận!',
                                                                'success'
                                                            );
                                                            setTimeout(() => {
                                                                    $(this).closest('form').submit();
                                                            }, 2000);
                                                        }
                                                    });
                                                })
                                            })
                                        </script>
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
