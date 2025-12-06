<?php
// Tệp View CHỈ chứa HTML và logic hiển thị (echo, foreach) [cite: 66]
// Tệp View KHÔNG chứa câu lệnh SQL [cite: 67]
?>
<!DOCTYPE html>
<html lang="vi">
<body>
    <h2>Thêm Sinh Viên Mới (Kiến trúc MVC)</h2>
    <form method="POST" action="index.php">
        Tên Sinh Viên: <input type="text" name="ten_sinh_vien" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        <button type="submit">Thêm Sinh Viên</button>
    </form>

    <h2>Danh Sách Sinh Viên (Kiến trúc MVC)</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên Sinh Viên</th>
            <th>Email</th>
            <th>Ngày Tạo</th>
        </tr>

        <?php
        // TODO 4 & 5: Dùng vòng lặp foreach để duyệt qua biến $danh_sach_sv
        if (isset($danh_sach_sv) && is_array($danh_sach_sv)) {
            foreach ($danh_sach_sv as $sv) {
                echo "<tr>";
                // Chú ý dùng htmlspecialchars để bảo mật và tránh lỗi
                echo "<td>" . htmlspecialchars($sv['id']) . "</td>"; // [cite: 100]
                echo "<td>" . htmlspecialchars($sv['ten_sinh_vien']) . "</td>";
                echo "<td>" . htmlspecialchars($sv['email']) . "</td>";
                echo "<td>" . htmlspecialchars($sv['ngay_tao']) . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>