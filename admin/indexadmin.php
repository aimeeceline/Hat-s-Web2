<?php
session_start();
include ("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
$sql_user = "SELECT  id, user, name, email, pass, locked FROM user WHERE id>1
 ORDER BY id DESC
 LIMIT 5";
                      

$sql_order = "SELECT o.*, p.pro_img1, p.pro_name, p.id_category, u.phone, u.name, u.user
              FROM `orders` o
              INNER JOIN `orderdetails` od ON o.id = od.order_id
              INNER JOIN `product` p ON od.product_id = p.pro_id
              INNER JOIN `user` u ON o.id_user = u.id
              GROUP BY o.id
              ORDER BY o.`id` DESC
              LIMIT 5";
$result_order = mysqli_query($conn, $sql_order);
$result_user = mysqli_query($conn, $sql_user);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ quản trị</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/indexadmin.css">
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
                    <a href="../admin/indexadmin.php" id="active">
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
                    <a href="../admin/quanlykhachhang.php" >
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
                <div class="search" >
                    <label>
                        <input type="text" placeholder="Tìm kiếm chức năng quản trị">
                       <a href="../html/adminnotfound.html"><ion-icon name="search-outline"></ion-icon></a>
                    </label>
                </div>
            </div>
           
            
            <h2 style="margin-left: 20px;">Thống kê tình hình kinh doanh</h2>
        
            <div class="filter">
                <div class="flex">
                <span><input type="radio" name="chon" value="ten" id="ten" onclick="checkTen()" checked>Theo tên sản phẩm</span>
                <span><input type="radio" name="chon" value="loai" id="loai" onclick="checkLoai()">Theo loại sản phẩm</span>
                <input type="text" name="tenSp" id="tenSp" placeholder="Tên sản phẩm">
                <select name="loaiSp" id="loaiSp">
                    <option value="Kỹ năng sống - Phát triển bản thân">Kỹ năng sống - Phát triển bản thân</option>
                    <option value="Manga-Comic">Manga-Comic</option>
                    <option value="Nghệ thuật-Văn hóa">Nghệ thuật-Văn hóa</option>
                </select>
                </div>
                <div class="date">
                    <label for="start">Từ ngày: </label>
                    <input type="date" id="start" name="start" value="2023-11-24" min="2018-01-01" max="2023-12-31">
                    <label for="start">đến </label>
                    <input type="date" id="end" name="end" value="2023-11-30" min="2018-01-01" max="2023-12-31">
                </div>
                <button class="thongke"><a href="../html/thongke.html">Thống kê</a></button>
            </div>

            <div id="reportResult">
                
                <table>
                    <thead>
                        <tr>
                           
                            <th>Mã ĐH</th>
                            <th>Người đặt</th>
                            <th>SĐT</th>
                            <th>Tình trạng</th>
                            <th>Thành tiền</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
            
            while($row3 = $result_order->fetch_assoc()) {
                ?>
                        <tr>
                           
                            <td><a href="../html/chitietdonhang.html"> ĐH <?php echo $row3['id']; ?></a></td>
                            <td><?php echo $row3['user']; ?></td>
                            <td><?php echo $row3['phone']; ?></td>
                            <td id="premium">Chờ xác nhận</td>
                            <td><?php echo $row3['phone']; ?></td>
                            <td>14/10/2023</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <?php
                            }
                        
                            ?>
                    </tbody>

                </table>
                <div class="pagination">
                    <li class="hientai">1</li>
                    <li><a href="trangchuadmin1.html" style="color: black;">2</a></li></a> 
                    <li><a href="trangchuadmin1.html" style="color: black;" >NEXT</a></li>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Đơn hàng gần đây</h2>
                        <a href="../html/quanlydonhang.html" class="btn">Xem chi tiết</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>MÃ ĐƠN HÀNG</td>
                                <td>THÀNH TIỀN</td>
                                <td>PHƯƠNG THỨC</td>
                                <td>TÌNH TRẠNG</td>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
            $result_order->data_seek(0);
            while($row1 = $result_order->fetch_assoc()) {
                ?>
                            <tr>
                                <td><a href="../html/chitietdonhang.html">ĐH <?php echo $row1['id']; ?></a></td>
                                <td><?php echo number_format($row1['total'], 0, ',', '.') . 'đ'; ?></td>
                                <td><?php echo $row1['pay']; ?></td>
                                <td>
    <?php
    // Kiểm tra giá trị của trường status và xuất ra chuỗi tương ứng
    if ($row1['status'] == 0) {
        echo "<span class='status return'>Chờ xác nhận</span>";
    } elseif ($row1['status'] == 1) {
        echo "<span class='status delivered'>Đã giao</span>";
    } else {
        echo "Trạng thái không xác định";
    }
    ?>
</td>
                              
                            </tr>
                            <?php
                            }
                        
                            ?>

                        </tbody>
                    </table>
                </div>
                
                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Người dùng mới đăng ký</h2>
                    </div>

                    <table>
                        <?php
            
                            while($row2 = $result_user->fetch_assoc()) {
                                ?>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../img/banner/avt1.png" alt=""></div>
                            </td>
                            <td>
                                <h4><?php echo $row2['name']; ?><br> <span><?php echo $row2['user']; ?></span></h4>
                            </td>
                        </tr>
<?php
                            }
                        
                            ?>
                        

                    </table>
                </div>
            </div>
        
        

            <script>
            
                    ten = document.getElementById("ten");
                    loai = document.getElementById("loai");
                    tenSp = document.getElementById("tenSp");
                    loaiSp = document.getElementById("loaiSp");
                    function checkTen(){
                        tenSp.style.display="block";
                        loaiSp.style.display="none";
                    }
        
                    function checkLoai(){
                        tenSp.style.display="none";
                        loaiSp.style.display="block";
                    }
                      
            </script>
            </div>
    </div>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>