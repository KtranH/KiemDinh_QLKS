@extends('container')
@section('content')

<!-- Link icon -->
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

  <title>GTX - Quản lý dịch vụ</title>
  <main id="main" class="main">

    <div class="pagetitle">
        <h1>Dịch vụ</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Dịch vụ</li>
                <li class="breadcrumb-item active">Quản lý dịch vụ</li>
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#lichSuDatPhong">Chỉnh sửa dịch vụ</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade active show profile-overview" id="lichSuDatPhong">
                                
                                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: bold;
                                font-style: normal;">Chỉnh sửa dịch vụ</h5>
                                
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
                                
                             <!-- Form hiển thị thêm loại phòng -->
                                <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" action="{{ route('addservice', ['id' => $service->_id]) }}">
                                @csrf
                                  <div style="width:100%; margin-bottom: 50px">
    
                                      <div style="width:122%">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Tên dịch vụ:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="tendv" type="text" class="form-control" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $service->TenDichVu }}" required>
                                          <div class="invalid-feedback">Tên dịch vụ không hợp lệ</div>
                                        </div>
                                      </div>  

                                      <div style="width:122%">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Giá thuê:</label>
                                        <div class="col-md-8 col-lg-9">
                                        <input name="giadv" type="number" min = 1 class ="form-control" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $service->GiaDichVu }}" required>
                                        <div class="invalid-feedback">Giá không hợp lệ</div>
                                        </div>
                                      </div>
                                  </div>  
              
                                  <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Mô tả:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <textarea name="mota" class="form-control" id="about" style="height: 100px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;margin-bottom:50px" required>{{ $service->MoTa }}</textarea>
                                      <div class="invalid-feedback">Mô tả không hợp lệ</div>
                                    </div>
                                  </div>
                                  
                                  <hr>

                                  <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                  font-optical-sizing: auto;
                                  font-weight: bold;
                                  font-style: normal;">Thêm hình ảnh dịch vụ </h5>
                                  
                                  
                                  <div class="row mb-3">
                                    <div class="col-md-8 col-lg-9">
                                        <img id="avatarPreview1" src="https://tecwood.com.vn/upload/ho-boi-hinh-oval.jpg" alt="Profile" style="max-width:120px;">
                                    </div>
                                  </div>
                                  <div class="row mb-3">
                                    <label for="Country" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Đường dẫn hình ảnh 1:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <input name="image1" type="text" class ="form-control" id="image1" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" >
                                      <div class="invalid-feedback">Hình ảnh không hợp lệ</div>
                                    </div>
                                  </div>

                                  <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                    
                                    const imageInput1 = document.getElementById('image1');
                                    const previewImage1 = document.getElementById('avatarPreview1');

                                    imageInput1.addEventListener('input', function () {
                                        const imageUrl = imageInput1.value;

                                        if (imageUrl) {
                                            previewImage1.src = imageUrl;
                                            previewImage1.style.display = 'block';
                                        } else {
                                            previewImage1.style.display = 'none';
                                        }
                                    });
                                });
                              </script>


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