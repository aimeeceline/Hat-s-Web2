<?php
session_start();
include ("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}


$sql_order = "SELECT o.*, p.pro_img1, p.pro_name, p.id_category, u.phone, u.name
              FROM `orders` o
              INNER JOIN `orderdetails` od ON o.id = od.order_id
              INNER JOIN `product` p ON od.product_id = p.pro_id
              INNER JOIN `user` u ON o.id_user = u.id
              GROUP BY o.id
              ORDER BY o.`id` DESC";
$result_order = mysqli_query($conn, $sql_order);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/indexadmin.css">
    <link rel="stylesheet" href="../css/quanlydonhang.css">
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
                    <a href="../admin/indexadmin.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Bảng điều khiển</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/quanlydonhang.php" id="active">
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
                    <a href="../admin/quanlykhachhang.php">
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
            <!-- ================ LÀM QUẢN LÝ ĐƠN HÀNG Ở ĐÂY ================= -->
            <div class="order">
                <!-- ================ LÀM BANNER ================= -->
                <div class="banner">
                    <select id="month">
                        <option>Tất cả</option>
                        <option>Chưa xử lý</option>
                        <option>Đã xử lý</option>
                    </select>
                    <select id="chon" onchange="showCustomDate()">
                        <option value="today">Hôm nay</option>
                        <option value="yesterday">Hôm qua</option>
                        <option value="last7days">7 ngày trước</option>
                        <option value="last30days">30 ngày trước</option>
                        <option value="custom">Tùy chọn</option>
                    </select>

                    <div id="customDate" style="display: none;">
                        <label for="fromDate">Từ ngày:</label>
                        <input type="date" id="fromDate">
                        <label for="toDate">Đến ngày:</label>
                        <input type="date" id="toDate">
                        <label><input onclick="gui()" type="submit"></label>
                    </div>

                    <script>
                        function showCustomDate() {
                            const select = document.getElementById('chon');
                            const customDate = document.getElementById('customDate');

                            if (select.value === 'custom') {
                                customDate.style.display = 'block';
                            } else {
                                customDate.style.display = 'none';
                            }
                        }

                        function gui() {
                            const fromDate = document.getElementById('fromDate').value;
                            const toDate = document.getElementById('toDate').value;
                            const customDate = document.getElementById('customDate');

                            if (fromDate !== '' && toDate !== '') {
                                alert(`Đã cập nhật các đơn hàng từ ${fromDate} đến ${toDate}`);
                                customDate.style.display = 'none'; // Ẩn box khi nhấn OK trên alert
                            } else {
                                alert("Vui lòng nhập đầy đủ thông tin ngày");
                            }
                        }
                    </script>

                    <div class="finder">
                        <select id="find">
                            <option>Tìm theo mã đơn hàng</option>
                            <option>Tìm theo SĐT</option>
                            <option>Tìm theo tên người dùng</option>
                        </select>
                        <input id="find" type="text" placeholder="Nhập thông tin cần tìm">
                        <a href="../html/adminnotfound1.html"><button type="button"
                                style="font-size: larger;">Tìm</button>
                        </a>
                    </div>
                </div>

                <div class="order-table">
                    <table>
                        <thead>
                            <tr>
                                
                                <td>Mã đơn hàng</td>
                                <td>Người đặt</td>
                                <td>SĐT</td>
                                <td>Tình trạng</td>
                                <td>Thời gian</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Kiểm tra xem có đơn hàng nào không
                            if (mysqli_num_rows($result_order) > 0) {
                                // Nếu có, lặp qua từng đơn hàng và hiển thị thông tin
                                while ($order = mysqli_fetch_assoc($result_order)) {
                                    ?>
                                    <tr>

                                       
                                        <td><a href="../chitietdonhang.php"> ĐH <?php echo $order['id']; ?></a></td>
                                        <td><?php echo $order['id_user']; ?></td>
                                        <td><?php echo $order['phone']; ?></td>
                                        <td>
                                            <?php
                                            // Kiểm tra giá trị của trường status và xuất ra chuỗi tương ứng
                                            if ($order['status'] == 0) {
                                                echo "<p style='color: red;'>Chờ xác nhận</p>";
                                            } elseif ($order['status'] == 1) {
                                                echo "<p style='color: green;'>Đã giao</p>";
                                            } else {
                                                echo "Trạng thái không xác định";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $order['order_date']; ?></td>
                                        <td>
                                            <button id="xoanguoidung">Chưa xử lý</button>
                                        </td>
                                    </tr>
                                    <?php

                                }
                            } else {
                                // Nếu không có đơn hàng nào
                                echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
                            }
                            ?>





                        </tbody>
                    </table>
                    <div class="pagination">
                        <li class="hientai">1</li>
                        <li><a href="quanlydonhang1.html" style="color: black;">2</a></li></a>
                        <li><a href="quanlydonhang1.html" style="color: black;">NEXT</a></li>
                    </div>
                </div>



                <!-- ================ Add Charts JS ================= -->


            </div>
        </div>
    </div>
    <!-- ======= Charts JS ====== -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="../js/chartdonhang.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>