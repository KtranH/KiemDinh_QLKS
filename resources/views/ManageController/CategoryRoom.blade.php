@extends('container')
@section('content')    
<!-- Link icon -->
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

  <title>GTX - Quản lý loại phòng</title>
  <main id="main" class="main">

    <div class="pagetitle">
        <h1>Loại phòng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Quản lý</li>
                <li class="breadcrumb-item active">Loại phòng</li>
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#danhSachPhong">Danh sách loại phòng</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lichSuDatPhong">Thêm loại phòng</button>
                            </li>
                        </ul>
                                <div class="tab-content pt-2">

                          <div class="tab-pane fade active show profile-overview" id="danhSachPhong">
                             <h5 class="card-title" style="font-family: 'Montserrat', sans-serif;
                             font-optical-sizing: auto;
                             font-weight: 400;
                             font-style: normal;
                             font-size: 14px;">Danh sách loại phòng hiện có</h5>
                             @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <strong>{{ Session::get('error') }}</strong>
                                </div>
                             @endif
                             @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <strong>{{ Session::get('success') }}</strong>
                                </div>          
                             @endif

                            <!-- Bảng hiển thị danh sách loại phòng -->
                            <table class="table table-borderless datatable">
                              <thead>
                                  <tr>
                                      <th scope="col">Mã loại phòng</th>
                                      <th scope="col">Tên loại phòng</th>
                                      <th scope="col">Sức chứa</th>
                                      <th scope="col">Diện tích</th>
                                      <th scope="col">Quy định</th>
                                      <th scope="col">Tình trạng</th>
                                      <th scope="col">Chức năng</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($listCategoriesRoom as $item)
                                      <tr id="category-{{ $item->_id }}">
                                          <th scope="row"><a href="#">{{ $item->_id }}</a></th>
                                          <td>{{ $item->MaLoai }}</td>
                                          <td><a href="#" class="text-primary">{{ $item->SucChua }}</a></td>
                                          <td>{{ $item->DienTich }}</td>
                                          <td>{{ $item->QuyDinh }}</td>
                                          <td>
                                              @if ($item->TinhTrang == 0)
                                                  <span class="badge bg-danger" id="status-{{ $item->_id }}">Không hoạt động</span>
                                              @else
                                                  <span class="badge bg-success" id="status-{{ $item->_id }}">Còn hoạt động</span>
                                              @endif
                                          </td>
                                          <td>
                                              <!-- Edit Button -->
                                              <a href="{{ route('showupdatecategoryroom', $item->_id) }}" class="btn edit-room" data-category-id="{{ $item->_id }}"
                                                  style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC">
                                                  <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                              </a>
                          
                                              <!-- Active Button -->
                                              <button class="btn activate-CategoryRoom" data-category-id="{{ $item->_id }}"
                                                  style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC">
                                                  <i class="fa-solid fa-arrow-rotate-left" style="color: #ffffff;"></i>
                                              </button>
                          
                                              <!-- Disable Button -->
                                              <button class="btn btn-danger disable-CategoryRoom" data-category-id="{{ $item->_id }}"
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
                                $('.activate-CategoryRoom').click(function(e) {
                                    e.preventDefault();
                                    var categoryId = $(this).data('category-id');
                                    var url = '{{ route("activecategoryroom", ":id") }}'.replace(':id', categoryId);

                                    $.ajax({
                                        url: url,
                                        type: 'GET',
                                        success: function(response) {
                                            if (response.success) {
                                                $('#status-' + categoryId).removeClass('bg-danger').addClass('bg-success').text('Còn hoạt động');
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

                                $('.disable-CategoryRoom').click(function(e) {
                                    e.preventDefault();
                                    var categoryId = $(this).data('category-id');
                                    var url = '{{ route("disablecategoryroom", ":id") }}'.replace(':id', categoryId);

                                    $.ajax({
                                        url: url,
                                        type: 'GET',
                                        success: function(response) {
                                            if (response.success) {
                                                $('#status-' + categoryId).removeClass('bg-success').addClass('bg-danger').text('Không hoạt động');
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
                                font-style: normal;">Thêm một loại phòng</h5>

                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                              
                             <!-- Form hiển thị thêm loại phòng -->
                                <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{ route('addmorecategoryroom') }}">
                                @csrf
                                  <div style="width:100%; display: flex;justify-content:space-around;margin-bottom: 20px">
                                    <div style="width:100%">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Tên loại:</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="tenloaiphong" type="text" class="form-control @error('tenloaiphong') is-invalid @enderror" id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                            @error('tenloaiphong')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
    
                                      <div style="width:100%">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Sức chứa:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="succhua" min="1" type="number" class="form-control @error('succhua') is-invalid @enderror" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                          @error('succhua')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </div>  

                                      <div style="width:100%">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Diện tích:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="dientich" type="decimal" min="20" class ="form-control @error('dientich') is-invalid @enderror" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                          @error('dientich')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                    </div>
                                  </div>  
                                             
                                  <div style="width:100%; display: flex;justify-content:space-around;margin-bottom: 50px">

                                    <div style="width:100%">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label" style="font-weight:bold">Tiện ích:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="tienich" type="text" class ="form-control @error('tienich') is-invalid @enderror" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                          @error('tienich')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                    </div>

                                    <div style="width:100%">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Nội thất:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="noithat" type="text" class ="form-control @error('noithat') is-invalid @enderror" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                          @error('noithat')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                    </div>

                                    <div style="width:100%">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Quy định:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="quydinh" type="text" class ="form-control @error('quydinh') is-invalid @enderror" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                          @error('quydinh')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                    </div>
                                  </div>
                                
                                  <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Mô tả:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <textarea name="mota" class="form-control @error('mota') is-invalid @enderror" id="about" style="height: 100px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;margin-bottom:50px"></textarea>
                                      @error('mota')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                    </div>
                                  </div>

                                  <hr>

                                  <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                  font-optical-sizing: auto;
                                  font-weight: bold;
                                  font-style: normal;">Thêm hình ảnh loại phòng</h5>
                                  
                                  
                                  <div class="row mb-3">
                                    <div class="col-md-8 col-lg-9">
                                        <img id="avatarPreview1" src="https://media.designcafe.com/wp-content/uploads/2023/07/05141750/aesthetic-room-decor.jpg" alt="Profile" style="max-width:120px;">
                                    </div>
                                  </div>
                                  <div class="row mb-3">
                                    <label for="Country" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Đường dẫn hình ảnh 1:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <input name="image1" type="text" class ="form-control" id="image1" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                      <div class="invalid-feedback">Hình ảnh không hợp lệ</div>
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <div class="col-md-8 col-lg-9">
                                        <img id="avatarPreview2" src="https://media.designcafe.com/wp-content/uploads/2023/07/05141750/aesthetic-room-decor.jpg" alt="Profile" style="max-width:120px;">
                                    </div>
                                  </div>
                                  <div class="row mb-3">
                                    <label for="Country" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Đường dẫn hình ảnh 2:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <input name="image2" type="text" class ="form-control" id="image2" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                      <div class="invalid-feedback">Hình ảnh không hợp lệ</div>
                                    </div>
                                  </div>

                                  <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                        
                                        const imageInput1 = document.getElementById('image1');
                                        const previewImage1 = document.getElementById('avatarPreview1');

                                        const imageInput2 = document.getElementById('image2');
                                        const previewImage2 = document.getElementById('avatarPreview2');

                                        const imageInput3 = document.getElementById('image3');
                                        const previewImage3 = document.getElementById('avatarPreview3');

                                        imageInput1.addEventListener('input', function () {
                                            const imageUrl = imageInput1.value;

                                            if (imageUrl) {
                                                previewImage1.src = imageUrl;
                                                previewImage1.style.display = 'block';
                                            } else {
                                                previewImage1.style.display = 'none';
                                            }
                                        });

                                        imageInput2.addEventListener('input', function () {
                                            const imageUrl = imageInput2.value;

                                            if (imageUrl) {
                                                previewImage2.src = imageUrl;
                                                previewImage2.style.display = 'block';
                                            } else {
                                                previewImage2.style.display = 'none';
                                            }
                                        });

                                        imageInput3.addEventListener('input', function () {
                                            const imageUrl = imageInput3.value;

                                            if (imageUrl) {
                                                previewImage3.src = imageUrl;
                                                previewImage3.style.display = 'block';
                                            } else {
                                                previewImage3.style.display = 'none';
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