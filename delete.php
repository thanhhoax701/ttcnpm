<?php
include './config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Lấy ID từ URL
    $id = $_GET['id'];

    // Truy vấn SQL để xóa bản ghi
    $sql = "DELETE FROM DangKyMonHoc WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Xóa danh sách đăng ký thành công.');</script>";
        echo "<script>window.location.href = 'danh-sach-dang-ky-mon-hoc.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $conn->close();
}
