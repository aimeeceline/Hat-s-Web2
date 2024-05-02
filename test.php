<?php
session_start();
include("classfunctionPHPdatabase.php");

$p = new database();
$conn = $p->connect();
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy thông tin từ trang đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn kiểm tra đăng nhập
    $sql = "SELECT * FROM user WHERE user='$username' AND pass='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $_SESSION['loggedin'] = true; // Thiết lập trạng thái đăng nhập của phiên
        echo "true";
    } else {
        // Đăng nhập thất bại
        echo "false";
    }
}
$conn->close();
?>
