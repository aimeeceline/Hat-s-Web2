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
    // Sản phẩm đã bán, chỉ cập nhật trạng thái
    $updateSql = "UPDATE product SET status = 0 WHERE pro_id = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);
    if ($updateStmt === false) {
        die('Câu lệnh chuẩn bị truy vấn SQL có lỗi: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($updateStmt, "i", $proId);
    if (mysqli_stmt_execute($updateStmt)) {
        echo 'sold_updated';
    } else {
        echo 'error';
    }
    mysqli_stmt_close($updateStmt);
} else {
    // Sản phẩm chưa bán, xóa nó khỏi cơ sở dữ liệu
    $deleteSql = "DELETE FROM product WHERE pro_id = ?";
    $deleteStmt = mysqli_prepare($conn, $deleteSql);
    if ($deleteStmt === false) {
        die('Câu lệnh chuẩn bị truy vấn SQL có lỗi: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($deleteStmt, "i", $proId);
    if (mysqli_stmt_execute($deleteStmt)) {
        echo 'not_sold_deleted';
    } else {
        echo 'error';
    }
    mysqli_stmt_close($deleteStmt);
}

mysqli_close($conn);
?>
