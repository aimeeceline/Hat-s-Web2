<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$proId = $_POST['proId'];

$sql = "UPDATE product SET status = 1 WHERE pro_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die('Câu lệnh chuẩn bị truy vấn SQL có lỗi: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $proId);

if (mysqli_stmt_execute($stmt)) {
    echo "success";
} else {
    echo "error";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
