<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem có dữ liệu POST hoặc GET gửi đến không
if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['order_id'])) {
    // Lấy order_id từ dữ liệu POST hoặc GET
    $order_id = $_REQUEST['order_id'];

    // Thực hiện truy vấn SQL để lấy thông tin chi tiết về đơn hàng
    $sql_order = "SELECT 
        orders.total,
        orders.pay,
        user.name,
        user.phone,
        user.address,
        product.pro_img1,
        product.pro_name,
        product.id_category,
        orderdetails.quantity,
        product.pro_price
    FROM 
        orderdetails
        INNER JOIN orders ON orderdetails.order_id = orders.id
        INNER JOIN product ON orderdetails.product_id = product.pro_id
        INNER JOIN user ON orders.id_user = user.id
    WHERE
        orderdetails.order_id = $order_id";

    $result_order = mysqli_query($conn, $sql_order);

    // Biến flag để đánh dấu thông tin người mua đã được xuất hay chưa
    $info_displayed = false;

    // Sử dụng biến flag để chỉ xuất thông tin người mua một lần
    while ($row = mysqli_fetch_assoc($result_order)) {
        // Nếu thông tin người mua chưa được xuất, xuất thông tin và đặt biến flag thành true
        if (!$info_displayed) {
            $order_info = $row;
            $info_displayed = true;
        }

        $order_details[] = $row;
    }
}
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

    <style>
        /* CSS for Địa chỉ Đơn hàng section */
#address {
    font-size: 18px; /* Adjust the font size as needed */
    font-weight: bold; /* Make the text bold */
    margin-top: 20px; /* Add some top margin */
}

.diachigiaohang {
    border: 1px solid #000; /* Add a border */
    padding: 10px; /* Add some padding */
    margin-top: 10px; /* Add some top margin */
    background-color: none; /* Add a background color */
    width: 1350px;
}

.thongtinnguoimua {
    font-size: 16px; /* Adjust the font size as needed */
}

.thongtinnguoimua p {
    margin: 5px 0; /* Add some margin between paragraphs */
}

    </style>
</head>
<body>
    <div class="container">
        <?php include ('page/header.php'); ?>
        <!-- ======================= Cards ================== -->
        <div class="madh">
            <p id="banner">Mã đơn hàng: <?php echo $order_id; ?></p>   
            <p id="address">ĐỊA CHỈ GIAO HÀNG</p>
            <?php if (isset($order_info)): ?>
            <div class="diachigiaohang">
                <div class="thongtinnguoimua">
                    <p style="font-weight: bold; font-size: large;"> <?php echo $order_info['name']; ?></p>
                    <p><?php echo $order_info['phone']; ?></p>
                    <p><?php echo $order_info['address']; ?></p>
                </div> 
            </div>
            <?php endif; ?>
            <p id="address">THÔNG TIN ĐƠN HÀNG</p>        

            <?php foreach ($order_details as $order): ?>
                <?php
                $category = $order['id_category'];
                $img = $order['pro_img1'];
                // Gọi phương thức để lấy tên loại sản phẩm từ bảng category
                $category_name = $p->getCategoryName($category);

                // Tạo đường dẫn cho ảnh dựa trên loại sản phẩm
                $image_path = 'img/product/' . $category_name . '/' . $order['pro_img1'];
                ?>
                <div class="chitietsanpham">
                    <table>
                        <tbody>
                            <tr>
                                <td><img src="<?php echo $image_path; ?>"></td>
                                <td id="name"><?php echo $order['pro_name']; ?><br> x <?php echo $order['quantity']; ?></td>
                                <td id="price"><?php echo number_format($order['pro_price'], 0, ',', '.') . 'đ'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                
            <?php endforeach; ?>

            <?php if (isset($order_info)): ?>
            <table id="thanhtoan">
                <tbody>
                    <tr>
                        <td>Thành tiền:</td>
                        <td><?php echo number_format($order_info['total'], 0, ',', '.') . 'đ'; ?></td>
                    </tr>

                    <tr>
                        <td>Phương thức thanh toán:</td>
                        <td><?php echo $order_info['pay']; ?></td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td>
    <?php
    // Kiểm tra giá trị của trường status và xuất ra chuỗi tương ứng
    if ($order['status'] == 0) {
        echo "<p style='color: red;'>Chưa xác nhận</p>";
    } elseif ($order['status'] == 1) {
        echo "<p style='color: green;'>Đã xác nhận</p>";
    } elseif ($order['status'] == 2) {
        echo "<p style='color: blue;'>Đã giao</p>";
    } elseif ($order['status'] == 3) {
        echo "<p style='color: grey;'>Đã hủy</p>";
    } else {
        echo "Trạng thái không xác định";
    }
    ?>
</td>

                    </tr>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
    <?php 
      include("page/footer.php");
    ?>
	  </div> 
	  </body>
	  
	  </html>

