<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem dữ liệu POST orderId và status đã được gửi hay chưa
if(isset($_POST['orderId']) && isset($_POST['status'])) {
    // Nhận dữ liệu orderId và status từ yêu cầu POST
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];

    // Sử dụng câu lệnh chuẩn bị truy vấn để tránh tấn công SQL Injection
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Kiểm tra xem câu lệnh chuẩn bị truy vấn có lỗi không
    if ($stmt === false) {
        die('Câu lệnh chuẩn bị truy vấn SQL có lỗi: ' . mysqli_error($conn));
    }

    // Gán giá trị cho các tham số truy vấn
    mysqli_stmt_bind_param($stmt, "ii", $status, $orderId);

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
} else {
    // Nếu không có dữ liệu POST gửi, trả về một phản hồi lỗi
    echo "error";
}

// Đóng kết nối
mysqli_close($conn);
?>
