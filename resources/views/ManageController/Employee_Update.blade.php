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
                <li class="breadcrumb-item">Nhân viên</li>
                <li class="breadcrumb-item active">Tùy chỉnh nhân viên</li>
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#lichSuDatPhong">Tùy chỉnh nhân viên</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade active show profile-overview" id="lichSuDatPhong">
                                
                                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: bold;
                                font-style: normal;
                                font-size: 14px">Tùy chỉnh nhân viên</h5>
                                
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                                @endif


                             <!-- Form hiển thị thêm loại phòng -->
                                <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" action="{{ route('updateemployee', ['id' => $employee[0]['Email']]) }}">
                                    @csrf
                                    <div style="width:100%; display: flex;justify-content:space-around;margin-bottom: 20px">
                                        <div style="width:100%">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label" style="font-weight:bold">Họ tên:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="tennhanvien" type="text" class="form-control" id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $employee[0]["TenNhanVien"] }}" required>
                                            <div class="invalid-feedback">Họ tên không hợp lệ</div>
                                            </div>
                                        </div>
        
                                        <div style="width:100%">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Ngày sinh:</label>
                                            <div class="col-md-8 col-lg-9">
                                            <input name="ngaysinh" type="date" class="form-control" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $employee[0]["NgaySinh"] }}" required>
                                            <div class="invalid-feedback">Ngày sinh không hợp lệ</div>
                                            </div>
                                        </div>  

                                        <div style="width:100%">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Ngày vào làm:</label>
                                            <div class="col-md-8 col-lg-9">
                                            <input name="ngayvaolam" type="date" class="form-control" id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $employee[0]["NgayVaoLam"] }}" required>
                                            <div class="invalid-feedback">Ngày vào làm không hợp lệ</div>
                                            </div>
                                        </div>  
                                        </div> 
                                    </div> 
              
                                    <div style="width:100%; display: flex;justify-content:space-around;margin-bottom: 20px">
                                        <div style="width:100%">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Email:</label>
                                            <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;"value="{{ $employee[0]["Email"] }}" required>
                                            <div class="invalid-feedback">Email không hợp lệ</div>
                                            </div>
                                        </div>
                                        
                                        <div style="width:100%">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Passsword:</label>
                                            <div class="col-md-8 col-lg-9">
                                            <input name="matkhau" type="password" minlength="6" class="form-control" id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                            <div class="invalid-feedback">Passsword không hợp lệ</div>
                                            </div>
                                        </div>
    
                                        <div style="width:100%">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Điện thoại:</label>
                                            <div class="col-md-8 col-lg-9">
                                            <input name="sdt" type="number" min = "1" minlength="10" class ="form-control" id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $employee[0]["SDT"] }}" required>
                                            <div class="invalid-feedback">Điện thoại không hợp lệ</div>
                                          </div>
                                        </div>
                                    </div>

                                    <div style="row mb-3; margin-bottom: 20px">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label" style="font-weight:bold;">CMND:</label>
                                        <div class="col-md-8 col-lg-11">
                                        <input name="cmnd" type="text" class="form-control" id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" value="{{ $employee[0]["CMND"] }}" required>
                                        </div>
                                    </div>

            
                                  <div style="row mb-3">
                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label"  style="font-weight:bold">Chức năng:</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select class="form-select" aria-label="Default select example" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;margin-bottom:60px;width:122%" name="tenquyenhan">
                                            <option selected value="{{ $employee[1]["_id"] }}">{{ $employee[1]["TenQuyenHan"] }}</option>
                                            @foreach ($position as $item)
                                                    @if ($item["TenQuyenHan"] != $employee[1]["TenQuyenHan"])
                                                        <option value="{{ $item["_id"] }}">{{ $item["TenQuyenHan"] }}</option>
                                                    @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                  <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-2 col-form-label"  style="font-weight:bold">Địa chỉ:</label>
                                    <div class="col-md-8 col-lg-9">
                                      <textarea name="diachi" class="form-control" id="about" style="height: 100px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;margin-bottom:50px" required>{{ $employee[0]["DiaChi"] }}</textarea>
                                      <div class="invalid-feedback">Địa chỉ không hợp lệ</div>
                                    </div>
                                  </div>

                                  <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Lưu và thay đổi </button>
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