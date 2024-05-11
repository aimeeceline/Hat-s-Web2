<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}

// Sử dụng câu lệnh chuẩn bị truy vấn để tránh tấn công SQL Injection
$sql = "UPDATE product SET status = 0 WHERE pro_id = ?";
$stmt = mysqli_prepare($conn, $sql);

// Kiểm tra xem câu lệnh chuẩn bị truy vấn có lỗi không
if ($stmt === false) {
    die('Câu lệnh chuẩn bị truy vấn SQL có lỗi: ' . mysqli_error($conn));
}

// Gán giá trị cho tham số truy vấn
$orderId = $_POST['orderId'];
mysqli_stmt_bind_param($stmt, "i", $orderId);

// Thực thi truy vấn SQL
if (mysqli_stmt_execute($stmt)) {
    // Trạng thái đã được cập nhật thành công
    echo "success";
} else {
    // Có lỗi xảy ra khi cập nhật trạng thái
    echo "error";
}

// Đóng câu lệnh chuẩn bị truy vấn
mysqli_stmt_close($stmt);

// Đóng kết nối
mysqli_close($conn);
?>
