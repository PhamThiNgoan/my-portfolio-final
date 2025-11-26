<?php
session_start();

// Tạm set role = admin
$user_role = 'admin';

// Tích hợp dữ liệu từ file data.php
include 'data.php';   // <--- DÒNG QUAN TRỌNG
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Hoa</title>
</head>
<body>

<?php if ($user_role === 'admin'): ?>

<section class="admin-view">
    <h2>🛠️ Quản Lý Dữ Liệu Hoa (Bảng CRUD)</h2>
    <a href="create.php">+ Thêm Hoa Mới</a>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Hoa</th>
                <th>Mô Tả</th>
                <th>Ảnh</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt = 1; ?>
            <?php foreach ($flowers as $flower): ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $flower['ten_hoa']; ?></td>
                    <td><?php echo substr($flower['mo_ta'], 0, 50) . '...'; ?></td>
                    <td><img src="<?php echo $flower['anh']; ?>" width="80"></td>
                    <td>
                        <a href="edit.php?name=<?php echo urlencode($flower['ten_hoa']); ?>">Sửa</a> |
                        <a href="delete.php?name=<?php echo urlencode($flower['ten_hoa']); ?>"
                           onclick="return confirm('Xóa hoa này?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php endif; ?>

</body>
</html>
