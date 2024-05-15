<?php
session_start();
include ("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}


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
                
            </div>
            <!-- ================ LÀM QUẢN LÝ ĐƠN HÀNG Ở ĐÂY ================= -->
            <div class="order">
                <!-- ================ LÀM BANNER ================= -->
                <div class="banner">
                <select id="month" onchange="LocXuLy()">
    <option value="all">Tất cả</option>
    <option value="notchange">Chưa xử lý</option>
    <option value="change">Đã xử lý</option>
</select>

<script>
function LocXuLy() {
    var selectBox = document.getElementById('month');
    var selectedOption = selectBox.options[selectBox.selectedIndex].value;

    // Gửi request AJAX để lấy dữ liệu tương ứng với tùy chọn đã chọn
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Cập nhật nội dung của tbody trong table với dữ liệu từ phản hồi AJAX
            document.querySelector('.order-table tbody').innerHTML = this.responseText;
        }
    };
    // Sử dụng phương thức GET và truyền tham số 'month'
    xhttp.open("GET", "get_orders.php?month=" + selectedOption, true);
    xhttp.send();
}
</script>
                    <select id="ngaymua" onchange="sDate()">
                    <option value="alltime">Tất cả</option>
                        <option value="today">Hôm nay</option>
                        <option value="yesterday">Hôm qua</option>
                        <option value="last7days">7 ngày trước</option>
                        <option value="last30days">30 ngày trước</option>
                        <option value="custom" onchange="showCustomDate()" >Tùy chọn</option>
                    </select>
                    <script>
                        function sDate() {
    var selectBox = document.getElementById('ngaymua');
    var selectedOption = selectBox.options[selectBox.selectedIndex].value;
    if (selectedOption === 'custom') {
            showCustomDate();
        }
    // Gửi request AJAX để lấy dữ liệu tương ứng với tùy chọn đã chọn
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Cập nhật nội dung của tbody trong table với dữ liệu từ phản hồi AJAX
            document.querySelector('.order-table tbody').innerHTML = this.responseText;
        }
    };
    // Sử dụng phương thức GET và truyền tham số 'month'
    xhttp.open("GET", "get_date.php?ngaymua=" + selectedOption, true);
    xhttp.send();

}
</script>

                    <div id="customDate" style="display: none;">
                        <label for="fromDate">Từ ngày:</label>
                        <input type="date" id="fromDate">
                        <label for="toDate">Đến ngày:</label>
                        <input type="date" id="toDate">
                        <label><input onclick="gui()" type="submit"></label>
                    </div>

                    <script>
    function showCustomDate() {
        const select = document.getElementById('ngaymua');
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


                    
                </div>

                <div class="order-table">
                    <table>
                        <thead>
                            <tr>

                                <td>Mã đơn hàng</td>
                                <td>Người đặt</td>
                                <td>SĐT</td>
                                <td>Thành tiền</td>
                                <td>Thời gian</td>
                                <td>Ghi chú</td>    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_order = "SELECT o.*, p.pro_img1, p.pro_name, p.id_category, u.phone, u.name, u.user
                            FROM `orders` o
                            INNER JOIN `orderdetails` od ON o.id = od.order_id
                            INNER JOIN `product` p ON od.product_id = p.pro_id
                            INNER JOIN `user` u ON o.id_user = u.id
                            GROUP BY o.id
                            ORDER BY o.`id` DESC";
              $result_order = mysqli_query($conn, $sql_order);
                            // Kiểm tra xem có đơn hàng nào không
                            if (mysqli_num_rows($result_order) > 0) {
                                // Nếu có, lặp qua từng đơn hàng và hiển thị thông tin
                                while ($order = mysqli_fetch_assoc($result_order)) {
                                    ?>
                                    <tr>


                                        <td><!-- Sử dụng JavaScript để gọi hàm khi nhấp vào liên kết -->
                                            <a href="#" onclick="submitForm('<?php echo $order['id']; ?>')">ĐH <?php echo $order['id']; ?></a>
                                        </td>

                                        
                                        <td><?php echo $order['id_user']; ?> - <?php echo $order['user']; ?></td>
                                        <td><?php echo $order['phone']; ?></td>
                                        <td><?php echo number_format($order['total'], 0, ',', '.') . 'đ'; ?></td>
                                        <td><?php echo $order['order_date']; ?></td>
                                        <?php if ($order['status'] == 0) : ?>
    <!-- Hiển thị select box cho trạng thái -->
    <td> 
        <select id="statusSelect" onchange="updateStatus(<?php echo $order['id']; ?>, this.value)">
            <option value="0" selected>Chưa xử lý</option>
            <option value="1">Đã xử lý</option>
            <option value="2">Đã giao</option>
            <option value="3">Đã hủy</option>
        </select>
    </td>
<?php elseif ($order['status'] == 1) : ?>
    <td>
        <select id="statusSelect" onchange="updateStatus(<?php echo $order['id']; ?>, this.value)">
            <option value="1" selected>Đã xử lý</option>
            <option value="0" >Chưa xử lý</option>
            <option value="2">Đã giao</option>
            <option value="3">Đã hủy</option>
        </select>
    </td>
<?php elseif ($order['status'] == 2) : ?>
    <td>
        <select id="statusSelect" onchange="updateStatus(<?php echo $order['id']; ?>, this.value)">
            <option value="2" selected>Đã giao</option>
            <option value="0" >Chưa xử lý</option>
            <option value="1">Đã xử lý</option>
            <option value="3">Đã hủy</option>
        </select>
    </td>
<?php elseif ($order['status'] == 3) : ?>
    <td>
        <select id="statusSelect" onchange="updateStatus(<?php echo $order['id']; ?>, this.value)">
            <option value="3" selected>Đã hủy</option>
            <option value="0" >Chưa xử lý</option>
            <option value="1">Đã xử lý</option>
            <option value="2">Đã giao</option>
        </select>
    </td>
<?php endif; ?>

                                        
                                    </tr>
                                    <?php

                                }
                            } else {
                                // Nếu không có đơn hàng nào
                                echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
                            }
                            ?>

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

    function updateStatus(orderId, status) {
        // Gửi yêu cầu cập nhật trạng thái bằng Ajax
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Xử lý phản hồi từ máy chủ
                    var response = xhr.responseText;
                    if (response === 'success') {
                        // Cập nhật thành công, có thể thực hiện các hành động khác nếu cần
                        alert("Đã cập nhật trạng thái đơn hàng thành công.");
                        // Tải lại trang để cập nhật danh sách đơn hàng
                        location.reload();
                    } else {
                        // Cập nhật thất bại, hiển thị thông báo lỗi nếu cần
                        alert("Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.");
                    }
                } else {
                    // Xử lý lỗi khi gửi yêu cầu
                    alert("Có lỗi khi gửi yêu cầu đến máy chủ.");
                }
            }
        };
        // Mở kết nối và gửi yêu cầu đến file xử lý
        xhr.open("POST", "updatestatus.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("orderId=" + orderId + "&status=" + status);
    }
</script>



                        </tbody>
                    </table>
                    
                </div>



                <!-- ================ Add Charts JS ================= -->


            </div>
        </div>
    </div>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>