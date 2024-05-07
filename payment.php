<?php
session_start();
include ("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem session giỏ hàng có tồn tại và không trống không
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Xử lý khi nhấn nút "Cập nhật"
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        // Lấy dữ liệu từ form
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $id = $_SESSION['id'];

        
    // Cập nhật dữ liệu vào CSDL
        $sql_update = "UPDATE `user` SET `name`='$name', `phone`='$phone', `address`='$address' WHERE `id`='$id'";
        if (mysqli_query($conn, $sql_update)) {
            // Cập nhật dữ liệu mặc định
            $row['name'] = $name;
            $row['phone'] = $phone;
            $row['address'] = $address;
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }

    
    ?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thanh toán</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/cart.css">
	<link rel="stylesheet" href="css/payment.css">
</head>

<body>
 <!--------------------------Bắt đầu Header--------------------------------------------------->
 <div class="container">
		<?php 
		include('page/header.php')
		?>
    <!-----------------------------------Kết thúc Header--------------------------------------------------->
		
    <div class="left">
                <h3>ĐỊA CHỈ GIAO HÀNG</h3>
                <input type="submit" name="" value="Chọn địa chỉ từ tài khoản" class="checkout-btn" id="showAddressBtn" style="margin-bottom: 10px;">
                <form method="POST" action="">
                    Họ và tên người nhận
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="Nhập họ và tên người nhận" id="name">
                    Số điện thoại
                    <input type="text" name="phone" value="<?php echo $row['phone']; ?>" placeholder="Ví dụ: 0934686xxx" id="phone">
                    Địa chỉ nhận hàng
                    <input type="text" name="address" value="<?php echo $row['address']; ?>" placeholder="Nhập địa chỉ nhận hàng" id="address">
                    <input type="submit" name="update" value="Cập nhật" class="checkout-btn" onclick="showUpdateSuccess()">
                    <script>
    function showUpdateSuccess() {
        alert("Cập nhật thành công!");
    }
</script>

                </form>
            </div>

           
            <script>
                // Lưu giá trị mặc định của các input vào các biến JavaScript
                var defaultUser = "<?php echo $row['name']; ?>";
                var defaultPhone = "<?php echo $row['phone']; ?>";
                var defaultAddress = "<?php echo $row['address']; ?>";

                // Ẩn các giá trị mặc định khi trang được tải lần đầu
                document.getElementById('name').value = "";
                document.getElementById('phone').value = "";
                document.getElementById('address').value = "";

                document.getElementById('showAddressBtn').addEventListener('click', function() {
                    // Hiển thị giá trị mặc định khi người dùng nhấn nút
                    document.getElementById('name').value = defaultUser;
                    document.getElementById('phone').value = defaultPhone;
                    document.getElementById('address').value = defaultAddress;
                });
            </script>

		
		
    <div class="wrapper1">
        <h3>KIỂM TRA LẠI ĐƠN HÀNG</h3>
        <div class="row">
            <table class="table table-bordered" id="table-products">
                <thead>
                    <tr>
                        <th>SẢN PHẨM</th>
                        <th>GIÁ TIỀN</th>
                        <th>SỐ LƯỢNG</th>
                        <th>TỔNG</th>
                    </tr>
                </thead>
                <tbody>
				<?php
                    // Khởi tạo biến tổng giá
                    $totalPrice = 0;

                    // Duyệt qua từng sản phẩm trong giỏ hàng
                    foreach ($_SESSION['cart'] as $item) {
                        // Tính tổng giá
                        $totalPrice += $item['product_price'] * $item['quantity'];
                        ?>
                        <tr>
                            <td class="sanpham">
                                <img src="<?php echo $item['product_img']; ?>">
                                <p><?php echo $item['product_name']; ?></p>
                            </td>
                            <td><?php echo number_format($item['product_price'], 0, ',', '.') . 'đ'; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo number_format($item['product_price'] * $item['quantity'], 0, ',', '.') . 'đ'; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
				<tfoot>
                    <tr>
                        <td colspan="3"><strong style="float: right;">Tổng giá:</strong></td>
                        <td><?php echo number_format($totalPrice, 0, ',', '.') . 'đ'; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?php
} else {
    // Hiển thị thông báo khi giỏ hàng trống
    echo "<p>Giỏ hàng của bạn trống</p>";
}
?>



<div class="right">
			<h3>PHƯƠNG THỨC THANH TOÁN</h3>
			<form>
				<input type="radio" id="age1" name="age" value="30">
				<label for="age1">&nbsp;<img id="zalopay" src="img/logo/zalo.png">&nbsp;&nbsp;ZALO</label><br>
				<input type="radio" id="age2" name="age" value="60">
				<label for="age2">&nbsp;<img  src="img/logo/momo.png">&nbsp;&nbsp;MOMO</label><br>
				<input type="radio" id="age3" name="age" value="100">
				<label for="age3">&nbsp;<img src="img/logo/atm.png">&nbsp;&nbsp;ATM</label><br>
				<input type="radio" id="age4" name="age" value="120">
				<label for="age3">Thanh toán bằng tiền mặt</label><br>
			</form>
		</div>

			
				<div class="fixed-buttons-container">
					<div class="back-to-cart">
						<a href="index.php">
							<span>
								<img
									src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/btn_back.svg?q=10354">
							</span>
							<span>Trở về trang chủ</span>
						</a>
					</div>

                    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check'])) {
    // Lấy thông tin từ form
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Thêm đơn hàng vào bảng `order`
    $sql_insert_order = "INSERT INTO `oder` (`name`, `phone`, `address`, `total`) VALUES ('$name', '$phone', '$address', '$totalPrice')";
    if (mysqli_query($conn, $sql_insert_order)) {
        // Thành công, thông báo và chuyển hướng về trang chủ
        echo "<script>alert('Đã thanh toán thành công!');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        // Lỗi khi thêm đơn hàng
        echo "Lỗi khi thêm đơn hàng: " . mysqli_error($conn);
    }
}
            ?>
					<div class="checkout-button">
						<input type="submit" name="check" value="THANH TOÁN NGAY!!!">
                        
                       
					</div>
					
				</div>
			
	    <!-----------------------------------Bắt đầu Footer------------------------------------------->
		<?php 
      include("page/footer.php");
    ?>
	  
	  </body>
	  
	  </html>




   