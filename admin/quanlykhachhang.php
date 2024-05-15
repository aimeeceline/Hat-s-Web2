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
    
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';  
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    // Tiến hành thêm dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO user ( `user`, `email`,  `pass` , `name`,  `address` , `phone` ) VALUES ('$user', '$email',  '$pass', '$name', '$address', '$phone' )";
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
<style>
    button[type="submit"] {
    background-color: black;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

button[type="submit"]:hover {
    background-color: #333;
}
</style>

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
                    <a href="../admin/indexadmin.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Bảng điều khiển</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/quanlydonhang.php">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý đơn hàng</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/quanlysanpham.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý sản phẩm</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/quanlykhachhang.php" id="active">
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
                                <input type="text" name="name" id="name" placeholder="Lê Thị Lan Anh">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" placeholder="lelananh02@gmail.com">
                            </div>
                            <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                                <input type="text" name="address" id="address" placeholder="Quận 5, TPHCM">
                            </div>
                            <div class="form-group">
                            <label for="phone">Sđt:</label>
                                <input type="text" name="phone" id="phone" placeholder="079xxxxxxx">
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
                    
                    <select id="option" onchange="filterUsers()">
    <option value="all">Tất cả</option>
    <option value="active">Hoạt động</option>
    <option value="locked">Bị khóa</option>
</select>
                       <script>
                        function filterUsers() {
    var selectBox = document.getElementById('option');
    var selectedOption = selectBox.options[selectBox.selectedIndex].value;

    // Gửi request AJAX để lấy dữ liệu tương ứng với tùy chọn đã chọn
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.user-table tbody').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "get_users.php?option=" + selectedOption, true);
    xhttp.send();
}
                       </script>
                   
                </div>
                <div class="user-table">
                    <table>
                        <thead>
                            <tr>
                                <td>Tên đăng nhập </td>
                                <td>Họ và tên</td>
                                <td>Email</td>
                                <td>Password</td>
                                <td>Tình trạng</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>

                        <tbody>

                           
                            
                            <?php 
                            // Truy vấn dữ liệu từ cơ sở dữ liệu
                           

                        $sql = "SELECT  * FROM user WHERE id>1";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Duyệt qua từng dòng dữ liệu
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["user"]."</td>";
                                echo "<td>".$row["name"]."</td>";
                                echo "<td>".$row["email"]."</td>";
                                echo "<td>".$row["pass"]."</td>";
                               
                                if ($row["locked"] == 0) {
                                    echo "<td style='color: green;'>Hoạt động</td>";

                                } else {
                                    echo "<td style='color: grey;'>Bị khóa</td>";
                                }
                                
                                echo "</td>";
                                echo "<td>";
                                echo "<button id='suanguoidung' onclick='hienBoxSuaUser(\"".$row['id']."\", \"".$row['user']."\", \"".$row['name']."\", \"".$row['email']."\", \"".$row['address']."\", \"".$row['phone']."\", \"".$row['pass']."\")'>Sửa</button>";

                                if ($row["locked"] == 1) {
                                    // Nếu người dùng đã bị khóa, hiển thị nút "Mở khóa"
                                    echo "<button class='xoanguoidung' onclick='performAction(\"unlock\", \"". $row['id'] ."\")'>Mở khóa</button>";

                                } else {
                                    // Nếu người dùng chưa bị khóa, hiển thị nút "Khóa"
                                    echo "<button class='xoanguoidung' onclick='performAction(\"lock\", \"". $row['id'] ."\")'>Khóa</button>";
                                }
                                
                                echo "</td>";
                                echo "</tr>";
                                
                            }
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>
                <script>
    function performAction(action, id) {
        var confirmMessage = "";
        switch (action) {
            
            case 'lock':
                confirmMessage = "Bạn có chắc muốn KHÓA người dùng này?";
                break;
            case 'unlock':
                confirmMessage = "Bạn có chắc muốn MỞ KHÓA người dùng này?";
                break;
            default:
                confirmMessage = "Are you sure you want to perform this action?";
        }

        if (confirm(confirmMessage)) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xhttp.open("POST", "../admin/khoa.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("action=" + action + "&id=" + id);
        }
    }

</script>



                        </tbody>
                    </table>
                    <div class="overlay"></div>
                    <div class="boxsuauser" id="boxsuauser">
                                    <button onclick="dongFormChinhSua()">X</button>
                                    <script>
                                        function dongFormChinhSua() {
                                            var boxSuaUser = document.getElementById('boxsuauser');
                                            var overlay = document.querySelector('.overlay');

                                            boxSuaUser.style.display = 'none';
                                            document.querySelector('.overlay').classList.remove('show-overlay');
                                            document.body.classList.remove('no-scroll');
                                        }
                                    </script>
                                    
                                <h2 style="margin-bottom: 10px;">Sửa thông tin </h2>
                                <form id="suaUserForm" action="../admin/sua.php" method="post"> <!--Thêm action và method vào form-->
                                <input type="hidden" id="id" name="id"> <!-- Trường ẩn để lưu ID -->

                                <div class="form-group">
                                    <label for="user">Tên đăng nhập:</label>
                                    <input type="text" id="user" name="user">
                                </div>
                                <div class="form-group">
                                    <label for="name">Họ và tên:</label>
                                    <input type="text" id="name" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email"  >
                                </div>
                                <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                                <input type="text" name="address" id="address">
                            </div>
                            <div class="form-group">
                            <label for="phone">Sđt:</label>
                                <input type="text" name="phone" id="phone">
                            </div>
                                <div class="form-group">
                                    <label for="pass">Mật khẩu:</label>
                                    <input type="password" id="pass" name="pass" >
                                </div>
                                <div class="form-group">
                                    <div class="update">
                                       <button type="submit"><i class="fa-solid fa-download"></i>Cập nhật</button> <!--Thay đổi nút "a" thành "button" và thêm type="submit"-->
                                    </div>
                                </div>
                            </form>

                                </div>
                                <script>
                                document.getElementById('suaUserForm').addEventListener('submit', function(event) {
                                    event.preventDefault(); // Ngăn chặn form gửi dữ liệu mặc định
                                    var formData = new FormData(this); // Lấy dữ liệu từ form
                                    fetch('../admin/sua.php', { // Gửi dữ liệu đến sua.php
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Có lỗi xảy ra khi cập nhật thông tin người dùng.');
                                        }
                                        return response.text();
                                    })
                                    .then(data => {
                                        alert(data); 
                                        location.reload();// Hiển thị thông báo từ server
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                                });
                                
                                        </script>
                                <script src="../js/suasanpham.js"></script>
                </div>
        
            
            </div>
        </div>
    </div>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>function hienBoxSuaUser(id, user, name, email,address, phone, pass) {
    var boxSuaUser = document.getElementById('boxsuauser');
    var overlay = document.querySelector('.overlay');
    var form = document.getElementById('suaUserForm');

    // Điền dữ liệu vào form
    form.elements['id'].value = id;
    form.elements['user'].value = user;
    form.elements['name'].value = name;
    form.elements['email'].value = email;
    form.elements['address'].value = address;
    form.elements['phone'].value = phone;
    form.elements['pass'].value = pass;

    // Hiển thị form
    boxSuaUser.style.display = 'block';
    overlay.classList.add('show-overlay');
    document.body.classList.add('no-scroll');
}
 </script>
</body>



</html>