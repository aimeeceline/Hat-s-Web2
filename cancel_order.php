<?php
session_start();
include("classfunctionPHPdatabase.php");

$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem dữ liệu POST có tồn tại không và order_id đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    // Nhận order_id từ dữ liệu POST
    $order_id = $_POST['order_id'];

    // Thực hiện truy vấn SQL để cập nhật trạng thái của đơn hàng có order_id tương ứng thành 3
    $sql_update = "UPDATE orders SET status = 3 WHERE id = $order_id";

    if (mysqli_query($conn, $sql_update)) {
        echo "Đã hủy đơn hàng thành công.";
    } else {
        echo "Lỗi khi cập nhật trạng thái đơn hàng: " . mysqli_error($conn);
    }
} else {
    echo "Dữ liệu không hợp lệ hoặc order_id không được cung cấp.";
}
header('Location: historycart.php');
// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
