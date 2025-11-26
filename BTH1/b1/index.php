<?php
session_start();

// Lấy role từ session hoặc query string
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;

if (!$user_role && isset($_GET['role'])) {
    $role = strtolower(trim($_GET['role']));
    if (in_array($role, ['guest', 'admin'])) {
        $user_role = $role;
    }
}

if (!$user_role) {
    $user_role = 'guest';
}

// Tích hợp dữ liệu từ file data.php
include 'data.php';  
// File này tạo biến $flowers chứa danh sách hoa
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Tập 01 - Hiển Thị Danh Sách Hoa</title>

    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f4f9; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h1 { text-align: center; }
        h2 { color: #007bff; margin-bottom: 20px; }

        .flowers-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .flower-card { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; background: #fafafa; }
        .flower-image { width: 100%; height: 230px; object-fit: cover; }
        .flower-details { padding: 15px; }
        .flower-details h3 { margin: 0; color: #28a745; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #e9ecef; }
        img.thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>

<body>
<div class="container">

    <h1>BÀI TẬP 01: HIỂN THỊ DANH SÁCH HOA</h1>
    <hr>

    <?php if ($user_role === 'guest'): ?>

        <section>
            <h2>🌺 Danh Sách Hoa (Guest)</h2>

            <div class="flowers-grid">
                <?php foreach ($flowers as $flower): ?>
                    <div class="flower-card">

                        <!-- HIỂN THỊ ẢNH ĐÚNG THEO CÁCH 2 -->
                        <img class="flower-image"
                             src="<?php echo htmlspecialchars($flower['anh']); ?>"
                             alt="<?php echo htmlspecialchars($flower['ten_hoa']); ?>">

                        <div class="flower-details">
                            <h3><?php echo htmlspecialchars($flower['ten_hoa']); ?></h3>
                            <p><?php echo htmlspecialchars($flower['mo_ta']); ?></p>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    <?php elseif ($user_role === 'admin'): ?>

        <section class="admin-view">
            <h2>🔧 Danh Sách Hoa (Admin)</h2>

            <table>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                    <th>Hành Động</th>
                </tr>

                <?php foreach ($flowers as $flower): ?>
                    <tr>
                        <td>
                            <!-- ĐÚNG THEO CÁCH 2 -->
                            <img class="thumb"
                                 src="<?php echo htmlspecialchars($flower['anh']); ?>"
                                 alt="">
                        </td>

                        <td><?php echo htmlspecialchars($flower['ten_hoa']); ?></td>
                        <td><?php echo htmlspecialchars($flower['mo_ta']); ?></td>

                        <td>
                            <a href="#">Sửa</a> |
                            <a href="#" onclick="return confirm('Bạn có chắc muốn xoá?');">Xoá</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </section>

    <?php endif; ?>

</div>
</body>
</html>
