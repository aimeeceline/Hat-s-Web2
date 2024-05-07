<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu

    // Tiến hành thêm dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO user (`user`, `email`, `pass`, `id`, `name`) VALUES ('$user', '$email',  '$pass', '$id', '$name')";
    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng người dùng về trang index hoặc trang khác tùy vào yêu cầu của bạn
        header("Location: http://localhost/HAT-s-web2/admin/quanlykhachhang.php");
        exit(); // Đảm bảo không có mã HTML hoặc mã PHP nào được thực thi sau hàm header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['lock_user'])) {
    $id = $_POST['lock_user'];
    $sql = "UPDATE user SET is_locked = 1 WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Thực hiện chuyển hướng hoặc các thao tác khác
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_POST['unlock_user'])) {
    $id = $_POST['unlock_user'];
    $sql = "UPDATE user SET is_locked = 0 WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Thực hiện chuyển hướng hoặc các thao tác khác
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>