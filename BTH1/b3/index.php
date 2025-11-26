<?php 
header('Content-Type: text/html; charset=UTF-8');

$data = [];
$filePath = "students.csv";

if (file_exists($filePath) && ($file = fopen($filePath, "r")) !== false) {

    while (($row = fgetcsv($file, 1000, ",")) !== false) {

        // Loại bỏ BOM nếu có
        foreach ($row as &$cell) {
            $cell = preg_replace('/^\xEF\xBB\xBF/', '', $cell);
            $cell = trim($cell); // Xóa khoảng trắng dư
        }

        // Đảm bảo UTF-8
        $data[] = $row;
    }

    fclose($file);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách tài khoản</title>

<style>
    body { font-family: Arial, sans-serif; margin: 40px; background: #f7f9fc; }
    h2 { font-size: 30px; text-align: center; color: #0055cc; }
    table { 
        width: 100%; border-collapse: collapse; background: #fff;
        border-radius: 10px; overflow: hidden; 
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    th { background: #0066ff; color: white; padding: 12px; }
    td { padding: 10px; border-bottom: 1px solid #ddd; }
    tr:hover td { background: #f1f6ff; }
</style>
</head>

<body>

<h2>📄 Danh sách tài khoản </h2>

<?php if (empty($data)) { ?>
    <h3 style="color:red; text-align:center;">⚠ Không có dữ liệu hoặc chưa có file students.csv</h3>
<?php } else { ?>

<table>
    <?php foreach ($data as $i => $row) { ?>
    <tr>
        <?php foreach ($row as $cell) { ?>
            <?php 
                echo ($i == 0) ? "<th>$cell</th>" : "<td>$cell</td>";
            ?>
        <?php } ?>
    </tr>
    <?php } ?>
</table>

<?php } ?>

</body>
</html>
