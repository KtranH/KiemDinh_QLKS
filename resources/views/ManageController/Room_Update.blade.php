@extends('container')
@section('content')

<!-- Link icon -->
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

  <title>GTX - Quản lý phòng</title>
  <main id="main" class="main">

    <div class="pagetitle">
        <h1>Phòng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Phòng</li>
                <li class="breadcrumb-item active">Tùy chỉnh phòng</li>
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#lichSuDatPhong">Tùy chỉnh phòng</button>
                            </li>
                        </ul>
    
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade active show profile-overview" id="lichSuDatPhong">
                                
                                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: bold;
                                font-style: normal;">Tùy chỉnh phòng</h5>
                                
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


                             <!-- Form hiển thị thêm phòng -->
                                <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" action="{{ route("updateroom",["id" => $room[0]["MaPhong"]]) }}">
                                @csrf
                                  <div style="width:100%; display: flex;justify-content:space-around;margin-bottom: 20px; flex-wrap:wrap">
                                    <div style="width:100%">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Tên loại:</label>
                                        <div class="col-md-8 col-lg-12">
                                            <select class="form-select" aria-label="Default select example" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" name="maloai">
                                                <option value="{{ $room[1]["_id"] }}">{{ $room[1]["MaLoai"] }}</option>
                                                @foreach ($category_room as $item)
                                                    @if ($item["_id"] != $room[1]["_id"])
                                                        <option value="{{ $item["_id"] }}">{{ $item["MaLoai"] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
    
                                      <div style="width:100%">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Tên phòng:</label>
                                        <div class="col-md-8 col-lg-12">
                                          <input name="tenphong" type="text" class="form-control" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $room[0]["TenPhong"] }}" required>
                                          <div class="invalid-feedback">Tên phòng không hợp lệ</div>
                                        </div>
                                      </div>  

                                      <div style="width:100%">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Vị trí:</label>
                                        <div class="col-md-8 col-lg-12">
                                        <input name="vitri" type="number" min = 1 class ="form-control" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $room[0]["ViTri"] }}" required>
                                        <div class="invalid-feedback">Vị trí không hợp lệ</div>
                                        </div>
                                     </div>

                                     <div style="width:100%">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Giá thuê:</label>
                                        <div class="col-md-8 col-lg-12">
                                        <input name="giathue" type="number" min = 1 class ="form-control" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $room[0]["GiaThue"] }}" required>
                                        <div class="invalid-feedback">Giá thuê không hợp lệ</div>
                                        </div>
                                     </div>
                                  </div>  
              
                                  <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Lưu và thay đổi</button>
                                  </div>
                                </form>
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