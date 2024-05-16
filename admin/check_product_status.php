<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$proId = $_POST['proId'];

// Kiểm tra xem sản phẩm có trong bảng ORDERDETAILS không
$sql = "SELECT COUNT(*) FROM orderdetails WHERE product_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die('Câu lệnh chuẩn bị truy vấn SQL có lỗi: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $proId);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $count);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if ($count > 0) {
    echo 'sold';
} else {
    echo 'not_sold';
}

mysqli_close($conn);
?>
