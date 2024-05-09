<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem yêu cầu có phải là POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem productId có tồn tại không
    if (isset($_POST['pro_id'])) {
        $pro_id = $_POST['pro_id'];
        
        // Xóa sản phẩm từ cơ sở dữ liệu
        $sql = "DELETE FROM product WHERE pro_id = '$pro_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa sản phẩm thành công";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}
$conn->close();
?>