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
			<a href="../html/thanhtoan copy.html">
				<p style="font-size: 17px; margin: 20px 0;">Chọn địa chỉ từ tài khoản</p>
			</a>
			<form>
                <?php
                // Lấy thông tin của người dùng từ CSDL
               
                $id = $_SESSION['id']; // Thay đổi userId theo cách bạn lấy thông tin từ session hoặc cách khác
                $sql = "SELECT * FROM `user` WHERE `id` = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                // Điền thông tin vào các trường
                ?>
                Họ và tên người nhận
                <input type="text" name="user" value="<?php echo $row['user']; ?>" placeholder="Nhập họ và tên người nhận">
                Số điện thoại
                <input type="text" name="phone" value="<?php echo $row['phone']; ?>" placeholder="Ví dụ: 0934686xxx">
                Địa chỉ nhận hàng
                <input type="text" name="address" value="<?php echo $row['address']; ?>" placeholder="Nhập địa chỉ nhận hàng">
            </form>
		</div>
		
		
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
                            <td><?php echo $item['product_price']; ?>đ</td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo $item['product_price'] * $item['quantity']; ?>đ</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
				<tfoot>
                    <tr>
                        <td colspan="3"><strong style="float: right;">Tổng giá:</strong></td>
                        <td><?php echo $totalPrice; ?>đ</td>
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
					<div class="checkout-button" onclick="myFunction()">
						<input type="submit" name="" value="THANH TOÁN NGAY!!!" class="checkout-btn">
					</div>
					<script>
						function myFunction() {
							alert("CẢM ƠN BẠN ĐÃ MUA HÀNG !!!");
						}
					</script>
				</div>
			
	    <!-----------------------------------Bắt đầu Footer------------------------------------------->
		<?php 
      include("page/footer.php");
    ?>
	  
	  </body>
	  
	  </html>