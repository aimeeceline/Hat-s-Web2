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
                
            </div>
           
            
            <h2 style="margin-left: 20px; padding: 10px; background-color: black; color: white;">Thống kê tình hình kinh doanh</h2>
        
            <form method="POST" action="thongke.php">
    <div class="filter">
        <div class="date">
        <label for="start_date">Từ ngày:</label>
    <input type="date" id="start_date" name="start_date">
    <label for="end_date">Đến ngày:</label>
    <input type="date" id="end_date" name="end_date">
    <button type="submit" class="thongke" name="submit">Thống kê</button>
        </div>
        <script>
        // Lấy ngày hôm nay
        const today = new Date();
        // Định dạng ngày theo chuẩn yyyy-mm-dd
        const formattedDate = today.toISOString().split('T')[0];
        // Đặt giá trị cho input
        document.getElementById('start_date').value = formattedDate;
        document.getElementById('end_date').value = formattedDate;
    </script>
    </div>
</form>

            

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Đơn hàng gần đây</h2>
                        <a href="../admin/quanlydonhang.php" class="btn">Xem chi tiết</a>
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
                            <td><!-- Sử dụng JavaScript để gọi hàm khi nhấp vào liên kết -->
                                            <a href="#" onclick="submitForm('<?php echo $row1['id']; ?>')">ĐH <?php echo $row1['id']; ?></a>
                                        </td>
                                <td><?php echo number_format($row1['total'], 0, ',', '.') . 'đ'; ?></td>
                                <td><?php echo $row1['pay']; ?></td>
                                <td>
    <?php
    // Kiểm tra giá trị của trường status và xuất ra chuỗi tương ứng
    if ($row1['status'] == 0) {
        echo "<span class='status return'>Chờ xác nhận</span>";
    } elseif ($row1['status'] == 1) {
        echo "<span class='status inProgress'>Đã xác nhận</span>";
    } elseif ($row1['status'] == 2) {
        echo "<span class='status delivered'>Đã giao</span>";
    } elseif ($row1['status'] == 3) {
        echo "<span class='status pending'>Đã hủy</span>";
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
            <form id="orderForm" action="orderdetails.php" method="post" style="display: none;">
    <!-- Trường input ẩn để chứa ID -->
    <input type="hidden" id="orderIdInput" name="orderId">
</form>

<script>
function submitForm(orderId) {
    // Đặt giá trị ID vào trường input
    document.getElementById('orderIdInput').value = orderId;
    // Submit biểu mẫu
    document.getElementById('orderForm').submit();
}
</script>

            </div>
    </div>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>