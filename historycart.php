<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Truy vấn SQL để lấy thông tin sản phẩm từ bảng oder_detail
$sql = "SELECT product.pro_name, oder_detail.quantity, oder_detail.price
        FROM oder_detail
        INNER JOIN product ON oder_detail.product_id = product.pro_id";
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
                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Hiển thị dữ liệu trong bảng
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['pro_name'] . "</td>";
                             
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
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
// Giải phóng kết nối
mysqli_free_result($result);
mysqli_close($conn);
?>


