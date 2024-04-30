<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}
// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn để kiểm tra username và password trong cơ sở dữ liệu
    $sql = "SELECT * FROM user WHERE user=? AND pass=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Đăng nhập thành công, lấy thông tin người dùng và xác định vai trò
        $row = $result->fetch_assoc();
        $role = $row['role'];
        $user= $row['user'];
        // Lưu thông tin người dùng` vào session
        $_SESSION['user'] = $user;
        // Lưu vai trò vào session và chuyển hướng tới trang tương ứng
        $_SESSION['role'] = $role;
        if ($role == 0) {
            header('Location: http://localhost/HAT-s-web2/index.php');
            exit();
        } elseif ($role == 1) {
            header('Location: http://localhost/Gr9-Web/admin/admin.php');
            exit();
        }
    } else {
        // Đăng nhập không thành công, thông báo lỗi hoặc chuyển hướng về trang đăng nhập với thông báo
        header('Location: login.php?error=1');
        exit();
    }
} else {
    // Nếu không có dữ liệu đăng nhập được gửi đi, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit();
}

$conn->close();
?>
