<?php
// Kết nối đến cơ sở dữ liệu
include './config.php';

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSinhVien = $_POST["maSinhVien"];
    $maMonHoc = $_POST["maMonHoc"];
    $namHoc = $_POST["namHoc"];
    $hocKy = $_POST["hocKy"];

    // Kiểm tra các thông tin không được rỗng
    if (!empty($maSinhVien) && !empty($maMonHoc) && !empty($namHoc) && !empty($hocKy)) {
        // Kiểm tra xem mã sinh viên và mã môn học có tồn tại trong cơ sở dữ liệu không
        $sql_check = "SELECT * FROM QuanLySinhVien WHERE MaSinhVien = '$maSinhVien'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $sql_check = "SELECT * FROM QuanLyMonHoc WHERE MaMonHoc = '$maMonHoc'";
            $result_check = $conn->query($sql_check);

            if ($result_check->num_rows > 0) {
                // Thực hiện thêm bản ghi vào bảng Đăng Ký Môn Học
                $sql_insert = "INSERT INTO DangKyMonHoc (MaSinhVien, MaMonHoc, NamHoc, HocKy) VALUES ('$maSinhVien', '$maMonHoc', '$namHoc', '$hocKy')";
                if ($conn->query($sql_insert) === true) {
                    echo "Đăng ký môn học thành công!";
                } else {
                    echo "Lỗi: " . $conn->error;
                }
            } else {
                echo "Mã môn học không tồn tại.";
            }
        } else {
            echo "Mã sinh viên không tồn tại.";
        }
    } else {
        echo "Vui lòng điền đầy đủ thông tin.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký môn học </title>
</head>

<body>
    <h2>Đăng ký môn học</h2>
    <form method="post" action="">
        <label for="maSinhVien">Mã sinh viên:</label>
        <input type="text" id="maSinhVien" name="maSinhVien"><br><br>
        <label for="maMonHoc">Mã môn học:</label>
        <input type="text" id="maMonHoc" name="maMonHoc"><br><br>
        <label for="namHoc">Năm học đăng ký:</label>
        <input type="text" id="namHoc" name="namHoc"><br><br>
        <label for="hocKy">Học kỳ đăng ký:</label>
        <input type="text" id="hocKy" name="hocKy"><br><br>
        <input type="submit" value="Đăng ký">
    </form>
</body>

</html>


<?php
$conn->close();
?>