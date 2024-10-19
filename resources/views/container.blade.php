<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

  <!-- JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Tagify CSS -->
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
  <!-- Tagify JS -->
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

</head>

<body>
    @include('header')
    @include('sidebar')
    @yield('content')
    @include('footer')
    
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
