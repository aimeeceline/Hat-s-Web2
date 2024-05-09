<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy tên người dùng từ CSDL
$id = $_SESSION['id']; 
$sql_user = "SELECT name FROM `user` WHERE `id` = $id";
$result_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);
$userName = $row_user['name'];

$sql_order = "SELECT o.*, p.pro_img1, p.pro_name, p.id_category, COUNT(*) AS num_products 
              FROM `orders` o
              INNER JOIN `orderdetails` od ON o.id = od.order_id
              INNER JOIN `product` p ON od.product_id = p.pro_id
              WHERE o.`id_user` = $id
              GROUP BY o.id
              ORDER BY o.`id` DESC";
$result_order = mysqli_query($conn, $sql_order);

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
    <link rel="stylesheet" href="css/lichsumuahang.css">

</head>
<body>
    <div class="container">
        <?php include ('page/header.php') ?>
        <h1>Lịch sử mua hàng:</h1>
        <div class="lichsumuahang">
            <div class="content-left">
                <img src="img/banner/user.png">
                <p><?php echo $userName; ?></p>
            </div>
            <table class="order-table">
           
                <?php
                // Kiểm tra xem có đơn hàng nào không
                if (mysqli_num_rows($result_order) > 0) {
                    // Nếu có, lặp qua từng đơn hàng và hiển thị thông tin
                    while ($order = mysqli_fetch_assoc($result_order)) {
                        $category = $order['id_category'];
                        $img = $order['pro_img1'];
                        // Gọi phương thức để lấy tên loại sản phẩm từ bảng category
                        $category_name = $p->getCategoryName($category);

                        // Tạo đường dẫn cho ảnh dựa trên loại sản phẩm
                        $image_path = 'img/product/' . $category_name . '/' . $order['pro_img1'];
                        ?>
                        <tr>
                            <td><?php echo $order['order_date']; ?></td>
                        
                            <td><img src="<?php echo $image_path; ?>"></td>
                            <td>
                                <div class="name">
                                    <?php echo $order['pro_name']; ?><br>
                                    <?php if ($order['num_products']-1 > 0): ?>
    <a style="color: gray; font-size: small;">Còn <?php echo $order['num_products'] - 1; ?> sản phẩm</a>
<?php endif; ?>
                            </td>
                            <td>Thành tiền: <a class="tong"><?php echo number_format($order['total'], 0, ',', '.') . 'đ'; ?></a></td>
                            <td>
    <?php
    // Kiểm tra giá trị của trường status và xuất ra chuỗi tương ứng
    if ($order['status'] == 0) {
        echo "<p style='color: red;'>Chờ xác nhận</p>";
    } elseif ($order['status'] == 1) {
        echo "<p style='color: green;'>Đã giao</p>";
    } else {
        echo "Trạng thái không xác định";
    }
    ?>
</td>
<td>
                           <form action="chitietdonhang.php" method="GET" style="display: inline;">
    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
    <button type="submit" style="color: blue; font-size: small; background: none; border: none; padding: 0; cursor: pointer;">Xem chi tiết</button>
</form>
                           </td>
                           
                        </tr>
                        <?php
                    }
                } else {
                    // Nếu không có đơn hàng nào
                    echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
                }
                ?>
            </table>
        </div>
       
    
      <!-----------------------------------Bắt đầu Footer------------------------------------------->
		<?php 
      include("page/footer.php");
    ?>
	  </div> 
	  </body>
	  
	  </html>

<?php
// Giải phóng kết nối và kết quả truy vấn
mysqli_free_result($result_user);
mysqli_free_result($result_order);
mysqli_close($conn);
?>
