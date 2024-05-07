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

    // Cập nhật dữ liệu vào cơ sở dữ liệu
    $sql = "UPDATE user SET user='$user',name='$name', email='$email', pass='$pass' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thông tin thành công";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>
