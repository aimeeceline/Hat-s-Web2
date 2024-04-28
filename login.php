<?php
session_start();
ob_start();
include "classfunctionPHPdatabase.php";
include "user.php";
if ((isset($_POST['dangnhap'])) && ($_POST['dangnhap'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $role = checkuser($user, $pass);
    $_SESSION['role'] = $role;
    if ($role == 1) header('location: index.php');
    else {
        $txt_erro = "Tên đăng nhập hoặc mật khẩu không đúng";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/signupsignin.css">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <a href="../html/index.html"><img src="../img/banner/logoo.png" width="130px"></a>
                <h1>Tạo tài khoản</h1>
                
                <input type="text" placeholder="Tên đăng nhập">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Mật khẩu">
                <a href="../html/signupsignin.html"><button onclick="myFunction1()">Đăng ký</button></a>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <a href="../html/index.html"><img src="../img/banner/logoo.png" width="130px"></a>
                <h1>Đăng nhập</h1>
                
                <input type="text" name="user" id="" placeholder="Tên đăng nhập">
                <input type="password" name="pass" id="" placeholder="Mật khẩu">
                <?php
                if (isset($txt_erro) && ($txt_erro != "")) {
                    echo "<font color='red'>" . $txt_erro . "</font>";
                }
                ?>
                <a href="#">Quên mật khẩu?</a>
                <button type="submit" name="dangnhap" class="j">Đăng nhập</button>
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

    <script src="../js/signupsignin.js"></script>

</body>

</html>
