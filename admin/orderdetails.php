<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem trường orderId có tồn tại trong dữ liệu POST hay không
    if(isset($_POST['orderId'])) {
        // Lấy giá trị của ID đơn hàng từ dữ liệu POST
        $order_id = $_POST['orderId'];
// Thực hiện truy vấn SQL để lấy thông tin chi tiết về đơn hàng
$sql_order = "SELECT 
    orders.total,
    orders.status,
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

// Mảng chứa thông tin chi tiết đơn hàng
$order_details = [];

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/indexadmin.css">
    <link rel="stylesheet" href="../css/chitietdonhang.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <!-- Navigation menu code here -->
            <ul>
                <li>
                    <a href="#">
                        <span class="logo">
                            <img src="../img/banner/logooadmin.png">
                        </span>
                        <span class="title">HAT BOOKSTORE</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/indexadmin.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Bảng điều khiển</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/quanlydonhang.php" id="active">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/quanlysanpham.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/quanlykhachhang.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý khách hàng</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="hello">
                    <p>CHÀO MỪNG QUẢN TRỊ CỦA HAT !!!</p>
                </div>
            
            </div>
            <div class="chitietdonhang">
            <div class="madh">
                <p id="banner">Mã đơn hàng: <?php echo $order_id; ?></p>
                <p id="address">ĐỊA CHỈ GIAO HÀNG</p>
                <?php if (isset($order_info)): ?>
                    <div class="diachigiaohang">
                        <div class="thongtinnguoimua">
                            <p style="font-weight: bold; font-size: large;">Tên: <?php echo $order_info['name']; ?></p>
                            <p>SĐT: <?php echo $order_info['phone']; ?></p>
                            <p>Địa chỉ: <?php echo $order_info['address']; ?></p>
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
                    $image_path = '../img/product/' . $category_name . '/' . $order['pro_img1'];
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
                <td>Trạng thái:</td>
                <td>
                    <?php
                    // Kiểm tra giá trị của trường status và xuất ra chuỗi tương ứng
                    if ($order_info['status'] == 0) {
                        echo "<p style='color: red;'>Chưa xác nhận</p>";
                    } elseif ($order_info['status'] == 1) {
                        echo "<p style='color: green;'>Đã xác nhận</p>";
                    }elseif ($order_info['status'] == 2) {
                        echo "<p style='color: blue;'>Đã giao</p>";
                    }elseif ($order_info['status'] == 3) {
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
        </div>
        </div>
        <script>
    function markProcessed(orderId) {
        // Xác nhận người dùng muốn đánh dấu đã xử lý
        var confirmMsg = confirm("BẠN CÓ CHẮC ĐÃ XỬ LÝ ĐƠN HÀNG NÀY?");
        if (confirmMsg) {
            // Gửi yêu cầu cập nhật trạng thái bằng Ajax
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Xử lý phản hồi từ máy chủ
                        var response = xhr.responseText;
                        if (response === 'success') {
                            // Cập nhật thành công, có thể thực hiện các hành động khác nếu cần
                            alert("Đã cập nhật trạng thái đơn hàng thành công.");
                            // Tải lại trang để cập nhật danh sách đơn hàng
                            location.reload();
                        } else {
                            // Cập nhật thất bại, hiển thị thông báo lỗi nếu cần
                            alert("Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.");
                        }
                    } else {
                        // Xử lý lỗi khi gửi yêu cầu
                        alert("Có lỗi khi gửi yêu cầu đến máy chủ.");
                    }
                }
            };
            // Mở kết nối và gửi yêu cầu đến file xử lý
            xhr.open("POST", "updatestatus.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("orderId=" + orderId);
        }
    }
</script>
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>