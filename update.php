<?php
include './config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $maSinhVien = $_POST['maSinhVien'];
    $maMonHoc = $_POST['maMonHoc'];
    $namHoc = $_POST['namHoc'];
    $hocKy = $_POST['hocKy'];
    
    // Kiểm tra điều kiện và cập nhật dữ liệu
    if ($namHoc && $hocKy) {
        $sql_update = "UPDATE DangKyMonHoc SET NamHoc = '$namHoc', HocKy = '$hocKy' WHERE ID = $id";
        
        if ($conn->query($sql_update) === true) {
            echo '<script>alert("Cập nhật môn học thành công!");</script>';
            echo '<script>window.location.href = "danh_sach_dang_ky_mon_hoc.php";</script>';
        } else {
            echo '<script>alert("Lỗi: ' . $conn->error . '");</script>';
        }
    } else {
        echo '<script>alert("Vui lòng điền đầy đủ thông tin!");</script>';
    }
} else {
    // Redirect hoặc hiển thị thông báo nếu không có dữ liệu POST
    echo '<script>alert("Chưa có sự chỉnh sửa nào được thực hiện!");</script>';
}
// Quay về trang danh_sach_dang_ky_mon_hoc.php
echo '<script>window.location.href = "danh_sach_dang_ky_mon_hoc.php";</script>';

?>
