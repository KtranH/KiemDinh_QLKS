@extends('container')
@section('content')
    <!-- Link icon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <title>GTX - Chi tiết đặt và nhận phòng</title>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Nhận và đặt phòng</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item">Nhận và đặt phòng</li>
                    <li class="breadcrumb-item active">Chi tiết nhận và đặt phòng</li>
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
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ctpdkt">Chi tiết
                                        nhận và đặt phòng</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div style="display:flex; justify-content:space-between; margin-bottom:20px">
                                    <div style="display:flex; flex-wrap:wrap; max-width:350px">

                                        @if (Session::has('error'))
                                            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                                        @endif

                                        <h5 class="card-title"
                                            style="font-family: 'Montserrat', sans-serif;
                                  font-optical-sizing: auto;
                                  font-weight: 400; 
                                  font-style: bold;">
                                            Nhận phòng từ
                                            <span style="font-weight:bold;color:red">{{ $takeCheckin->NgayCheckin }}</span>
                                            đến <span
                                                style="font-weight:bold;color:red">{{ $takeCheckin->NgayCheckOutDuKien }}</span>
                                        </h5>
                                        <div style="marign-bottom:20px">
                                            <a href="{{ route("showcheckin") }}" type="submit" class="btn btn-primary">Quay lại</a>
                                            <a href="{{ route("confirmcheckin", ['id' => $takeCheckin->_id, 'bill' => $takeBill])}}" type="submit" class="btn btn-primary confirm-checkin">Hoàn tất nhận phòng</a>
                                        </div>
                                        <script>
                                          $(document).ready(function(){
                                            $(".confirm-checkin").click(function(e){
                                              e.preventDefault();
                                              const rowCount = $('#CustomerTable tbody tr').length;
                                              if(rowCount < 2)
                                              {
                                                Swal.fire({ title: 'Cảnh báo', 
                                                text: "Vui lòng thêm một khách hàng để xác nhận hoàn thành!", 
                                                icon: 'error', 
                                                confirmButtonColor: '#d33', 
                                                confirmButtonText: 'Đồng ý'
                                                });
                                              }
                                              else
                                              {
                                                Swal.fire({ title: 'Bạn có chắc chắn muốn xác nhận hoàn thành không?', text: "Hãy chắc chắn số lượng khách, bạn sẽ không thể cập nhật thêm!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Đồng ý', cancelButtonText: 'Hủy bỏ'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        Swal.fire(
                                                            'Đã xác nhận!',
                                                            'Đang tiến hành xác nhận!',
                                                            'success'
                                                        );
                                                        setTimeout(() => {
                                                          window.location.href = "{{ route("confirmcheckin", ['id' => $takeCheckin->_id, 'bill' => $takeBill])}}";
                                                        }, 2000);
                                                    }
                                                });
                                              }
                                            });
                                          });
                                        </script>
                                    </div>

                                    <div style="display:flex; flex-wrap:wrap; justify-content:flex-end; max-width:350px">
                                        <h5 class="card-title"
                                            style="font-family: 'Montserrat', sans-serif;
                                  font-optical-sizing: auto;
                                  font-weight: 400;
                                  font-style: bold;
                                  ">
                                            Tổng tiền (tạm tính): <span
                                                style="font-weight:bold;color:red; font-size:18px">{{ number_format($takeBill, 0, ',', '.') }}</span>
                                                <span style="font-weight:bold">VNĐ</span>
                                        </h5>
                                        <div style="marign-bottom:20px">
                                            <a href="{{ route("cancelcheckin", ['id' => $takeCheckin->_id]) }}" type="submit" class="btn btn-danger cancel-checkin">Hủy nhận và đặt phòng</a>
                                        </div>
                                        <script>
                                          $(document).ready(function(){
                                            $(".cancel-checkin").click(function(e){
                                              e.preventDefault();
                                              Swal.fire({ title: 'Bạn có chắc chắn muốn hủy không?', text: "Bạn sẽ không thể khôi phục lại quyết định này!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Đồng ý', cancelButtonText: 'Hủy bỏ'
                                              }).then((result) => {
                                                  if (result.isConfirmed) {
                                                      Swal.fire(
                                                          'Đã hủy!',
                                                          'Đang tiến hành hủy!',
                                                          'success'
                                                      );
                                                      setTimeout(() => {
                                                        window.location.href = "{{ route("cancelcheckin", ['id' => $takeCheckin->_id]) }}";
                                                      }, 2000);
                                                  }
                                              });
                                            });
                                          });
                                        </script>
                                    </div>
                                </div>

                                <!-- Bảng hiển thị danh sách loại phòng -->
                                <h5 class="card-title"
                                    style="font-family: 'Montserrat', sans-serif;
                            font-optical-sizing: auto;
                            font-weight: bold;
                            font-style: normal;
                            ">
                                    Danh sách khách thuê phòng {{ $takeCheckin->Phong }} (sức chứa: <span
                                        style="color:red;font-weight:bold">{{ $takeCapacity }}</span>)</h5>
                                        
                                    <table class="table table-borderless datatable" id="CustomerTable">
                                          <thead>
                                              <tr>
                                                  <th scope="col">Tên khách</th>
                                                  <th scope="col">Số điện thoại</th>
                                                  <th scope="col">CMND</th>
                                                  <th scope="col">Chức năng</th>
                                              </tr>
                                          </thead>
                                          <tbody id="customerList">
                                                  <tr style="text-align:left">
                                                    <th></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                  </tr>
                                              @foreach ($takeListCustomer as $item)
                                                  <tr style="text-align:left" data-id="{{ $item['CMND'] }}">
                                                    <th scope="row"><a href="#" class="text-primary"><span style="font-weight:bold">{{ $item['TenKhachHang'] }}</span></a></th>
                                                    <td><a href="#" class="text-primary">{{ $item['SDT'] }}</a></td>
                                                    <td>{{ $item['CMND'] }}</td>
                                                    <td><a type="button" href="#" class="btn btn-danger remove-customer" data-id="{{ $item['CMND'] }}" style="border-radius:20%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"><i class="fi fi-br-cross"></i></a></td>
                                                  </tr>
                                              @endforeach
                                          </tbody>
                                    </table>

                                <h5 class="card-title"
                                    style="font-family: 'Montserrat', sans-serif;
                              font-optical-sizing: auto;
                              font-weight: bold;
                              font-style: normal;">
                                    Tra cứu khách hàng</h5>

                                <form id="searchForm" style="margin-bottom:20px">
                                    @csrf
                                    <div
                                        style="margin-top:10px; display:flex; justify-content: space-around;margin-bottom: 20px;">
                                        <div style="width:90%;margin-right:20px">
                                            <label for="makh" class="col-md-4 col-lg-3 col-form-label"
                                                style="font-weight:bold">Căn cước:</label>
                                            <div class="col-md-8 col-lg-12">
                                                <input name="makh" type="number" min="1" minlength="3"
                                                    class="form-control" id="makh"
                                                    style="box-shadow: rgba(32, 30, 30, 0.16) 0px 1px 4px;" required>
                                                <div class="invalid-feedback">Căn cước không hợp lệ</div>
                                            </div>
                                        </div>
                                        <div class="text-center" style="margin-top:38px;">
                                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </form>


                              <h5 class="card-title" style="font-family: 'Montserrat', sans-serif; font-optical-sizing: auto; font-weight: bold; font-style: normal;">
                                Kết quả tra cứu
                              </h5>
                              
                              <div id="resultTable">
                                  <table class="table table-borderless datatable">
                                      <thead>
                                          <tr>
                                              <th scope="col">Tên khách</th>
                                              <th scope="col">Số điện thoại</th>
                                              <th scope="col">CMND</th>
                                              <th scope="col">Chức năng</th>
                                          </tr>
                                      </thead>
                                      <tbody id="resultBody">
                                      </tbody>
                                  </table>
                              </div>
                              
                              <script>
                              $(document).ready(function() {
                                  $('#searchForm').on('submit', function(e) {
                                      e.preventDefault();
                              
                                      var makh = $('#makh').val();
                                      
                                      $.ajax({
                                          url: '{{ route('searchcheckin') }}',
                                          type: 'POST',
                                          data: {
                                              _token: '{{ csrf_token() }}',
                                              makh: makh
                                          },
                                          success: function(response) {
                                              $('#resultTable tbody').empty();
                              
                                              if (response.length > 0) {
                                                  response.forEach(function(item) {
                                                      $('#resultTable tbody').append(`
                                                          <tr style="text-align:left">
                                                              <th scope="row"><a href="#" class="text-primary">${item.TenKhachHang}</a></th>
                                                              <td><a href="#" class="text-primary">${item.SDT}</a></td>
                                                              <td>${item.CMND}</td>
                                                              <td>
                                                                  <a href="#" class="btn add-customer" data-id="${item.CMND}" style="border-radius:20%;margin-right:20px;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background-color:#74C0FC">
                                                                      <i class="fi fi-rr-file-edit"></i>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                      `);
                                                  });
                                              } else {
                                                  $('#resultTable tbody').append('<tr><td colspan="5" class="text-center">Không tìm thấy khách hàng</td></tr>');
                                              }
                                          },
                                          error: function() {
                                              alert('Có lỗi xảy ra, vui lòng thử lại');
                                          }
                                      });
                                  });
                                  $(document).on('click', '.add-customer', function(e) {
                                    e.preventDefault();
                                    const id = $(this).data('id');
                                    const idCheckin = '{{ $takeCheckin->_id }}';
                                    const capacity = '{{ $takeCapacity }}';
                                      $.ajax({
                                            url: '{{ route('addmorecustomer2') }}',
                                            type: 'GET',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                id: id,
                                                idCheckin: idCheckin,
                                                capacity: capacity
                                            },
                                            success: function(response) {
                                                if (response.success) {
                                                    alert(response.message);
                                                    const newRow = `
                                                      <tr style="text-align:left" data-id="${response.customer.CMND}">
                                                          <th scope="row"><a href="#" class="text-primary">${response.customer.TenKhachHang}</a></th>
                                                          <td><a href="#" class="text-primary">${response.customer.SDT}</a></td>
                                                          <td>${response.customer.CMND}</td>
                                                          <td>
                                                              <a type="button" href="#" class="btn btn-danger remove-customer" data-id="${response.customer.CMND}" style="border-radius:20%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                                                  <i class="fi fi-br-cross"></i>
                                                              </a>
                                                          </td>
                                                      </tr>
                                                  `;
                                                  $('#CustomerTable tbody').append(newRow); 

                                                } else {
                                                    alert(response.message);
                                                }
                                            },
                                            error: function() {
                                                alert('Có lỗi xảy ra khi thêm khách hàng!');
                                            }
                                        });
                                    });
                                    $(document).on('click', '.remove-customer', function(e) {
                                      e.preventDefault();
                                      const id = $(this).data('id');
                                      const index = $(this).closest('tr').index();
                                      const idCheckin = '{{ $takeCheckin->_id }}';

                                      if (confirm('Bạn có chắc muốn xóa khách hàng này không?')) {
                                          $.ajax({
                                              url: '{{ route('removecustomer') }}',
                                              type: 'GET',
                                              data: {
                                                  id: id,
                                                  idCheckin: idCheckin
                                              },
                                              success: function(response) {
                                                  if (response.success) {
                                                      alert(response.message);
                                                      $('#CustomerTable tbody tr[data-id="${id}"]').remove();
                                                      $('#CustomerTable tbody tr').eq(index).remove();
                                                  } else {
                                                      alert(response.message);
                                                  }
                                              },
                                              error: function() {
                                                  alert('Có lỗi xảy ra khi xóa khách hàng!');
                                              }
                                          });
                                        }
                                    });
                                });
                             
                              </script>

                              <h5 class="card-title" style="font-family: 'Montserrat', sans-serif; font-optical-sizing: auto; font-weight: bold; font-style: normal;">
                                Thêm mới khách hàng
                              </h5>

                              <form id="addCustomerForm">
                                @csrf
                                <div style="width:100%; margin-bottom:20px">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label" style="font-weight:bold">Họ tên:</label>
                                    <div class="col-md-8 col-lg-12">
                                        <input name="hoten" type="text" class="form-control" id="hoten" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                        <div class="invalid-feedback">Họ tên không hợp lệ</div>
                                    </div>
                                </div>
                                <div style="display:flex; justify-content: space-around;margin-bottom: 20px;">
                                    <div style="width:100%;margin-right:20px">
                                        <label for="cmnd" class="col-md-4 col-lg-3 col-form-label" style="font-weight:bold">Căn cước:</label>
                                        <div class="col-md-8 col-lg-12">
                                            <input name="cmnd" type="number" min="1" minlength="3" class="form-control" id="cmnd" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                            <div class="invalid-feedback">Căn cước không hợp lệ</div>
                                        </div>
                                    </div>
                                    <div style="width:100%">
                                        <label for="sdt" class="col-md-4 col-lg-3 col-form-label" style="font-weight:bold">Số điện thoại:</label>
                                        <div class="col-md-8 col-lg-12">
                                            <input name="sdt" type="number" min="1" minlength="3" class="form-control" id="sdt" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" required>
                                            <div class="invalid-feedback">Số điện thoại không hợp lệ</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center" style="margin-top:20px;">
                                    <button type="submit" class="btn btn-primary">Thêm khách hàng</button>
                                </div>
                              </form>
                              <script>
                                $(document).ready(function() {
                                  $('#addCustomerForm').on('submit', function(e) {
                                      e.preventDefault(); 

                                      const formData = {
                                        hoten: $('#hoten').val(),
                                        cmnd: $('#cmnd').val(),
                                        sdt: $('#sdt').val(),
                                      };

                                      const id = '{{ $takeCheckin->_id }}'; 
                                      const idCheckin = '{{ $takeCheckin->_id }}';
                                      const capacity = '{{ $takeCapacity }}';

                                      $.ajax({
                                          url: '{{ route('addmorecustomer') }}',
                                          type: 'POST',
                                          data: {
                                              _token: '{{ csrf_token() }}', 
                                              hoten: formData.hoten,
                                              cmnd: formData.cmnd,
                                              sdt: formData.sdt,
                                              id: id,
                                              idCheckin: idCheckin,
                                              capacity: capacity
                                          },
                                          success: function(response) {
                                              if (response.success) {
                                                  const newRow = `
                                                      <tr style="text-align:left">
                                                          <th scope="row"><a href="#" class="text-primary">${response.customer.TenKhachHang}</a></th>
                                                          <td><a href="#" class="text-primary">${response.customer.SDT}</a></td>
                                                          <td>${response.customer.CMND}</td>
                                                          <td>
                                                              <a type="button" href="#" class="btn btn-danger" style="border-radius:20%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                                                  <i class="fi fi-br-cross"></i>
                                                              </a>
                                                          </td>
                                                      </tr>
                                                  `;
                                                  $('#CustomerTable tbody').append(newRow); 

                                                  $('input[name="hoten"]').val('');
                                                  $('input[name="cmnd"]').val('');
                                                  $('input[name="sdt"]').val('');

                                                  alert(response.message); 
                                              } else {
                                                  alert(response.message);
                                              }
                                          },
                                          error: function(xhr) {
                                              alert('Đã có lỗi xảy ra, vui lòng thử lại.');
                                          }
                                      });
                                  });
                              });
                              </script>
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
