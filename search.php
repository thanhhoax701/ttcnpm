<?php
// Kết nối đến cơ sở dữ liệu
include './config.php';

if (isset($_POST['maMonHoc']) && isset($_POST['tenMonHoc'])) {
    $maMonHoc = $_POST['maMonHoc'];
    $tenMonHoc = $_POST['tenMonHoc'];

    $sql = "SELECT
                ROW_NUMBER() OVER (ORDER BY DangKyMonHoc.ID) AS STT,
                DangKyMonHoc.MaSinhVien,
                QuanLySinhVien.HoTenSinhVien,
                DangKyMonHoc.MaMonHoc,
                QuanLyMonHoc.TenMonHoc,
                QuanLyMonHoc.SoTinChi,
                DangKyMonHoc.NamHoc,
                DangKyMonHoc.HocKy
            FROM
                DangKyMonHoc
            INNER JOIN
                QuanLySinhVien ON DangKyMonHoc.MaSinhVien = QuanLySinhVien.MaSinhVien
            INNER JOIN
                QuanLyMonHoc ON DangKyMonHoc.MaMonHoc = QuanLyMonHoc.MaMonHoc
            WHERE
                DangKyMonHoc.MaMonHoc LIKE '%$maMonHoc%'
                OR QuanLyMonHoc.TenMonHoc LIKE '%$tenMonHoc%'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<tr>
                <th>STT</th>
                <th>Mã sinh viên</th>
                <th>Họ tên sinh viên</th>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Số tín chỉ</th>
                <th>Năm học đăng ký</th>
                <th>Học kỳ</th>
            </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row['STT'] . '</td>
                    <td>' . $row['MaSinhVien'] . '</td>
                    <td>' . $row['HoTenSinhVien'] . '</td>
                    <td>' . $row['MaMonHoc'] . '</td>
                    <td>' . $row['TenMonHoc'] . '</td>
                    <td>' . $row['SoTinChi'] . '</td>
                    <td>' . $row['NamHoc'] . '</td>
                    <td>' . $row['HocKy'] . '</td>
                  </tr>';
        }
    } else {
        echo "Không có dữ liệu.";
    }
}

mysqli_close($conn);
?>