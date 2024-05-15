<?php
session_start();
include ("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}


$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// Xây dựng câu truy vấn SQL
$sql = "SELECT 
            u.id AS user_id,
            u.name AS user_name,
            u.phone,
            o.id AS order_id,
            o.status,
            o.total,
            o.order_date,
            COUNT(o.id) AS total_orders
        FROM 
            user u
        JOIN 
            orders o ON o.id_user = u.id
        WHERE 
            o.order_date BETWEEN '$start_date' AND '$end_date'
        GROUP BY 
            u.id, u.name, u.phone, o.id, o.status, o.total, o.order_date
        ORDER BY 
        u.id, o.total DESC, o.order_date DESC";

// Chuẩn bị câu lệnh
$stmt = $conn->prepare($sql);
$stmt->execute();
$result_order = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ quản trị</title>
    <link rel="stylesheet" href="../css/indexadmin.css">
</head>
<body>
    <!-- Navigation -->
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
                    <a href="../admin/quanlykhachhang.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý khách hàng</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
<<<<<<< HEAD
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
            <h2 style="margin-left: 20px; padding: 10px; background-color: black; color: white;">Thống kê tình hình kinh doanh</h2>
            <form method="POST" action="thongke.php">
                <div class="filter">
                    <div class="flex">
                        <span><input type="radio" name="chon" value="ten" id="ten" onclick="checkTen()" checked>Theo tên sản phẩm</span>
                        <span><input type="radio" name="chon" value="loai" id="loai" onclick="checkLoai()">Theo loại sản phẩm</span>
                        <input type="text" name="tenSp" id="tenSp" placeholder="Tên sản phẩm">
                        <select name="loaiSp" id="loaiSp">
                            <option value="1">Kỹ năng sống - Phát triển bản thân</option>
                            <option value="2">Manga-Comic</option>
                            <option value="3">Nghệ thuật-Văn hóa</option>
                        </select>
                    </div>
                    <div class="date">
                        <label for="start">Từ ngày: </label>
                        <input type="date" id="start" name="start" value="">
                        <label for="end">đến </label>
                        <input type="date" id="end" name="end" value="">
                    </div>
                    <button type="submit" class="thongke">Xem thống kê</button>
                </div>
            </form>
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
                            <th>SL/Đơn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_products = 0;
                        while ($row3 = $result_order->fetch_assoc()) {
                            $total_products += $row3['total_quantity'];
                        ?>
                        <tr>
                            <td>
                                <a href="#" onclick="submitForm('<?php echo $row3['id']; ?>')">ĐH <?php echo $row3['id']; ?></a>
                            </td>
                            <td><?php echo $row3['user']; ?></td>
                            <td><?php echo $row3['phone']; ?></td>
                            <?php if ($row3['status'] == 0) : ?>
                            <td>
                                <p id="premium">Chờ xác nhận</p>
                            </td>
                            <?php else : ?>
                            <td>
                                <p id="basic">Đã giao</p>
                            </td>
                            <?php endif; ?>
                            <td><?php echo number_format($row3['total'], 0, ',', '.') . 'đ'; ?></td>
                            <td><?php echo $row3['order_date']; ?></td>
                            <td><?php echo $row3['total_quantity']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="5" style="background-color: white;"></th>
                            <th>Tổng:</th>
                            <th><?php echo $total_products; ?></th>
                        </tr>
                    </thead>
                </table>
               
            </div>
            <script>
                ten = document.getElementById("ten");
                loai = document.getElementById("loai");
                tenSp = document.getElementById("tenSp");
                loaiSp = document.getElementById("loaiSp");

                function checkTen() {
                    tenSp.style.display = "block";
                    loaiSp.style.display = "none";
                }

                function checkLoai() {
                    tenSp.style.display = "none";
                    loaiSp.style.display = "block";
                }
            </script>
=======
    <div class="topbar">
        <div class="hello">
            <p>CHÀO MỪNG QUẢN TRỊ CỦA HAT !!!</p>
>>>>>>> ad488d5364ac8c45b6f76c292bce11e6d8ef978f
        </div>
    </div>
    <h2 style="margin-left: 20px; padding: 10px; background-color: black; color: white;">Thống kê tình hình kinh doanh</h2>
    <form method="POST" action="thongke.php">
        <div class="filter">
            <label for="start_date">Từ ngày:</label>
            <input type="date" id="start_date" name="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
            <label for="end_date">Đến ngày:</label>
            <input type="date" id="end_date" name="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
            <button type="submit" class="thongke" name="submit">Thống kê</button>
        </div>
    </form>
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
                $total_products = 0; // Khởi tạo biến $total_products
                while ($row3 = $result_order->fetch_assoc()) {
                    $total_products += $row3['total_quantity'];
                ?>
                <tr>
                    <td>
                        <a href="#" onclick="submitForm('<?php echo $row3['order_id']; ?>')">ĐH <?php echo $row3['order_id']; ?></a>
                    </td>
                    <td><?php echo $row3['user_name']; ?></td>
                    <td><?php echo $row3['phone']; ?></td>
                    <?php if ($row3['status'] == 0) : ?>
                    <td>
                        <p id="premium">Chờ xác nhận</p>
                    </td>
                    <?php else : ?>
                    <td>
                        <p id="basic">Đã giao</p>
                    </td>
                    <?php endif; ?>
                    <td><?php echo number_format($row3['total'], 0, ',', '.') . 'đ'; ?></td>
                    <td><?php echo $row3['order_date']; ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
