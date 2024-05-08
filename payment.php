<?php
session_start();
include ("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}

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

// Kiểm tra trạng thái của session và hiển thị thông tin tương ứng
$session_status = session_status();
if ($session_status == PHP_SESSION_DISABLED) {
    echo "Session đã bị vô hiệu hóa trên máy chủ.";
} elseif ($session_status == PHP_SESSION_NONE) {
    echo "Session chưa được khởi tạo.";
} elseif ($session_status == PHP_SESSION_ACTIVE) {
    echo "Session đang hoạt động.";
    // Hiển thị dữ liệu của session ở đây
    print_r($_SESSION);
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
                <?php
                    // Lấy thông tin của người dùng từ CSDL
                    $id = $_SESSION['id']; // Thay đổi userId theo cách bạn lấy thông tin từ session hoặc cách khác
                    $sql = "SELECT * FROM `user` WHERE `id` = $id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    // Điền thông tin vào các trường
                    ?>
                <input type="button" value="Chọn địa chỉ từ tài khoản" id="showAddressBtn" style="margin-bottom: 10px;">
<form method="POST" id="updateForm">
    Họ và tên người nhận
    <input type="text" name="name" value="" placeholder="Nhập họ và tên người nhận" id="name">
    Số điện thoại
    <input type="text" name="phone" value="" placeholder="Ví dụ: 0934686xxx" id="phone">
    Địa chỉ nhận hàng
    <input type="text" name="address" value="" placeholder="Nhập địa chỉ nhận hàng" id="address">
    <button type="button" id="updateButton" style="display: none;">Cập nhật làm địa chỉ mặc định</button>
</form>

<script>
document.getElementById("showAddressBtn").addEventListener("click", function() {
    var nameData = "<?php echo $row['name']; ?>";
    var phoneData = "<?php echo $row['phone']; ?>";
    var addressData = "<?php echo $row['address']; ?>";
    
    // Set the input field value to the user's address
    document.getElementById("name").value = nameData;
    document.getElementById("phone").value = phoneData;
    document.getElementById("address").value = addressData;
    
    // Hide the update button
    document.getElementById("updateButton").style.display = "none";

});

// Function to check if the form data has changed
function checkForChanges() {
    var addressInput = document.getElementById("address");
    var nameInput = document.getElementById("name");
    var phoneInput = document.getElementById("phone");

    var originalAddress = "<?php echo $row['address']; ?>";
    var originalPhone = "<?php echo $row['phone']; ?>";
    var originalName = "<?php echo $row['name']; ?>";
    
    // If the address input value is different from the original address, show the update button
    if (addressInput.value !== originalAddress || nameInput.value !== originalName || phoneInput.value !== originalPhone) {
        document.getElementById("updateButton").style.display = "inline-block";
    } else {
        document.getElementById("updateButton").style.display = "none";
    }
}

// Listen for changes in the address input field
document.getElementById("address").addEventListener("input", checkForChanges);
document.getElementById("name").addEventListener("input", checkForChanges);
document.getElementById("phone").addEventListener("input", checkForChanges);

function updateDefaultAddress() {
    // Thu thập giá trị từ các trường input
    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;
    var address = document.getElementById("address").value;

    // Tạo một đối tượng dữ liệu để gửi lên máy chủ
    var data = {
        name: name,
        phone: phone,
        address: address
    };

    // Gửi yêu cầu AJAX đến máy chủ
    fetch('updateinfo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Cập nhật không thành công');
        }
        return response.json();
    })
    .then(data => {
        // Xử lý phản hồi từ máy chủ nếu cần
        alert('Thông tin người nhận đã được cập nhật thành công!');
    })
    .catch(error => {
        console.error('Có lỗi xảy ra:', error);
    });
}
document.getElementById("updateButton").addEventListener("click", function() {
    // Gọi hàm để thực hiện yêu cầu AJAX
    updateDefaultAddress();
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

?>


<div class="right">
			<h3>PHƯƠNG THỨC THANH TOÁN</h3>
			<form>
				
				<input type="radio" id="age3" name="age" value="100">
				<label for="age3">&nbsp;<img src="img/logo/atm.png">&nbsp;&nbsp;ATM</label><br>
				<input type="radio" id="age4" name="age" value="120">
				<label for="age3">Thanh toán bằng tiền mặt</label><br>

                </form> <!-- Kết thúc form hiện tại -->
<div class="fixed-buttons-container">
    <div class="back-to-cart">
        <a href="index.php">
            <span>
                <img src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/btn_back.svg?q=10354">
            </span>
            <span>Trở về trang chủ</span>
        </a>
    </div>
    <form method="POST" action="insertorder.php">
        <!-- Các trường dữ liệu -->
        <button type="submit" name="check" class="checkout-button">THANH TOÁN NGAY!!!</button>
    </form>
</div>

                    
         

                       
			
			
			
	    <!-----------------------------------Bắt đầu Footer------------------------------------------->
		<?php 
      include("page/footer.php");
    ?>
	  
	  </body>
	  
	  </html>




   