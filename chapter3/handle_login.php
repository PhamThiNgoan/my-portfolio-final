<?php
// Lấy dữ liệu từ form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Tài khoản mẫu
$correct_username = "admin";
$correct_password = "123";

// Kiểm tra
if ($username === $correct_username && $password === $correct_password) {
    echo "<h2>Đăng nhập thành công!</h2>";
    echo "<p>Chào mừng trở lại, $username</p>";
} else {
    // Quay lại trang login kèm thông báo lỗi
    header("Location: login.html?error=1");
    exit();
}
?>
