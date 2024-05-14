<?php
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem tham số 'status' có tồn tại không
$option = $_GET['month'];

// Xây dựng truy vấn dựa trên tùy chọn được chọn
$sql_order = "";
if ($option == "notchange") {
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id 
    WHERE status = 0";
} elseif ($option == "change") {
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id 
    WHERE status = 1";
} else {
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id";
}

// Thực thi truy vấn và trả về dữ liệu dưới dạng HTML
$result = $conn->query($sql_order);
if ($result->num_rows > 0) {
    while ($order = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><a href=\"#\" onclick=\"submitForm('" . $order['id'] . "')\">ĐH " . $order['id'] . "</a></td>";
        echo "<td>" . $order['id_user'] . " - " . $order['user'] . "</td>";
        echo "<td>" . $order['phone'] . "</td>";
        echo "<td>" . number_format($order['total'], 0, ',', '.') . 'đ' . "</td>";
        echo "<td>" . $order['order_date'] . "</td>";

        if ($order['status'] == 0) {
            echo "<td><button id=\"xoanguoidung\" onclick=\"markProcessed(" . $order['id'] . ")\">Chưa xử lý</button></td>";
        } else {
            echo "<td><p id=\"suanguoidung\">Đã xử lý</p></td>";
        }

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
}

// Đóng kết nối
$conn->close();
?>
