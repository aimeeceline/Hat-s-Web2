<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $user = $_POST['user'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Khởi tạo mảng để lưu các cặp tên cột và giá trị cần cập nhật
    $update_fields = array();

    // Kiểm tra từng trường liệu có được cập nhật không
    if (!empty($user)) {
        $update_fields[] = "user='$user'";
    }
    if (!empty($name)) {
        $update_fields[] = "name='$name'";
    }
    if (!empty($email)) {
        $update_fields[] = "email='$email'";
    }
    if (!empty($pass)) {
        $update_fields[] = "pass='$pass'";
    }

    // Tạo câu truy vấn UPDATE dựa trên các trường được cập nhật
    $update_query = "UPDATE user SET " . implode(', ', $update_fields) . " WHERE id=$id";

    if ($conn->query($update_query) === TRUE) {
        echo "Cập nhật thông tin thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>
