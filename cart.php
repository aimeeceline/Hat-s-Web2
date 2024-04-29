<?php
session_start();

// Lấy dữ liệu sản phẩm từ POST request hoặc từ cơ sở dữ liệu
$product_id = $_POST['product_id'];
$product_img = $_POST['product_img'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$quantity = $_POST['quantity'];

// Kiểm tra nếu session giỏ hàng chưa tồn tại, tạo mới nó
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Thêm sản phẩm vào giỏ hàng
$item = array(
    'product_id' => $product_id,
    'product_img' => $product_img,
    'product_name' => $product_name,
    'product_price' => $product_price,
    'quantity' => $quantity
);
array_push($_SESSION['cart'], $item);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>HAT BOOKSTORE</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/cart.css">
</head>


<body>
  <!--------------------------Bắt đầu Header--------------------------------------------------->
  <div class="container">
        <?php 
            include('page/header.php')
            ?>
    <!---------------------------Kết thúc Header--------------------------------------------------->
    <!-----------------------------------PHẦN NỘI DUNG LÀM--------------------------------------------------->
    <div class="wrapper">
      <h1>Giỏ hàng của bạn:</h1>
      <div class="row">
        <table class="table table-bordered" id="table-products">
          <thead>
            <tr>
              <th> </th>
              <th>SẢN PHẨM</th>
              <th>GIÁ TIỀN</th>
              <th>SỐ LƯỢNG</th>
              <th>GHI CHÚ</th>
            </tr>
          </thead>
          <tbody>
    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            ?>
            <tr>
                <td><input type="checkbox"></td>
                <td class="sanpham">
                     <!-- Hiển thị hình ảnh sản phẩm -->
    <img src="<?php echo $item['product_img']; ?>" alt="<?php echo $item['product_name']; ?>">
    <!-- Hiển thị tên sản phẩm -->
    <p><?php echo $item['product_name']; ?></p>
                </td>
                <td id="gia"><?php echo $item['product_price']; ?>đ</td>
                <td>
                    <!-- Hiển thị số lượng sản phẩm -->
                    <div id="buy-amount">
                        <!-- Nút giảm số lượng -->
                        <button class="minus-btn" onclick="handleMinus()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                        </button>
                        <!-- Input hiển thị số lượng -->
                        <input type="text" name="amount" id="amount" value="<?php echo $item['quantity']; ?>">
                        <!-- Nút tăng số lượng -->
                        <button class="plus-btn" onclick="handlePlus()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                </td>
                <!-- Hiển thị nút xóa sản phẩm -->
                <td id="xoa"><a href="remove_from_cart.php?product_id=<?php echo $item['product_id']; ?>">XÓA</a></td>
                
            </tr>
            <?php
        }
    } else {
        // Hiển thị thông báo khi giỏ hàng trống
        echo "<tr><td colspan='5'>Giỏ hàng của bạn trống</td></tr>";
    }
    ?>
</tbody>

        </table>
      </div>
      <div class="gogo">
        <button><a href="../html/thanhtoan.html">Tiến hành thanh toán</a></button>
      </div>
    </div>
    <!-----------------------------------Bắt đầu Footer------------------------------------------->
    <?php
      include('page/footer.php')
    ?>
  </div>
    
</body>
    
</html>