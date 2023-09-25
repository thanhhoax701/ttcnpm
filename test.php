<?php
    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "dangkymonhoc");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    // Kiểm tra nút xóa đã được bấm hay chưa
    if (isset($_POST['xoa'])) {
        $id = $_POST['id']; // ID của danh sách đăng ký cần xóa

        // Thực hiện câu truy vấn xóa danh sách đăng ký của sinh viên
        $sql_delete = "DELETE FROM DangKyMonHoc WHERE ID = $id";

        if (mysqli_query($conn, $sql_delete)) {
            echo '<script>showMessage(); setTimeout(hideMessage, 3000);</script>';
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }

    // Câu truy vấn SQL để lấy thông tin từ bảng và liên kết các bảng
    $sql = "SELECT DangKyMonHoc.ID AS STT,
                   QuanLySinhVien.MaSinhVien,
                   QuanLySinhVien.HoTenSinhVien,
                   QuanLyMonHoc.MaMonHoc,
                   QuanLyMonHoc.TenMonHoc,
                   QuanLyMonHoc.SoTinChi,
                   DangKyMonHoc.NamHoc,
                   DangKyMonHoc.HocKy
            FROM DangKyMonHoc
            INNER JOIN QuanLySinhVien ON DangKyMonHoc.MaSinhVien = QuanLySinhVien.MaSinhVien
            INNER JOIN QuanLyMonHoc ON DangKyMonHoc.MaMonHoc = QuanLyMonHoc.MaMonHoc
            ORDER BY DangKyMonHoc.ID";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr>
                <th>STT</th>
                <th>Mã sinh viên</th>
                <th>Họ tên sinh viên</th>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Số tín chỉ</th>
                <th>Năm học</th>
                <th>Học kỳ</th>
                <th>Thao tác</th>
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
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="' . $row['STT'] . '">
                            <input type="submit" name="xoa" value="Xóa">
                        </form>
                    </td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo "Không có dữ liệu.";
    }

    // Đóng kết nối
    mysqli_close($conn);
    ?>

    <br>

    <form method="post" id="searchForm">
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

    <script>
        document.querySelector("#searchForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const maMonHoc = document.querySelector("#maMonHoc").value;
            const tenMonHoc = document.querySelector("#tenMonHoc").value;

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const resultTable = document.querySelector("#tableResult");
                    resultTable.innerHTML = xhr.responseText;
                    document.querySelector("#ketQuaTimKiem").classList.remove("hidden");
                }
            };

            xhr.open("POST", "search.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(`maMonHoc=${maMonHoc}&tenMonHoc=${tenMonHoc}`);
        });
    </script>