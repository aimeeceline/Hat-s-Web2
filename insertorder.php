<?php
session_start();
include("classfunctionPHPdatabase.php"); // Đảm bảo bạn đã include file này vào đây
$p = new database();
$conn = $p->connect();


// Kiểm tra nếu phương thức thanh toán đã được gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check'])) {
    // Lấy giá trị phương thức thanh toán từ form
    $payment_method = $_POST['payment_method'];

    // Lưu giá trị phương thức thanh toán vào session
    $_SESSION['selected_payment_method'] = $payment_method;
    
    // Tạo một đơn hàng mới và lưu vào bảng `order`
    $user_id = $_SESSION['id'];
    $total_price = 0;
    // Sử dụng $_SESSION['selected_payment_methods'] thay vì $_SESSION['selected_payment_method']
    $payment_method = $_SESSION['selected_payment_method'];
    // Tính tổng giá trị của giỏ hàng
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['product_price'] * $item['quantity'];
    }

    // Thêm đơn hàng vào bảng `order` chỉ với user_id và tổng giá trị
    $sql_order = "INSERT INTO `orders` (`id_user`, `order_date`, `total`,`pay`) VALUES ('$user_id', NOW(), '$total_price','$payment_method' )";
    if (mysqli_query($conn, $sql_order)) {
        $order_id = mysqli_insert_id($conn); // Lấy ID của đơn hàng vừa tạo

        // Lưu thông tin chi tiết đơn hàng vào bảng `orderdetails`
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $unitprice = $item['product_price'];

            $sql_order_detail = "INSERT INTO `orderdetails` (`order_id`, `product_id`, `quantity`, `unitprice`) VALUES ('$order_id', '$product_id', '$quantity', '$unitprice')";
            mysqli_query($conn, $sql_order_detail);
        }
header("Location: chitietdonhang.php?order_id=$order_id");
        // Xóa giỏ hàng sau khi đã thanh toán
        unset($_SESSION['cart']);

        // Chuyển hướng người dùng đến trang cảm ơn hoặc trang xác nhận đơn hàng
    
        
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>
