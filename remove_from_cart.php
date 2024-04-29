<?php
session_start();

// Kiểm tra xem product_id có được truyền qua URL không
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Kiểm tra xem giỏ hàng có tồn tại không
    if(isset($_SESSION['cart'])) {
        // Tìm vị trí của sản phẩm trong giỏ hàng dựa trên product_id
        $key = array_search($product_id, array_column($_SESSION['cart'], 'product_id'));
        
        // Nếu sản phẩm được tìm thấy trong giỏ hàng
        if ($key !== false) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['cart'][$key]);
        }
    }
}

// Chuyển hướng người dùng trở lại trang giỏ hàng
header('Location: cart.php');
exit;
?>
