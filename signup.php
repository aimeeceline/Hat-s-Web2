<?php
session_start();
include("classfunctionPHPdatabase.php");
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
    

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu

    // Tiến hành thêm dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO user ( `user`, `email`,  `pass`) VALUES ('$user', '$email',  '$pass')";

    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng người dùng về trang index hoặc trang khác tùy vào yêu cầu của bạn
        header("Location: http://localhost/HAT-s-web2/signin.php");
        exit(); // Đảm bảo không có mã HTML hoặc mã PHP nào được thực thi sau hàm header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/signupsignin.css">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="signin.php" method="post"> <!-- Thay đổi action thành tên tập lệnh xử lý dữ liệu -->
                <a href="index.html"><img src="img/banner/logoo.png" width="130px"></a>
                <h1>Đăng nhập</h1>
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Username" required />
                
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Password" required />
                
                <a href="#">Quên Mật Khẩu?</a>
                
                <button type="submit">Đăng Nhập</button>

            </form>
        </div>
      
        <div class="form-container sign-in">
            <form action="signup.php" method="post">
            <a href="index.html"><img src="img/banner/logoo.png" width="130px"></a>
            <h1>Tạo tài khoản</h1>
                
                <input type="text" name="user" placeholder="Username" required/>
                <input type="email" name="email" placeholder="Email" required/>
                <input type="password" name="pass" placeholder="Password" required/>
                
                <button type="submit">Đăng kí</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Chào bạn!</h1>
                    <p>Đăng kí tài khoản để mua sắm dễ dàng và hưởng nhiều ưu đãi hơn tại HAT BOOKSTORE</p>
                    <button class="hidden" id="login">Đăng kí</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Đăng nhập để mua sắm dễ dàng và hưởng nhiều ưu đãi hơn tại HAT BOOKSTORE</p>
                    <button class="hidden" id="register">Đăng nhập</button>
                </div>
                
            </div>
        </div>
    </div>

    <script src="js/signupsignin.js"></script>

</body>

</html>
