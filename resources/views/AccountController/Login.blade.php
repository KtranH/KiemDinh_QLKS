<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Đăng nhập quản lý khách sạn</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="keywords">
  
    <!-- Favicons -->
    <link href="{{ url('assets/img/favicon.png')}}" rel="icon">
    <link href="{{ url('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@0;1&display=swap" rel="stylesheet">
   
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  
    <!-- Vendor CSS Files -->
    <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  
    <!-- Template Main CSS File -->
    <link href="{{ url('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ url('assets/css/khoi.css')}}" rel="stylesheet">
</head>

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Khách sạn - GTX</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3" style="border-radius:20px">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4"
                                            style="font-family: Montserrat, sans-serif;font-optical-sizing: auto;font-weight: 500;">
                                            Đăng nhập tài khoản của bạn</h5>

                                        <p class="text-center small">Truy cập vào trang quản lý</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST"
                                        action="{{ route('loadlogin') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Nhập email của bạn</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="yourUsername" required>
                                                @error('email')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong></div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Mật khẩu</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="yourPassword" required>
                                            @error('password')
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></div>
                                            @enderror
                                        </div>

                                        @if (Session::has('error'))
                                            <div class="col-12">
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ Session::get('error') }}</strong>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" style="border-radius:20px"
                                                type="submit">Đăng nhập</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Chưa có tài khoản? <a href="#">Hãy liên hệ quản
                                                    lý của bạn</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="credits">
                                Chào mừng bạn đến <a href="/">Khách sạn GTX</a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->
</body>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script type="text/javascript" src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script type="text/javascript" src="{{ asset('assets/js/main.js')}}"></script>
</html>
