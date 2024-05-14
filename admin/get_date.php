<?php
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$option = $_GET['ngaymua'];

$sql_order = "";
if ($option == "today") {
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id 
    WHERE status = 0 AND DATE(order_date) = CURDATE()";
} elseif ($option == "yesterday") {
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id 
    WHERE DATE(order_date) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
} elseif ($option == "last7days") {
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id 
    WHERE order_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND CURDATE()";
} elseif ($option == "last30days") {
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id 
    WHERE order_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 29 DAY) AND CURDATE()";
} elseif ($option == "alltime") {
    // Default query if no option is selected
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id";
}

// Execute the SQL query
$result = mysqli_query($conn, $sql_order);
if (!$result) {
    die("Query execution failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
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
