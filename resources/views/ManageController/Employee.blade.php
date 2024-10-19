@extends('container')
@section('content')

<!-- Link icon -->
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

  <title>GTX - Quản lý nhân viên</title>
  <main id="main" class="main">

    <div class="pagetitle">
        <h1>Nhân viên</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Quản lý</li>
                <li class="breadcrumb-item active">Nhân viên</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-8" style="width:100%">

                <div class="card" style="border-radius:20px;">
                    <div class="card-body pt-2">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#danhSachNhanvien">Danh sách nhân viên</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#themNhanvien">Thêm nhân viên</button>
                            </li>
                            {{--<li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tuyChinhQuyen">Tùy chỉnh quyền</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#themquyen">Thêm quyền</button>
                            </li>--}}
                        </ul>

                        <div class="tab-content pt-2">

                          <div class="tab-pane fade active show profile-overview" id="danhSachNhanvien">
                             <h5 class="card-title" style="font-family: 'Montserrat', sans-serif;
                             font-optical-sizing: auto;
                             font-weight: 400;
                             font-style: normal;
                             font-size: 14px;">Danh sách nhân viên hiện tại</h5>

                             @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                             @endif

                             @if (Session::has('error'))  
                                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                             @endif

                             <div></div>

                            <!-- Bảng hiển thị danh sách loại phòng -->

                            <table class="table table-borderless datatable">
                                <thead>
                                  <tr>
                                    <th scope="col">CMND</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Ngày sinh</th>
                                    <th scope="col">Ngày vào làm</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Chức vụ</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Chức năng</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($employee as $item)
                                    @php
                                      $ChucVu = $item->TenQuyenHan;
                                    @endphp
                                    @foreach ($item->DanhSachTaiKhoan as $x)
                                    <tr id="employee-{{ $x['CMND'] }}">
                                        <th scope="row"><a href="#" class="text-primary">{{ $x["CMND"] }}</a></th>
                                        <td>{{ $x["TenNhanVien"] }}</td>
                                        <td>{{ $x["NgaySinh"] }}</td>
                                        <td>{{ $x["NgayVaoLam"] }}</td>
                                        <td>{{ $x["SDT"] }}</td>
                                        <td>{{ $ChucVu }}</td>
                                        <td>
                                          @if ($x['IsDelete'] == 1)
                                              <span class="badge bg-danger" id="status-{{ $x['CMND'] }}">Không hoạt động</span>
                                          @else
                                              <span class="badge bg-success" id="status-{{ $x['CMND'] }}">Còn hoạt động</span>
                                          @endif
                                        </td>
                                        <td>
                                          <!-- Edit Button -->
                                          <a href="{{ route('showupdateemployee', $x["CMND"]) }}" class="btn edit-room" data-employee-id="{{ $x["CMND"] }}"
                                              style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC">
                                              <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                          </a>
                      
                                          <!-- Active Button -->
                                          <button class="btn activate-Employee" data-employee-id="{{ $x["CMND"] }}"
                                              style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC">
                                              <i class="fa-solid fa-arrow-rotate-left" style="color: #ffffff;"></i>
                                          </button>
                      
                                          <!-- Disable Button -->
                                          <button class="btn btn-danger disable-Employee" data-employee-id="{{ $x["CMND"] }}"
                                              style="border-radius:20%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                              <i class="fi fi-br-cross"></i>
                                          </button>
                                      </td>
                                    </tr>              
                                    @endforeach
                                  @endforeach
                                </tbody>
                              </table>
                              <script>
                                $(document).ready(function() {
                                  $('.activate-Employee').click(function(e) {
                                      e.preventDefault();
                                      var employeeId = $(this).data('employee-id');
                                      var url = '{{ route("activeemployee", ":id") }}'.replace(':id', employeeId);
  
                                      $.ajax({
                                          url: url,
                                          type: 'GET',
                                          success: function(response) {
                                              if (response.success) {
                                                  $('#status-' + employeeId).removeClass('bg-danger').addClass('bg-success').text('Còn hoạt động');
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
  
                                  $('.disable-Employee').click(function(e) {
                                      e.preventDefault();
                                      var employeeId = $(this).data('employee-id');
                                      var url = '{{ route("disableemployee", ":id") }}'.replace(':id', employeeId);
  
                                      $.ajax({
                                          url: url,
                                          type: 'GET',
                                          success: function(response) {
                                              if (response.success) {
                                                  $('#status-' + employeeId).removeClass('bg-success').addClass('bg-danger').text('Không hoạt động');
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

                            <div class="tab-pane fade show profile-overview" id="themNhanvien">
                                
                                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: bold;
                                font-style: normal;">Thêm một nhân viên</h5>
                        
                             <!-- Form hiển thị thêm loại phòng -->
                                <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" action="{{ route('addmoreemployee') }}">
                                @csrf
                                  <div style="width:100%; display: flex;justify-content:space-around;margin-bottom: 20px">
                                    <div style="width:100%">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Họ tên:</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="tennhanvien" type="text" class="form-control @error('tennhanvien') is-invalid @enderror" id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                          <div class="invalid-feedback">Họ tên không hợp lệ</div>
                                          @error('tennhanvien')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                    </div>
    
                                      <div style="width:100%">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Ngày sinh:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="ngaysinh" type="date" class="form-control @error('ngaysinh') is-invalid @enderror" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                          <div class="invalid-feedback">Ngày sinh không hợp lệ</div>
                                          @error('ngaysinh')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div>  

                                      <div style="width:100%">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Ngày vào làm:</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="ngayvaolam" type="date" class="form-control @error('ngayvaolam') is-invalid @enderror" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                          <div class="invalid-feedback">Ngày vào làm không hợp lệ</div>
                                          @error('ngayvaolam')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div> 
                                  </div>  
              
                                  <div style="width:100%; display: flex;justify-content:space-around;margin-bottom: 20px">
                                    <div style="width:100%">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Email:</label>
                                        <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                        <div class="invalid-feedback">Email không hợp lệ</div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                
                                    <div style="width:100%">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Password:</label>
                                        <div class="col-md-8 col-lg-9">
                                        <input name="matkhau" type="password" minlength="6" class="form-control @error('matkhau') is-invalid @enderror" id="Job" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                        <div class="invalid-feedback">Password không hợp lệ</div>
                                        @error('matkhau')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                    <div style="width:100%">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">CMND:</label>
                                        <div class="col-md-8 col-lg-9">
                                        <input name="cmnd" type="text" minlength="6" class="form-control @error('cmnd') is-invalid @enderror" id="Job" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                        <div class="invalid-feedback">CMND không hợp lệ</div>
                                        @error('cmnd')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                  </div>
            
                                  <div style="row mb-3">
                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Số điện thoại:</label>
                                    <div class="col-md-8 col-lg-11">
                                      <input name="sdt" type="number" min = "1" minlength="10" class ="form-control @error('sdt') is-invalid @enderror" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                      <div class="invalid-feedback">Điện thoại không hợp lệ</div>
                                      @error('sdt')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                    </div>
                                  </div>

                                  <div style="row mb-3">
                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Chức năng:</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select class="form-select" aria-label="Default select example" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;margin-bottom:60px;width:122%" name="tenquyenhan">
                                            @foreach ($employee as $item)
                                                <option value="{{ $item->_id }}">{{ $item->TenQuyenHan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Địa chỉ:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <textarea name="diachi" class="form-control @error('address') is-invalid @enderror" id="about" style="height: 100px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;margin-bottom:50px"required></textarea>
                                      <div class="invalid-feedback">Địa chỉ không hợp lệ</div>
                                      @error('address')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                                  </div>
                                </form>
                            </div>
                         </div>      
                         {{--<div class="tab-content" style="margin-top:-10px">
                          <div class="tab-pane fade show profile-overview" id="tuyChinhQuyen">
                            <h5 class="card-title" style="font-family: 'Montserrat', sans-serif;
                            font-optical-sizing: auto;
                            font-weight: 400;
                            font-style: normal;
                            font-size: 14px;">Danh sách các quyền</h5>
                            <table class="table table-borderless datatable">
                              <thead>
                                <tr>
                                  <th scope="col">Mã quyền</th>
                                  <th scope="col">Tên quyền</th>
                                  <th scope="col">Chức năng</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($employee as $item)
                                  <tr>
                                      <th scope="row"><a href="#" class="text-primary">{{ $item->_id}}</a></th>
                                      <td>{{ $item->TenQuyenHan }}</td>
                                      <td>
                                        <!-- Edit Button -->
                                        <a href="" class="btn edit-room"
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
                        <div class="tab-content pt-2">

                          <div class="tab-pane fade show profile-overview" id="themquyen">
                              
                              <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                              font-optical-sizing: auto;
                              font-weight: bold;
                              font-style: normal;">Thêm một quyền hạn mới</h5>
                      
                           <!-- Form hiển thị thêm loại phòng -->
                              <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" action="">
                              @csrf
                                  <div style="width:100%">
                                      <label for="company" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Họ tên:</label>
                                      <div class="col-md-8 col-lg-11">
                                          <input name="tennhanvien" type="text" class="form-control" id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                        <div class="invalid-feedback">Họ tên không hợp lệ</div>
                                      </div>
                                  </div>
  
                                  <div style="width:100%">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Ngày sinh:</label>
                                      <div class="col-md-8 col-lg-11">
                                        <input name="ngaysinh" type="date" class="form-control" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                        <div class="invalid-feedback">Ngày sinh không hợp lệ</div>
                                      </div>
                                  </div>            
                                  <div style="row mb-3; display:flex;">
                                    <label><input type="checkbox" name="danhsachquyen[]" value="1"> NguoiDung</label><br>
                                    <label><input type="checkbox" name="danhsachquyen[]" value="2"> Checkout</label><br>
                                    <label><input type="checkbox" name="danhsachquyen[]" value="3"> DichVu</label><br>
                                    <label><input type="checkbox" name="danhsachquyen[]" value="4"> KhachThue</label><br>
                                    <label><input type="checkbox" name="danhsachquyen[]" value="5"> Checkin</label><br>
                                    <label><input type="checkbox" name="danhsachquyen[]" value="6"> LoaiPhong</label><br>
                                  </div>
                                <div class="text-center">
                                  <button type="submit" class="btn btn-primary">Thêm mới</button>
                                </div>
                              </form>
                          </div>
                       </div>--}}   
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>
@endsection