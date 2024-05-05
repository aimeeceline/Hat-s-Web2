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
    $sql = "INSERT INTO user ( `user`, `email`,  `pass`, `id` , `name` ) VALUES ('$user', '$email',  '$pass', '$id' , '$name')";
    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng người dùng về trang index hoặc trang khác tùy vào yêu cầu của bạn
        header("Location: http://localhost/HAT-s-web2/admin/quanlykhachhang.php");
        exit(); // Đảm bảo không có mã HTML hoặc mã PHP nào được thực thi sau hàm header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khách hàng</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/indexadmin.css">
    <link rel="stylesheet" href="../css/quanlykhachhang.css">
    <link rel="stylesheet" href="../css/quanlysanpham.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="logo">
                            <img src="../img/banner/logooadmin.png">
                        </span>
                        <span class="title">HAT BOOKSTORE</span>
                    </a>
                </li>

                <li>
                    <a href="../html/trangchuadmin.html">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Bảng điều khiển</span>
                    </a>
                </li>

                <li>
                    <a href="../html/quanlydonhang.html">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý đơn hàng</span>
                    </a>
                </li>

                <li>
                    <a href="../html/quanlysanpham.html">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý sản phẩm</span>
                    </a>
                </li>

                <li>
                    <a href="../html/quanlykhachhang.html" id="active">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý khách hàng</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="hello">
                    <p>CHÀO MỪNG QUẢN TRỊ CỦA HAT !!!</p>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="Tìm kiếm chức năng quản trị">
                        <a href="../html/adminnotfound.html"><ion-icon name="search-outline"></ion-icon></a>
                    </label>
                </div>
            </div>

            <!-- ================ LÀM QUẢN LÝ KHÁCH HÀNG Ở ĐÂY ================= -->
            <div class="user">
                <div class="banner">
                    <button id="adduser">+ Thêm người dùng</button>
                    <div class="boxadduser" id="boxadduser">
                        <h2>Thêm người dùng mới</h2>
                        <form action="quanlykhachhang.php" method="post" id="addUserForm">
                            <div class="form-group">
                                <label for="user">Tên đăng nhập:</label>
                                <input type="text" name="user" id="user" placeholder="aimeeceline00">
                            </div>
                            <div class="form-group">
                                <label for="name">Họ và tên:</label>
                                <input type="name" name="name" id="name" placeholder="Lê Thị Lan Anh">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" placeholder="lelananh02@gmail.com">
                            </div>
                            <div class="form-group">
                                
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu mặc định:</label>
                                <input type="password" name="pass" id="password" value="password">
                            </div>
                            <button type="submit">Thêm</button>
                        </form>
                    </div>

                    <script>

                        const adduserBtn = document.getElementById('adduser');
                        const boxadduser = document.getElementById('boxadduser');
                        const addUserForm = document.getElementById('addUserForm');

                        
                        adduserBtn.addEventListener('click', function () {

                            if (boxadduser.style.display === 'none' || boxadduser.style.display === '') {
                                boxadduser.style.display = 'block';
                                document.querySelector('.overlay').classList.add('show-overlay');
        document.body.classList.add('no-scroll');
        adduserBtn.style.zIndex = '1000';
                            } else {
                                boxadduser.style.display = 'none';
                                document.querySelector('.overlay').classList.remove('show-overlay');
        document.body.classList.remove('no-scroll');
                            }
                        });

                        addUserForm.addEventListener('submit    ', function (event) {
                            event.preventDefault();


                            alert('Đã thêm người dùng');
                            window.location.href = 'http://localhost/HAT-s-web2/admin/quanlykhachhang.php';
                        });
                    </script>

                    <select id="option">
                        <option>Tất cả</option>
                        <option>Bạc</option>
                        <option>Vàng</option>
                        <option>Kim cương</option>
                        <option>Đã khóa</option>
                    </select>
                    <select id="option">
                        <option>Mới nhất</option>
                        <option>Cũ nhất</option>
                    </select>
                   <div>
                    <input id="timnguoidung" type="text" placeholder="Tên người dùng ...">
                    
                        <button type="button" >Tìm</button>
                   </div>
                </div>
                <div class="user-table">
                    <table>
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Tên đăng nhập </td>
                                <td>Họ và tên</td>
                                <td>Email</td>
                                <td>Password</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>thaihien99</td>
                                <td>Trần Thái Hiễn</td>
                                <td>tranthaihien02@gmail.com</td>
                                <td>30012004</td>
                                <td>
                                    <button id="suanguoidung" onclick="hienBoxSuaUser()">Sửa</button>
                                    <button onclick="myFunction()" id="xoanguoidung">Khóa</button>
                                    <script>
                                        function myFunction() {
                                            const confirmation = confirm("Bạn có chắc chắn muốn khóa người dùng này ??? ");
                                            if (confirmation) {
                                                alert("Khóa người dùng thành công!!")
                                                window.location.href = '../html/qlkhlockeduser.html';
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>

                            
                            <?php 
                            // Truy vấn dữ liệu từ cơ sở dữ liệu
                           

                        $sql = "SELECT  id, user, name, email, pass FROM user WHERE id>1";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Duyệt qua từng dòng dữ liệu
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["id"]."</td>";
                                echo "<td>".$row["user"]."</td>";
                                echo "<td>".$row["name"]."</td>";
                                echo "<td>".$row["email"]."</td>";
                                echo "<td>".$row["pass"]."</td>";
                                echo "<td>
                                        <button id='suanguoidung' onclick='hienBoxSuaUser()'>Sửa</button>
                                        <button onclick='myFunction()' id='xoanguoidung'>Khóa</button>
                                        <script>
                                            function myFunction() {
                                                const confirmation = confirm('Bạn có chắc chắn muốn khóa người dùng này?');
                                                if (confirmation) {
                                                    alert('Khóa người dùng thành công!');
                                                    window.location.href = '../html/qlkhlockeduser.html';
                                                }
                                            }
                                        </script>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>




                        </tbody>
                    </table>
                    <div class="overlay"></div>
                                <div class="boxsuauser" id="boxsuauser">
                                    <button onclick="dongFormChinhSua()">X</button>
                                    <script>
                                        function dongFormChinhSua() {
                                            var boxSuaUser = document.getElementById('boxsuauser');
                                            boxSuaUser.style.display = 'none';
                                            document.querySelector('.overlay').classList.remove('show-overlay');
                                            document.body.classList.remove('no-scroll');
                                        }
                                    </script>
                    <h2 style="margin-bottom: 10px;">Sửa thông tin thaihien99</h2>
                                    <form id="suaUserForm">                                      
                                        <div class="form-group">
                                            <label for="username">Tên đăng nhập:</label>
                                            <input type="text" id="username" value="thaihien99">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Họ và tên:</label>
                                            <input type="text" id="name" value="Trần Thái Hiễn">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="text" id="email" value="tranthaihien02@gmail.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="goi">Hạng thành viên:</label>
                                            <select id="goi" name="goi">
                                                <option>Bạc</option>
                                                <option>Vàng</option>
                                                <option>Kim cương</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Mật khẩu:</label>
                                            <input type="password" id="password" value="password">
                                        </div>
                                        <div class="form-group">
                                            <div class="update">
                                                <a onclick="warning()"><i class="fa-solid fa-download"></i>Cập nhật</a>
                                            </div>

                                        </div>

                                    </form>
                                </div>

                                <script src="../js/suasanpham.js"></script>
                </div>
                <div class="pagination">
                    <li class="hientai">1</li>
                    <li><a href="quanlykhachhang1.html" style="color: black;">2</a></li></a> 
                    <li><a href="quanlykhachhang1.html" style="color: black;" >NEXT</a></li>
                </div>
            <!-- ================ Add Charts JS ================= -->
            <div class="chartsBx">
                <h2>THỐNG KÊ LƯỢNG ĐĂNG KÝ NĂM 2023</h2>
                <div class="chart"> <canvas id="chart-2"></canvas> </div>
            </div>
            </div>
        </div>
    </div>
    <!-- ======= Charts JS ====== -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="../js/chartuser.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>