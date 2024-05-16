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
    $sql = "SELECT * FROM user WHERE user=? AND pass=? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >0) {
        // Đăng nhập thành công, lấy thông tin người dùng và xác định vai trò
        $row = $result->fetch_assoc();
        $role = $row['role'];
        $isLocked=$row['locked'];

        // Kiểm tra trạng thái khóa
        if ($isLocked == 1) {
            // Nếu người dùng bị khóa, chuyển hướng về trang đăng nhập với thông báo
            echo "Tài khoản bị khóa vui lòng liên hệ chăm sóc khách hàng   ";
            exit();
        }
        // Lưu thông tin người dùng vào session
        
         {
            header('Location: http://localhost/HAT-s-web2/admin/indexadmin.php');
            exit();
        }
    } else {
        // Đăng nhập không thành công, thông báo lỗi hoặc chuyển hướng về trang đăng nhập với thông báo
        header('Location: signin.php?error=1');
        exit();
    }
}

// Đặt mã HTML sau phần xử lý PHP
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"/>
    <!-- font roboto -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- from login -->
    <div class="login">
      <div class="login__container">
        <h1>Đăng Nhập</h1>
        <form action="signin.php" method="post">

            <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required />
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required />          
         
          <button type="submit" class="login__signInButton">Đăng Nhập</button>
        </form>
        <a href="./signup.html" class="login__registerButton"
        >
      </div>
    </div>
  </body>
  <script src="./js/main.js"></script>
</html>
