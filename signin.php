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
        $user= $row['user'];
        $id=$row['id'];
        $isLocked=$row['locked'];

        // Kiểm tra trạng thái khóa
        if ($isLocked == 1) {
            // Nếu người dùng bị khóa, chuyển hướng về trang đăng nhập với thông báo
            echo "Tài khoản bị khóa vui lòng liên hệ chăm sóc khách hàng   ";
            exit();
        }
        // Lưu thông tin người dùng vào session
        $_SESSION['user'] = $user;
        $_SESSION['id'] = $id;
        // Lưu vai trò vào session và chuyển hướng tới trang tương ứng
        if ($role == 0) {
            header('Location: http://localhost/HAT-s-web2/index.php');
            exit();
        } elseif ($role == 1) {
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/signupsignin.css">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="signup.php" method="post"> <!-- Thay đổi action thành tên tập lệnh xử lý dữ liệu -->
                <a href="index.php"><img src="img/banner/logoo.png" width="130px"></a>
                <h1>Tạo tài khoản</h1>
                <input type="text" name="user" placeholder="Tên đăng nhập" required/>
                <input type="email" name="email" placeholder="Email" required/>
                <input type="password" name="pass" placeholder="Password" required/>
                <input type="address" name="address" placeholder="Address" required/>
                <input type="name" name="name" placeholder="Name" required/>
                
                <button  type="submit">Đăng kí</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="signin.php" method="post">
            <a href="index.html"><img src="img/banner/logoo.png" width="130px"></a>
                <h1>Đăng nhập</h1>
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required />
                
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Mật khẩu" required />
                
                <a href="#">Quên Mật Khẩu?</a>
                
                <button type="submit">Đăng Nhập</button>

            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Đăng nhập để mua sắm dễ dàng và hưởng nhiều ưu đãi hơn tại HAT BOOKSTORE</p>
                    <button class="hidden" id="login">Đăng nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Chào bạn!</h1>
                    <p>Đăng kí tài khoản để mua sắm dễ dàng và hưởng nhiều ưu đãi hơn tại HAT BOOKSTORE</p>
                    <button class="hidden" id="register">Đăng kí</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/signupsignin.js"></script>
    
</body>

</html>
