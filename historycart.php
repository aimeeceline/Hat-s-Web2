<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Truy vấn để lấy dữ liệu từ bảng `order` và `orderdetails`
$sql = "SELECT `order`.`id`, `order`.`order_date`, `order`.`total`, `product`.`pro_name` AS product_name, `orderdetails`.`quantity`, `orderdetails`.`unitprice`, `user`.`address`
        FROM `order`
        INNER JOIN `orderdetails` ON `order`.`id` = `orderdetails`.`order_id`
        INNER JOIN `user` ON `order`.`id_user` = `user`.`id`
        INNER JOIN `product` ON `orderdetails`.`product_id` = `product`.`pro_id`";
   

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử mua hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <div class="container">
        <?php include ('page/header.php') ?>
        <div class="wrapper">
            <h1>Lịch sử mua hàng</h1>
           
            <table>
                <thead>
                    <tr>
                        
                        <th>SẢN PHẨM</th>
                        <th>GIÁ TIỀN</th>
                        <th>SỐ LƯỢNG</th>
                        <th>THÀNH TIỀN</th>
                        <th>ĐỊA CHỈ</th>
                        <th>THỜI GIAN ĐẶT HÀNG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Hiển thị dữ liệu từ kết quả truy vấn
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><img src='" . $row['pro_img'] . "' alt='" . $row['product_name'] . "'></td>";
                            
                            echo "<td>" . $row['unitprice'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['total'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['order_date'] . "</td>";
                            
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
        <?php include ('page/footer.php') ?>
    </div>
</body>
</html>

<?php
// Giải phóng kết nối và kết quả truy vấn
mysqli_free_result($result);
mysqli_close($conn);
?>
