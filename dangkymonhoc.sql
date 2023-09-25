-- Tạo cơ sở dữ liệu
CREATE DATABASE dangkymonhoc;

-- Sử dụng cơ sở dữ liệu
USE dangkymonhoc;

-- Tạo bảng quản lý người dùng
CREATE TABLE QuanLyNguoiDung (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    TaiKhoan VARCHAR(25) NOT NULL,
    MatKhau CHAR(32) NOT NULL
);

-- Tạo bảng quản lý thông tin sinh viên
CREATE TABLE QuanLySinhVien (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    MaSinhVien VARCHAR(15) NOT NULL,
    HoTenSinhVien VARCHAR(250) NOT NULL,
    NgayThangNamSinh VARCHAR(10) NOT NULL
);

-- Tạo bảng quản lý thông tin môn học
CREATE TABLE QuanLyMonHoc (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    MaMonHoc VARCHAR(15) NOT NULL,
    TenMonHoc VARCHAR(250) NOT NULL,
    SoTinChi VARCHAR(11) NOT NULL
);

-- Tạo bảng đăng ký môn học
CREATE TABLE DangKyMonHoc (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    MaSinhVien VARCHAR(15) NOT NULL,
    MaMonHoc VARCHAR(15) NOT NULL,
    NamHoc VARCHAR(4) NOT NULL,
    HocKy INT NOT NULL,
    UNIQUE KEY (MaSinhVien, MaMonHoc, NamHoc, HocKy)
);


-- Thêm dữ liệu mẫu cho bảng QuanLyNguoiDung (người dùng)
INSERT INTO QuanLyNguoiDung (TaiKhoan, MatKhau) VALUES
    ('admin', MD5('admin')),
    ('user1', MD5('1')),
    ('user2', MD5('2'));

-- Thêm dữ liệu mẫu cho bảng QuanLySinhVien (thông tin sinh viên)
INSERT INTO QuanLySinhVien (MaSinhVien, HoTenSinhVien, NgayThangNamSinh) VALUES
    ('SV001', 'Nguyen Van A', '1990-01-01'),
    ('SV002', 'Tran Thi B', '1992-05-15'),
    ('SV003', 'Le Van C', '1995-09-30');

-- Thêm dữ liệu mẫu cho bảng QuanLyMonHoc (thông tin môn học)
INSERT INTO QuanLyMonHoc (MaMonHoc, TenMonHoc, SoTinChi) VALUES
    ('MH001', 'Toan cao cap', '4'),
    ('MH002', 'Kien truc may tinh', '3'),
    ('MH003', 'Co so du lieu', '2');

-- Thêm dữ liệu mẫu cho bảng DangKyMonHoc (đăng ký môn học)
INSERT INTO DangKyMonHoc (MaSinhVien, MaMonHoc, NamHoc, HocKy) VALUES
    ('SV001', 'MH001', '2021', 1),
    ('SV001', 'MH002', '2021', 2),
    ('SV002', 'MH001', '2021', 1),
    ('SV003', 'MH003', '2022', 3);
