<?php
// Kết nối đến cơ sở dữ liệu
include './config.php';

session_start();

// Kiểm tra xem đã đăng nhập chưa, nếu chưa thì chuyển hướng về trang đăng nhập
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit();
}

// Truy vấn SQL để lấy thông tin từ các bảng
$sql = "SELECT DangKyMonHoc.*, QuanLySinhVien.HoTenSinhVien, QuanLyMonHoc.TenMonHoc, QuanLyMonHoc.SoTinChi
        FROM DangKyMonHoc
        INNER JOIN QuanLySinhVien ON DangKyMonHoc.MaSinhVien = QuanLySinhVien.MaSinhVien
        INNER JOIN QuanLyMonHoc ON DangKyMonHoc.MaMonHoc = QuanLyMonHoc.MaMonHoc
        ORDER BY DangKyMonHoc.ID";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đăng ký môn học</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
    <header class="header">
        <ul>
            <li class="nav_link"><a href="#">Trang chủ</a></li>
            <li class="nav_link"><a href="./dang_ky_mon_hoc.php">Đăng ký môn học</a></li>
        </ul>

        <div class="nav_item">
            <h3 class="username">Xin chào, <span><?php echo $_SESSION["username"]; ?></span></h3>
            <button onclick="logout()">Đăng xuất</button>
        </div>
    </header>

    <main>
        <h2 class="title">Quản lý đăng ký môn học</h2>

        <table border="1">
            <tr>
                <th>STT</th>
                <th>Mã sinh viên</th>
                <th>Họ tên sinh viên</th>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Số tín chỉ</th>
                <th>Năm học đăng ký</th>
                <th>Học kỳ đăng ký</th>
                <th>Thao tác</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                $stt = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $stt . "</td>";
                    echo "<td>" . $row["MaSinhVien"] . "</td>";
                    echo "<td>" . $row["HoTenSinhVien"] . "</td>";
                    echo "<td>" . $row["MaMonHoc"] . "</td>";
                    echo "<td>" . $row["TenMonHoc"] . "</td>";
                    echo "<td>" . $row["SoTinChi"] . "</td>";
                    echo "<td>" . $row["NamHoc"] . "</td>";
                    echo "<td>" . $row["HocKy"] . "</td>";
                    // echo '<td><a href="delete.php?id=' . $row["ID"] . '">Xóa</a></td>';
                    echo '<td><a href="edit.php?id=' . $row["ID"] . '">Sửa</a> | <a href="delete.php?id=' . $row["ID"] . '">Xóa</a></td>';
                    echo "</tr>";
                    $stt++;
                }
            } else {
                echo "<tr><td colspan='9'>Không có dữ liệu</td></tr>";
            }
            ?>
        </table>


        <br>

        <form method="post" id="searchForm" class="">
            <label for="maMonHoc">Tìm kiếm theo Mã môn học:</label>
            <input type="text" id="maMonHoc" name="maMonHoc">

            <label for="tenMonHoc">Tìm kiếm theo Tên môn học:</label>
            <input type="text" id="tenMonHoc" name="tenMonHoc">

            <input type="submit" name="timKiem" value="Tìm kiếm">
        </form>

        <div id="ketQuaTimKiem" class="hidden">
            <h2>Kết quả tìm kiếm:</h2>
            <table id="tableResult">
                <!-- Dữ liệu kết quả tìm kiếm sẽ được hiển thị ở đây -->
            </table>
        </div>
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

<?php
$conn->close();
?>