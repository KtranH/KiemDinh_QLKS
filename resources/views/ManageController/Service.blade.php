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
                <li class="breadcrumb-item">Quản lý</li>
                <li class="breadcrumb-item active">Dịch vụ</li>
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#danhSachPhong">Danh sách dịch vụ</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lichSuDatPhong">Thêm dịch vụ mới</button>
                            </li>
                        </ul>
                                <div class="tab-content pt-2">

                          <div class="tab-pane fade active show profile-overview" id="danhSachPhong">
                             <h5 class="card-title" style="font-family: 'Montserrat', sans-serif;
                             font-optical-sizing: auto;
                             font-weight: 400;
                             font-style: normal;
                             font-size: 14px;">Danh dịch vụ hiện có</h5>

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

                            <!-- Bảng hiển thị danh sách loại phòng -->

                            <table class="table table-borderless datatable">
                                <thead>
                                  <tr>
                                    <th scope="col">Mã dịch vụ</th>
                                    <th scope="col">Tên dịch vụ</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Giá dịch vụ</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Chức năng</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($service as $item)
                                  <tr id="service-{{ $item->_id }}">
                                      <th scope="row"><a href="#">{{ $item->_id }}</a></th>
                                      <td><a href="#" class="text-primary">{{ $item->TenDichVu }}</a></td>
                                      <td>{{ $item->MoTa}}</td>
                                      <td>{{ $item->GiaDichVu}}</td>
                                      <td>
                                        @if ($item->TinhTrang == 0)
                                            <span class="badge bg-danger" id="status-{{ $item->_id }}">Không hoạt động</span>
                                        @else
                                            <span class="badge bg-success" id="status-{{ $item->_id }}">Còn hoạt động</span>
                                        @endif
                                      </td>
                                      <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('showupdateservice', $item->_id) }}" class="btn edit-room" data-service-id="{{ $item->_id }}"
                                            style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC">
                                            <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                        </a>
                    
                                        <!-- Active Button -->
                                        <button class="btn activate-ServiceRoom" data-service-id="{{ $item->_id }}"
                                            style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC">
                                            <i class="fa-solid fa-arrow-rotate-left" style="color: #ffffff;"></i>
                                        </button>
                    
                                        <!-- Disable Button -->
                                        <button class="btn btn-danger disable-ServiceRoom" data-service-id="{{ $item->_id }}"
                                            style="border-radius:20%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                            <i class="fi fi-br-cross"></i>
                                        </button>
                                      </td>
                                      @if (Session::has('error'))
                                          <td><div class="alert alert-danger" role="alert"> {{ Session::get('error') }} </div></td>
                                      @endif
                                  </tr>              
                                @endforeach
                                </tbody>
                              </table>
                              <script>
                               $(document).ready(function() {
                                  $('.activate-ServiceRoom').click(function(e) {
                                      e.preventDefault();
                                      var serviceId = $(this).data('service-id');
                                      var url = '{{ route("activeservice", ":id") }}'.replace(':id', serviceId);

                                      $.ajax({
                                          url: url,
                                          type: 'GET',
                                          success: function(response) {
                                              if (response.success) {
                                                  $('#status-' + serviceId).removeClass('bg-danger').addClass('bg-success').text('Còn hoạt động');
                                                  alert(response.message);
                                              } else {
                                                  alert('Có lỗi xảy ra: ' + response.message);
                                              }
                                          },
                                          error: function(xhr) {
                                              alert('Có lỗi xảy ra khi gửi yêu cầu.');
                                          }
                                      });
                                  });

                                  $('.disable-ServiceRoom').click(function(e) {
                                      e.preventDefault();
                                      var serviceId = $(this).data('service-id');
                                      var url = '{{ route("disableservice", ":id") }}'.replace(':id', serviceId);

                                      $.ajax({
                                          url: url,
                                          type: 'GET',
                                          success: function(response) {
                                              if (response.success) {
                                                  $('#status-' + serviceId).removeClass('bg-success').addClass('bg-danger').text('Không hoạt động');
                                                  alert(response.message);
                                              } else {
                                                  alert('Có lỗi xảy ra: ' + response.message);
                                              }
                                          },
                                          error: function(xhr) {
                                              alert('Có lỗi xảy ra khi gửi yêu cầu.');
                                          }
                                      });
                                  });
                              });
                              </script>
                          </div>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show profile-overview" id="lichSuDatPhong">
                                
                                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: bold;
                                font-style: normal;">Thêm một dịch vụ</h5>
                                
                             <!-- Form hiển thị thêm loại phòng -->
                                <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" action="{{ route('addservice') }}">
                                @csrf
                                  <div style="width:100%; margin-bottom: 50px">
    
                                      <div style="width:122%">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Tên dịch vụ:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="tendv" type="text" class="form-control" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                          <div class="invalid-feedback">Tên dịch vụ không hợp lệ</div>
                                        </div>
                                      </div>  

                                      <div style="width:122%">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Giá thuê:</label>
                                        <div class="col-md-8 col-lg-9">
                                        <input name="giadv" type="number" min = 1 class ="form-control" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                        <div class="invalid-feedback">Giá không hợp lệ</div>
                                        </div>
                                      </div>
                                  </div>  
              
                                  <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Mô tả:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <textarea name="mota" class="form-control" id="about" style="height: 100px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;margin-bottom:50px"required></textarea>
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
                                        <img id="avatarPreview1" src="https://cdn.tgdd.vn/Files/2022/05/11/1431711/buffet-la-gi-cac-loai-hinh-buffet-pho-bien-va-luu-y-khi-an-buffet-202205110944353015.jpg" alt="Profile" style="max-width:120px;">
                                    </div>
                                  </div>
                                  <div class="row mb-3">
                                    <label for="Country" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Đường dẫn hình ảnh 1:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <input name="image1" type="text" class ="form-control" id="image1" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
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
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>
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
@endSection