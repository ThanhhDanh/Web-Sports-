# Web-Sports-
Website for selling sports goods
# ⚽ Web Sports Management

Một hệ thống quản lý thể thao được xây dựng bằng **Laravel**, sử dụng **Livewire** cho admin dashboard và **Vue.js** cho frontend người dùng.

## 🛠️ Công nghệ sử dụng

- **PHP 8+**
- **Laravel 10**
- **Livewire** – Tạo giao diện tương tác cho admin mà không cần viết nhiều JavaScript
- **Vue.js 3** – Giao diện frontend mượt mà, reactive
- **MySQL** – Lưu trữ dữ liệu
- **Bootstrap 4** – Giao diện responsive
- **Laragon** – Môi trường dev nhanh gọn trên Windows

## 🚀 Tính năng chính

### 🎯 Frontend (Vue.js)

- Xem danh sách sản phẩm thể thao
- Tìm kiếm & lọc sản phẩm
- Thêm vào giỏ hàng
- Đặt hàng và thanh toán

### 🛡️ Backend (Livewire Admin)

- Quản lý sản phẩm (CRUD)
- Quản lý danh mục, màu sắc, kích thước
- Quản lý đơn hàng
- Phân quyền người dùng với `spatie/laravel-permission`
- Thống kê doanh thu

## 🔧 Cài đặt

```bash
# Clone dự án
git clone https://github.com/ThanhhDanh/Web-Sports-.git
cd Web-Sports-

# Cài đặt backend
composer install

# Cài đặt frontend
npm install
npm run dev

# Tạo file môi trường và generate key
cp .env.example .env
php artisan key:generate

# Cấu hình database trong .env rồi chạy migrate
php artisan migrate --seed

# Chạy server
php artisan serve
