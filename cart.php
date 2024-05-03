<?php
session_start();

// Function to check if a product already exists in the cart
function productExistsInCart($product_id)
{
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            if ($item['product_id'] == $product_id) {
                return true;
            }
        }
    }
    return false;
}

// Function to add a product to the beginning of the cart
function addToCart($product_id, $product_img, $product_name, $product_price, $quantity)
{
    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product already exists in the cart
    if (productExistsInCart($product_id)) {
        // Update the quantity of the existing product
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] += $quantity;
                break;
            }
        }
    } else {
        // Add the new product to the beginning of the cart
        $item = array(
            'product_id' => $product_id,
            'product_img' => $product_img,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'quantity' => $quantity
        );
        // Move existing items to the end of the cart
        array_unshift($_SESSION['cart'], $item);
    }
}

//session_destroy();
// Process adding a product to the cart if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    // Retrieve product data from the form
    $product_id = $_POST['product_id'];
    $product_img = $_POST['product_img'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    // Add the product to the cart
    addToCart($product_id, $product_img, $product_name, $product_price, $quantity);
}
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
    <div class="container">
        <?php include ('page/header.php') ?>

        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            ?>
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
                            foreach ($_SESSION['cart'] as $item) {
                                ?>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="sanpham">
                                        <a href="chitietsanpham.php?id=<?php echo $item['product_id']; ?>"
                                            style="display: flex; align-items: center;">
                                            <img src="<?php echo $item['product_img']; ?>"
                                                alt="<?php echo $item['product_name']; ?>">
                                            <p style="margin-left: 10px;"><?php echo $item['product_name']; ?></p>
                                        </a>
                                    </td>
                                    <td id="gia"><?php echo $item['product_price']; ?>đ</td>
                                    <td>
                                        <div id="buy-amount">

                                            <!-- Nút giảm số lượng -->
                                            <button class="minus-btn" onclick="handleMinus(<?php echo $item['product_id']; ?>)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                                </svg>
                                            </button>
                                            <!-- Input hiển thị số lượng -->
                                            <input type="text" name="amount" id="amount_<?php echo $item['product_id']; ?>"
                                                class="input-quantity" value="<?php echo $item['quantity']; ?>">

                                            <!-- Nút tăng số lượng -->
                                            <button class="plus-btn" onclick="handlePlus(<?php echo $item['product_id']; ?>)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </button>

                                        </div>
                                    </td>
                                    
                                    <script>
                                        function updateCart(productId, quantity) {
                                            // Tạo một đối tượng FormData để chứa dữ liệu cần gửi
                                            let formData = new FormData();
                                            formData.append('product_id', productId);
                                            formData.append('quantity', quantity);

                                            // Tạo một đối tượng XMLHttpRequest
                                            let xhr = new XMLHttpRequest();

                                            // Thiết lập phương thức và URL endpoint
                                            xhr.open('POST', 'update_cart.php', true);

                                            // Gửi yêu cầu Ajax với dữ liệu từ FormData
                                            xhr.onload = function () {
                                                if (xhr.status === 200) {
                                                    // Nếu yêu cầu thành công, có thể thực hiện các xử lý phản hồi ở đây (nếu cần)
                                                    console.log('Giỏ hàng đã được cập nhật thành công.');
                                                } else {
                                                    // Xử lý lỗi nếu có
                                                    console.error('Lỗi: ' + xhr.statusText);
                                                }
                                            };

                                            // Gửi yêu cầu Ajax với dữ liệu FormData
                                            xhr.send(formData);
                                        }
                                        function handlePlus(productId) {
                                            // Lấy số lượng hiện tại của sản phẩm
                                            let amountElement = document.getElementById('amount_' + productId);
                                            let amount = parseInt(amountElement.value);

                                            // Tăng số lượng
                                            amount++;
                                            amountElement.value = amount;

                                            // Gọi hàm cập nhật giỏ hàng thông qua Ajax
                                            updateCart(productId, amount);
                                        }

                                        function handleMinus(productId) {
                                            // Lấy số lượng hiện tại của sản phẩm
                                            let amountElement = document.getElementById('amount_' + productId);
                                            let amount = parseInt(amountElement.value);

                                            // Giảm số lượng nếu số lượng lớn hơn 1
                                            if (amount > 1) {
                                                amount--;
                                                amountElement.value = amount;
                                                // Gọi hàm cập nhật giỏ hàng thông qua Ajax
                                                updateCart(productId, amount);
                                            }
                                        }
                                        
                                    </script>
                                    <td><a href="remove_from_cart.php?product_id=<?php echo $item['product_id']; ?>">XÓA</a>
                                    </td>
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
            <?php
            // Kiểm tra xem session giỏ hàng có tồn tại và không trống không
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                ?>
                <div class="gogo">
                    <button><a href="payment.php">Tiến hành thanh toán</a></button>
                </div>
                <?php




            }
            ?>

            <?php include ('page/footer.php') ?>
        </div>
</body>

</html>