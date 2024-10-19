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
                    <li class="breadcrumb-item">Loại phòng</li>
                    <li class="breadcrumb-item active">Tùy chỉnh loại phòng</li>
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
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#lichSuDatPhong">Chỉnh sửa loại phòng</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane active fade show profile-overview" id="lichSuDatPhong">

                                    <h5 class="card-title"
                                        style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                font-optical-sizing: auto;
                                font-weight: bold;
                                font-style: normal;">
                                        Chinh sửa loại phòng</h5>

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
                                    <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data"
                                        action="{{ route('updatecategoryroom', ['id' => $category_room->_id]) }}">
                                        @csrf
                                        <div
                                            style="width:100%; display: flex;justify-content:space-around;margin-bottom: 20px">
                                            <div style="width:100%">
                                                <label for="company" class="col-md-4 col-lg-3 col-form-label"
                                                    style="font-weight:bold">Tên loại:</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="tenloaiphong" type="text" class="form-control"
                                                        id="company" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;"
                                                        value="{{ $category_room->MaLoai }}" required>
                                                    <div class="invalid-feedback">Tên loại không hợp lệ</div>
                                                </div>
                                            </div>

                                            <div style="width:100%">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label"
                                                    style="font-weight:bold">Sức chứa:</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="succhua" type="number" min=1 class="form-control"
                                                        id="fullName" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;"
                                                        value="{{ $category_room->SucChua }}" required>
                                                    <div class="invalid-feedback">Sức chứa không hợp lệ</div>
                                                </div>
                                            </div>

                                            <div style="width:100%">
                                                <label for="Country" class="col-md-4 col-lg-3 col-form-label"
                                                    style="font-weight:bold">Diện tích:</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="dientich" type="number" min=20 class ="form-control"
                                                        id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;"
                                                        value="{{ $category_room->DienTich }}" required>
                                                    <div class="invalid-feedback">Diện tích không hợp lệ</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            style="width:100%; display: flex;justify-content:space-around;margin-bottom: 50px">

                                            <div style="width:100%">
                                                <label for="Country" class="col-md-4 col-lg-3 col-form-label"
                                                    style="font-weight:bold">Tiện ích:</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="tienich" type="text" class ="form-control"
                                                        id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;"
                                                        value="{{ $category_room->TienIch }}" required>
                                                    <div class="invalid-feedback">Tiện ích không hợp lệ</div>
                                                </div>
                                            </div>

                                            <div style="width:100%">
                                                <label for="Country" class="col-md-4 col-lg-3 col-form-label"
                                                    style="font-weight:bold">Nội thất:</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="noithat" type="text" class ="form-control"
                                                        id="Country" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;"
                                                        value="{{ $category_room->NoiThat }}" required>
                                                    <div class="invalid-feedback">Nội thất không hợp lệ</div>
                                                </div>
                                            </div>

                                            <div style="width:100%">
                                                <label for="Country" class="col-md-4 col-lg-3 col-form-label"
                                                    style="font-weight:bold">Quy định:</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="quydinh" type="text" class ="form-control"
                                                        id="Country"
                                                        style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;"
                                                        value="{{ $category_room->QuyDinh }}" required>
                                                    <div class="invalid-feedback">Quy định không hợp lệ</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-lg-2 col-form-label"
                                                style="font-weight:bold">Mô tả:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="mota" class="form-control" id="about"
                                                    style="height: 100px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;margin-bottom:50px" required>{{ $category_room->MoTa }}</textarea>
                                                <div class="invalid-feedback">Mô tả không hợp lệ</div>
                                            </div>
                                        </div>

                                        <hr>

                                        <h5 class="card-title"
                                            style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                                  font-optical-sizing: auto;
                                  font-weight: bold;
                                  font-style: normal;">
                                            Thêm hình ảnh loại phòng</h5>


                                        <div class="row mb-3">
                                            <div class="col-md-8 col-lg-9">
                                                <img id="avatarPreview1"
                                                    src="https://media.designcafe.com/wp-content/uploads/2023/07/05141750/aesthetic-room-decor.jpg"
                                                    alt="Profile" style="max-width:120px;">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-2 col-form-label"
                                                style="font-weight:bold">Đường dẫn hình ảnh 1:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="image1" type="text" class ="form-control"
                                                    id="image1" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                                <div class="invalid-feedback">Hình ảnh không hợp lệ</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-8 col-lg-9">
                                                <img id="avatarPreview2"
                                                    src="https://media.designcafe.com/wp-content/uploads/2023/07/05141750/aesthetic-room-decor.jpg"
                                                    alt="Profile" style="max-width:120px;">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-2 col-form-label"
                                                style="font-weight:bold">Đường dẫn hình ảnh 2:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="image2" type="text" class ="form-control"
                                                    id="image2" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                                <div class="invalid-feedback">Hình ảnh không hợp lệ</div>
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {

                                                const imageInput1 = document.getElementById('image1');
                                                const previewImage1 = document.getElementById('avatarPreview1');

                                                const imageInput2 = document.getElementById('image2');
                                                const previewImage2 = document.getElementById('avatarPreview2');

                                                const imageInput3 = document.getElementById('image3');
                                                const previewImage3 = document.getElementById('avatarPreview3');

                                                imageInput1.addEventListener('input', function() {
                                                    const imageUrl = imageInput1.value;

                                                    if (imageUrl) {
                                                        previewImage1.src = imageUrl;
                                                        previewImage1.style.display = 'block';
                                                    } else {
                                                        previewImage1.style.display = 'none';
                                                    }
                                                });

                                                imageInput2.addEventListener('input', function() {
                                                    const imageUrl = imageInput2.value;

                                                    if (imageUrl) {
                                                        previewImage2.src = imageUrl;
                                                        previewImage2.style.display = 'block';
                                                    } else {
                                                        previewImage2.style.display = 'none';
                                                    }
                                                });

                                                imageInput3.addEventListener('input', function() {
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
