# Video demo sản phẩm

[Bấm vào đây!!!](https://drive.google.com/file/d/1-8W7JtTVvmP6br3Q_Ja0hhHYlJ5Dccor/view?usp=drive_link)

# Phần mềm quản lý đặt phòng khách sạn

Đề tài "Quản Lý Phòng Đặt Khách Sạn". Giả định các tình huống giữa nhân viên và khách hàng khi khách có nhu cầu đặt phòng tại khách sạn, nhân viên thực hiện các nghiệp vụ cần thiết để đáp ứng nhu cầu của khách hàng. Thực hiện các chức năng đặt phòng và thanh toán đặt phòng ở khách sạn, tổng quan được các đơn đặt phòng đã đặt, tính toán chi phí các hóa đơn, xem lịch sử đặt phòng, chi tiết từng phòng.

![Tổng quan](https://scontent.fsgn5-12.fna.fbcdn.net/v/t1.15752-9/462547521_1069517708111820_5310263214614591244_n.png?_nc_cat=103&ccb=1-7&_nc_sid=9f807c&_nc_ohc=GmjZg41ZrkMQ7kNvgGJY9WD&_nc_zt=23&_nc_ht=scontent.fsgn5-12.fna&_nc_gid=AdxnJVlITiMwZrRSqb_uQPS&oh=03_Q7cD1QHuPjlOd2Q1OhTn7NnuaKqFQvYKfJjSeM836yR_P3Q4yw&oe=67382D36)

# Phạm vi đề tài

Giới hạn trong phạm vi giả định, chỉ tập trung vào 2 nghiệp vụ chính là đặt, nhận phòng và thanh toán đơn trả phòng. Ngoài ra còn các chức năng nhật kí phòng ghi lại lịch sử đặt của khách hoặc của phòng.

# Công nghệ sử dụng

1.    Ngôn ngữ: PHP
2.    Framework: Laravel
3.    Database: MongoDB

# Tổng quan database

![Database Overview](https://scontent.fsgn5-14.fna.fbcdn.net/v/t1.15752-9/462479445_844603594173176_2014272407004763926_n.png?_nc_cat=101&ccb=1-7&_nc_sid=9f807c&_nc_ohc=H84OEFSowk4Q7kNvgEVQaJT&_nc_zt=23&_nc_ht=scontent.fsgn5-14.fna&_nc_gid=ATerR1oL9-PpE3NCmTLHg4C&oh=03_Q7cD1QH-O-QSU51bHrwGk8yo7_fY-Akx6qt2UF5E4LsH0wV-PQ&oe=67375844)

# Các bước cài đặt

1. ### Tạo project laravel

   ```bash
   composer create-project laravel/laravel QLKS
   ```
2. ### Cài đặt MongoDB for Windown từ [PECL](https://pecl.php.net/package/mongodb/1.17.1/windows)
   
   Sau khi tải xuống thì thêm file '.dll' vào thư mục extensions của PHP
     
   Thêm dòng sau vào file php.ini:
   ```bash
   extension=mongodb
   ```
4. ### Cài đặt jensegers/mongodb
   
   ```bash
   composer require jenssegers/mongodb
   ```
6. ### Cấu hình lại file .env
   
   ```bash
   DB_CONNECTION=mongodb
   DB_HOST=127.0.0.1
   DB_PORT=27017
   DB_DATABASE=ten_cua_database
   DB_USERNAME=
   DB_PASSWORD=
   
   SESSION_DRIVER=file
   ```
# Thành viên trong nhóm

| Họ và tên | MSSV |
|-----------|------|
| Trần Hoàng Anh Khôi | 2001215584 |
| Vũ Thị Bảo Yến | 2001216334 |
| Nguyễn Tấn Lâm | 2001210056 |
| Phạm Thị Thanh Tình | 2001216218 |
