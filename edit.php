<?php
include './config.php';

session_start();

// Kiểm tra xem đã đăng nhập chưa, nếu chưa thì chuyển hướng về trang đăng nhập
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn SQL để lấy thông tin môn học cần sửa
    $sql = "SELECT * FROM DangKyMonHoc WHERE ID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        // Redirect hoặc hiển thị thông báo nếu không tìm thấy môn học
        header("location: danh_sach_dang_ky_mon_hoc.php");
        exit();
    }
} else {
    // Redirect hoặc hiển thị thông báo nếu không có ID được cung cấp
    header("location: danh_sach_dang_ky_mon_hoc.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa môn học đã đăng ký</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
    <header class="header">
        <ul>
            <li class="nav_link"><a href="./danh_sach_dang_ky_mon_hoc.php">Trang chủ</a></li>
            <li class="nav_link"><a href="./dang_ky_mon_hoc.php">Đăng ký môn học</a></li>
        </ul>

        <div class="nav_item">
            <h3 class="username">Xin chào, <span><?php echo $_SESSION["username"]; ?></span></h3>
            <button onclick="logout()">Đăng xuất</button>
        </div>
    </header>
    <main>
        <h2 class="title">Sửa môn học đã đăng ký</h2>

        <form method="post" action="update.php" class="form_dang_ky">
            <!-- Form để nhập thông tin môn học cần sửa -->
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
            <label for="maSinhVien">Mã sinh viên:</label>
            <input type="text" id="maSinhVien" name="maSinhVien" value="<?php echo $row['MaSinhVien']; ?>"><br><br>
            <label for="maMonHoc">Mã môn học:</label>
            <input type="text" id="maMonHoc" name="maMonHoc" value="<?php echo $row['MaMonHoc']; ?>"><br><br>
            <label for="namHoc">Năm học đăng ký:</label>
            <input type="text" id="namHoc" name="namHoc" value="<?php echo $row['NamHoc']; ?>"><br><br>
            <label for="hocKy">Học kỳ đăng ký:</label>
            <input type="text" id="hocKy" name="hocKy" value="<?php echo $row['HocKy']; ?>"><br><br>
            <input type="submit" value="Lưu">
        </form>
    </main>
    <script>
        function logout() {
            // Chuyển hướng đến trang đăng xuất khi nhấn nút "Đăng xuất"
            window.location.href = "index.php";
        }
    </script>
    <script src="./assets/main.js"></script>
</body>

</html>