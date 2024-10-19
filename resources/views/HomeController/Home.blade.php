@extends('container')
@section('content')    
<title>GTX - Trang quản lý</title>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Trang chủ</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Trang chủ</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card" style="border-radius:20px">

              <div class="card-body">
                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                font-optical-sizing: auto;
                font-weight: 600;
                font-style: normal;
                font-size: 14px;">Số khách lưu trú <span>| Tất cả</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-users" style="color: #74C0FC;"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      {{ $count_Customer }}
                    </h6>
                    <span class="text-success small pt-1 fw-bold">Đã</span><span class="text-muted small pt-2 ps-1">ghé thăm</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card" style="border-radius:20px">
          
              <div class="card-body">
                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                font-optical-sizing: auto;
                font-weight: 600;
                font-style: normal;
                font-size: 14px;">Số phòng còn trống <span>| Tất cả</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-table-list" style="color: #63E6BE;"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      {{ $count_Room }}
                    </h6>
                    <span class="text-success small pt-1 fw-bold">Vẫn còn</span><span class="text-muted small pt-2 ps-1">trống</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card" style="border-radius:20px">

              <div class="card-body">
                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                font-optical-sizing: auto;
                font-weight: 600;
                font-style: normal;
                font-size: 14px;">Doanh thu <span>| Tất cả</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-star" style="color: #fb5032;"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      {{number_format($count_Revenue, 0, ',','.') }}
                    </h6>
                    <span class="text-danger small pt-1 fw-bold">VNĐ</span><span class="text-muted small pt-2 ps-1">từ trước đến nay</span>

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->
          
                  <!-- Website Traffic -->
          <div class="card" style="border-radius:20px">

            <div class="card-body pb-0">
              <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
              font-optical-sizing: auto;
              font-weight: 600;
              font-style: normal;
              font-size: 14px;">Dịch vụ được sử dụng nhiều nhất <span>| Tất cả</span></h5>

              <div id="SimpleChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#SimpleChart")).setOption({
                    dataset: {
                    source: [
                      ['score', 'amount', 'product'],
                      @foreach ($count_Service as $item)
                        ['{{ $item['DG'] }}', '{{ $item['SL'] }}', '{{ $item['DV'] }}'],
                      @endforeach
                    ]
                  },
                  grid: { containLabel: true },
                  xAxis: { name: 'amount' },
                  yAxis: { type: 'category' },
                  visualMap: {
                    orient: 'horizontal',
                    left: 'center',
                    min: 10,
                    max: 100,
                    text: ['High Score', 'Low Score'],
                    // Map the score column to color
                    dimension: 0,
                    inRange: {
                      color: ['#65B581', '#FFCE34', '#FD665F']
                    }
                  },
                  series: [
                    {
                      type: 'bar',
                      encode: {
                        // Map the "amount" column to X axis.
                        x: 'amount',
                        // Map the "product" column to Y axis
                        y: 'product'
                      }
                    }
                  ]
                });
                });
              </script>

            </div>
          </div><!-- End Website Traffic -->
        
          <!-- Recent Sales -->
          @if (Session::has('success'))
            <div class="alert alert-success" role="alert">{{ Session::get('success')}}</div>
          @endif
          @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">{{ Session::get('error')}}</div>
          @endif
          
          <div class="col-12">
            <div class="card recent-sales overflow-auto" style="border-radius:20px">

              <div class="card-body">
                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                font-optical-sizing: auto;
                font-weight: 600;
                font-style: normal;
                font-size: 14px;">Danh sách chờ xác nhận <span>| Tất cả</span></h5>

                <h5 id="title" style="color:red;font-weight:bold"></h5>
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th scope="col">Mã phiếu</th>
                            <th scope="col">Nhân viên</th>
                            <th scope="col">Tên phòng</th>
                            <th scope="col">Ngày nhận phòng</th>
                            <th scope="col">Ngày trả phòng</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkin as $item)
                            <tr>
                                <th scope="row"><a href="#">{{ $item->_id }}</a></th>
                                <td>{{ $item->NhanVienLap }}</td>
                                <td><a href="#" class="text-primary" style="text-align:center">{{ $item->Phong }}</a></td>
                                <td>{{ $item->NgayCheckin }}</td>
                                <td>{{ $item->NgayCheckOutDuKien }}</td>
                                <td>
                                    <span class="badge bg-warning">{{ $item->TinhTrang }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('showupdatedetailcheckin', ['id' => $item->_id]) }}" type="button" class="btn" style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>             
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div><!-- End Recent Sales -->

          <!-- Top Selling -->
          <div class="col-12">
            <div class="card top-selling overflow-auto" style="border-radius:20px">

              <div class="card-body pb-0">
                <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
                font-optical-sizing: auto;
                font-weight: 600;
                font-style: normal;
                font-size: 14px;">Danh sách quá hạn trả phòng <span>| Tất cả</span></h5>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">Mã checkout</th>
                      <th scope="col">Mã nhân viên</th>
                      <th scope="col">Tên phòng</th>
                      <th scope="col">Ngày đặt</th>
                      <th scope="col">Ngày trả phòng</th>
                      <th scope="col">Tình trạng</th>
                      <th scope="col">Chức năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($checkout as $item)
                      <tr>
                          <th scope="row"><a href="#">{{ $item->_id}}</a></th>
                          <td>{{ $item->bookingCheckin->NhanVienLap }}</td>
                          <td>{{ $item->bookingCheckin->Phong }}</td>
                          <td>{{ $item->bookingCheckin->NgayCheckin}}</td>
                          <td>{{ $item->bookingCheckin->NgayCheckOutDuKien }}</td>
                          <td>
                              <span class="badge bg-danger">{{ $item->TinhTrang }}</span>
                          </td>
                          <td>
                              <a href="{{ route('showdetailcheckout', ['id' => $item->_id ]) }}" type="button" class="btn" style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC"><i class="fa-solid fa-pen-to-square"></i></a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>

            </div>
          </div><!-- End Top Selling -->

        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Budget Report -->
        <div class="card" style="border-radius:20px">


          <div class="card-body pb-0">
            <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
            font-size: 14px;">Thống kê nhận phòng và hủy phòng <span>| Tất cả</span></h5>

            <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                  tooltip: {
                  trigger: 'axis',
                  axisPointer: {
                    type: 'shadow'
                  }
                },
                  legend: {},
                  xAxis: {
                  type: 'category',
                  data: ['Số lượng']
                },
                yAxis: {
                  type: 'value'
                },
                series: [
                  {
                    name: "Đã nhận phòng",
                    data: [{{ $count_Complete_Checkin }}],
                    type: 'bar'
                  },
                  {
                    name: "Chờ xác nhận",
                    data: [{{ $count_Reserve_Checkin }}],
                    type: 'bar'
                  },
                  {
                    name: "Hủy phòng",
                    data: [{{ $count_Cancel_Checkin }}],
                    color: 'red',
                    type: 'bar'
                  }
                ]
                });
              });
            </script>

          </div>
        </div><!-- End Budget Report -->

         <!-- Website Traffic -->
         <div class="card" style="border-radius:20px">

          <div class="card-body pb-0">
            <h5 class="card-title" style="margin-top:-10px; font-family: 'Montserrat', sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
            font-size: 14px;">Số lượng các loại phòng <span>| Tất cả</span></h5>

            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#trafficChart")).setOption({
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    top: '5%',
                    left: 'center'
                  },
                  series: [{
                    name: 'Đang hiển thị',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                      show: false,
                      position: 'center'
                    },
                    emphasis: {
                      label: {
                        show: true,
                        fontSize: '18',
                        fontWeight: 'bold'
                      }
                    },
                    labelLine: {
                      show: false
                    },
                    data: [
                      @foreach ($count_Category_Room as $item)
                        {
                          value: '{{ $item["Số phòng"] }}', 
                          name: '{{ $item["Mã loại"] }}'
                        },
                      @endforeach
                    ]
                  }]
                });
              });
            </script>

          </div>
        </div><!-- End Website Traffic -->
        <div class="text-center" style="margin-bottom:20px">
            <a href="{{ route("reloadhome") }}" class="btn btn-primary confirm-checkout"
                style="border-radius:20px;width:90%"><i class="fa-solid fa-rotate-right" style="color: #ffff"></i> Làm mới dữ liệu
          </a>
        </div>
      </div><!-- End Right side columns -->

    </div>
  </section>

</main><!-- End #main -->

@endsection