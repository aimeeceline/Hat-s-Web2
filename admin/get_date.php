<style>
  .custom-select {
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #fff;
    font-size: 16px;
    border-radius: 10px;
  }
   
  
</style>
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
    WHERE  DATE(order_date) = CURDATE()";
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
}   elseif ($option == "custom") {
    // Xử lý trường hợp khi chọn tùy chọn "Tùy chọn"
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];
    // Thực hiện truy vấn dữ liệu đơn hàng trong khoảng ngày từ fromDate đến toDate
    $sql_order = "SELECT orders.id, orders.id_user, user.user, user.phone, orders.total, orders.order_date, orders.status 
    FROM orders 
    INNER JOIN user ON id_user = user.id 
    WHERE DATE(order_date) BETWEEN '$fromDate' AND '$toDate'";
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
        echo "<td>";
?>
 <form id="orderForm" action="orderdetails.php" method="post" style="display: none;">
    <input type="hidden" id="orderIdInput" name="orderId">
</form>
<select id="statusSelect_<?php echo $order['id']; ?>" class="custom-select" style="background-color: <?php 
   if ($order['status'] == 0) { echo '#ffcccc'; } // Màu do cho đã xử lý
    elseif ($order['status'] == 1) { echo '#c9ffd1'; } // Màu xanh lá cây cho đã xử lý
    elseif ($order['status'] == 2) { echo '#add8e6'; } // Màu xanh nước biển cho đã giao
    elseif ($order['status'] == 3) { echo '#f0f0f0'; } // Màu xám cho đã hủy
    else { echo 'inherit'; } // Mặc định cho các trạng thái khác
?>" onchange="updateStatus(<?php echo $order['id']; ?>, this.value)">
    <option value="0" <?php echo ($order['status'] == 0) ? 'selected' : ''; ?>>Chưa xử lý</option>
    <option value="1" <?php echo ($order['status'] == 1) ? 'selected' : ''; ?>>Đã xử lý</option>
    <option value="2" <?php echo ($order['status'] == 2) ? 'selected' : ''; ?>>Thành công</option>
    <option value="3" <?php echo ($order['status'] == 3) ? 'selected' : ''; ?>>Bị hủy</option>
</select>
<?php
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
}

$conn->close();
?>
