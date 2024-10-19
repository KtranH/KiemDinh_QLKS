@extends('container')
@section('content')
    <!-- Link icon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <title>GTX - Quản lý đặt và nhận phòng</title>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Thêm đặt và nhận phòng</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item">Đặt và nhận phòng</li>
                    <li class="breadcrumb-item active">Thêm đặt và nhận phòng</li>
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
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pdktt">Thêm đặt và nhận phòng</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade active show profile-overview" id="pdktt">

                                    <h5 class="card-title"
                                        style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                        font-optical-sizing: auto;
                                        font-weight: 400;
                                        font-style: normal;
                                        font-size: 14px;">
                                        Phòng khả dụng</h5>

                                    @if (Session::has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Mã phòng</th>
                                                <th scope="col">Tên phòng</th>
                                                <th scope="col">Tên loại</th>
                                                <th scope="col">Sức chứa</th>
                                                <th scope="col">Vị trí</th>
                                                <th scope="col">Nội thất</th>
                                                <th scope="col">Giá thuê</th>
                                                <th scope="col">Tình trạng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roomAvailable as $item)
                                                    @php
                                                        $loaiPhong = $item->MaLoai;
                                                        $sucChua = $item->SucChua;
                                                        $noiThat = $item->NoiThat;
                                                    @endphp
                                                    @foreach ($item->DanhSachPhong as $x)
                                                        @if ($x['TinhTrang'] == 1)
                                                        @php
                                                            $listRoomAvailable[] = $x['MaPhong'];
                                                        @endphp
                                                        <tr>
                                                            <th scope="row"><a href="#">{{ $x['MaPhong'] }}</a></th>
                                                            <td>{{ $x['TenPhong'] }}</td>
                                                            <td>{{ $loaiPhong }}</td>
                                                            <td>{{ $sucChua }}</td>
                                                            <td>{{ $x['ViTri'] }}</td>
                                                            <td>{{ $noiThat }}</td>
                                                            <td>{{ $x['GiaThue'] }}</td>
                                                            @if ($x['TinhTrang'] == 1)
                                                                <td><span class="badge bg-success">Còn khả dụng</span></td>
                                                            @else
                                                                <td><span class="badge bg-danger">Không khả dụng</span></td>
                                                            @endif
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h5 class="card-title"
                                        style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                        font-optical-sizing: auto;
                                        font-weight: 400;
                                        font-style: normal;
                                        font-size: 14px;">
                                        Đặt và nhận phòng</h5>
                                    <form class="needs-validation" novalidate method="POST" action="{{ route("showdetailcheckin") }}">
                                        @csrf
                                        <div style="display:flex; justify-content: space-around;margin-bottom: 10px;">
                                            <div style="width:100%;margin-right:20px;">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label" style="font-weight:bold">Ngày nhận phòng:</label>
                                                <div class="col-md-8 col-lg-12">
                                                    <input name="checkin" type="date" class="form-control" id="checkin"
                                                           style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                                    <div class="invalid-feedback">Ngày tháng không hợp lệ</div>
                                                </div>
                                            </div>
                                            
                                            <div style="width:100%">
                                                <label for="Country" class="col-md-4 col-lg-3 col-form-label" style="font-weight:bold">Ngày trả phòng:</label>
                                                <div class="col-md-8 col-lg-12">
                                                    <input name="checkout" type="date" class="form-control" id="checkout"
                                                           style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                                    <div class="invalid-feedback">Ngày tháng không hợp lệ</div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            var checkinInput = document.getElementById('checkin');
                                            var checkoutInput = document.getElementById('checkout');
                                        
                                            function getTodayDate() {
                                                var today = new Date();
                                                var dd = String(today.getDate()).padStart(2, '0');
                                                var mm = String(today.getMonth() + 1).padStart(2, '0'); 
                                                var yyyy = today.getFullYear();
                                                return yyyy + '-' + mm + '-' + dd;
                                            }
                                        
                                            checkinInput.min = getTodayDate();
                                            checkinInput.value = getTodayDate(); 
                                        
                                            checkinInput.addEventListener('change', function() {
                                                checkoutInput.min = checkinInput.value;
                                            });
                                        
                                            checkoutInput.addEventListener('change', function() {
                                                if (checkoutInput.value < checkinInput.value) {
                                                    checkoutInput.setCustomValidity('Ngày trả phòng không thể trước ngày nhận phòng');
                                                } else {
                                                    checkoutInput.setCustomValidity('');
                                                }
                                            });
                                        
                                            checkoutInput.min = checkinInput.value;
                                        </script>
                                        

                                        <div style="width:100%">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"
                                                style="font-weight:bold">Mã phòng:</label>
                                            <div class="col-md-8 col-lg-12">
                                                <input name="roomavailable" class="form-control" id="roomavailable" value="" placeholder="Lựa chọn phòng khả dụng" required>                                               
                                                <div class="invalid-feedback">Mã phòng không hợp lệ</div>
                                            </div>
                                        </div>
                                        <script>
                                            var input = document.querySelector('input[name=roomavailable]');
                                            var tagify = new Tagify(input, {
                                                whitelist: @json($listRoomAvailable),
                                                maxTags: 1,
                                                dropdown: {
                                                    maxItems: 20,           
                                                    classname: "tags-look", 
                                                    enabled: 0,            
                                                    closeOnSelect: false    
                                                }
                                            });
                                        
                                            var selectedRooms = @json($selectedRooms ?? []);
                                        
                                            if (selectedRooms.length) {
                                                tagify.addTags(selectedRooms);
                                            }
                                        </script>
                                        <div class="text-center" style="margin-top:20px;">
                                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
