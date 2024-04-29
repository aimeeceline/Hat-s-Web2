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
				Họ và tên người nhận
				<input type="text" name="" placeholder="Nhập họ và tên người nhận">
				Email
				<input type="text" name="" placeholder="Nhập email">
				Số điện thoại
				<input type="text" name="" placeholder="Ví dụ: 0934686xxx">
				Địa chỉ nhận hàng
				<input type="text" name="" placeholder="Nhập địa chỉ nhận hàng">

			</form>
		</div>
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
						<tr>
							<td class="sanpham">
								<img src="../img/product/Nghệ thuật – Văn hóa/hoa sen 1.jpg">
								<p>Từng Bước Nở Hoa Sen</p>
							</td>
							<td id="gia1">100.000 đ</td>
							<td id="num">2</td>
							<td id="xoa">200.000đ</td>
						</tr>
					</tbody>
				</table>
			</div>
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