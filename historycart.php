<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử mua hàng</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/history.css">
</head>
<body>
    <div class="container">
        <?php include ('page/header.php') ?>
        <div class="wrapper">
            <h1>Lịch sử mua hàng</h1>
            <?php
            // Kiểm tra xem session giỏ hàng có tồn tại và không trống không
            if (isset($_SESSION['order_history']) && !empty($_SESSION['order_history'])) {
                ?>
                <div class="row">
                    <table class="table table-bordered" id="order-history">
                        <thead>
                            <tr>
                                <th>Ngày đặt hàng</th>
                                <th>Sản phẩm</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($_SESSION['order_history'] as $order) {
                                ?>
                                <tr>
                                    <td><?php echo $order['order_date']; ?></td>
                                    <td><?php echo $order['product_name']; ?></td>
                                    <td><?php echo $order['product_price']; ?>đ</td>
                                    <td><?php echo $order['quantity']; ?></td>
                                    <td><?php echo $order['total']; ?>đ</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
            } else {
                // Hiển thị thông báo khi không có lịch sử mua hàng
                echo "<p>Không có dữ liệu lịch sử mua hàng</p>";
            }
            ?>
        </div>
        <?php include ('page/footer.php') ?>
    </div>
</body>
</html>