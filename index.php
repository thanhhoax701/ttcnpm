<?php
include './config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]); // Mã hóa mật khẩu theo MD5

    $sql = "SELECT * FROM QuanLyNguoiDung WHERE TaiKhoan = '$username' AND MatKhau = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("location: danh-sach-dang-ky-mon-hoc.php");
    } else {
        $error_message = "Tài khoản và mật khẩu không đúng";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
    <h2>Đăng nhập</h2>
    <form method="post" action="">
        <label for="username">Tài khoản:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Đăng nhập">
    </form>
    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
</body>

</html>