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
//session_destroy();


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
                                <th>SẢN PHẨM</th>
                                <th>GIÁ TIỀN</th>
                                <th>SỐ LƯỢNG</th>
                                <th>THÀNH TIỀN</th>
                                <th>GHI CHÚ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($_SESSION['cart'] as $item) {
                                ?>
                                <tr>

                                    <td class="sanpham">
                                        <a href="chitietsanpham.php?id=<?php echo $item['product_id']; ?>"
                                            style="display: flex; align-items: center;">
                                            <img src="<?php echo $item['product_img']; ?>"
                                                alt="<?php echo $item['product_name']; ?>">
                                            <p style="margin-left: 10px;"><?php echo $item['product_name']; ?></p>
                                        </a>
                                    </td>
                                    <td id="gia"><?php echo number_format($item['product_price'], 0, ',', '.') . 'đ'; ?></td>
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
                                    <td id="thanhtien">
                                        <?php echo number_format($item['product_price'] * $item['quantity'], 0, ',', '.') . 'đ'; ?>
                                    </td>
                                    <script>
                                        function handleQuantityChange(productId, newQuantity) {
                                            updateCart(productId, newQuantity);
                                            location.reload();
                                        }

                                        function updateCart(productId, quantity) {
                                            let formData = new FormData();
                                            formData.append('product_id', productId);
                                            formData.append('quantity', quantity);

                                            let xhr = new XMLHttpRequest();
                                            xhr.open('POST', 'update_cart.php', true);
                                            xhr.onload = function () {
                                                if (xhr.status === 200) {
                                                    console.log('Giỏ hàng đã được cập nhật thành công.');
                                                } else {
                                                    console.error('Lỗi: ' + xhr.statusText);
                                                }
                                            };
                                            xhr.send(formData);
                                        }

                                        function handlePlus(productId) {
                                            let amountElement = document.getElementById('amount_' + productId);
                                            let amount = parseInt(amountElement.value);
                                            amount++;
                                            amountElement.value = amount;
                                            handleQuantityChange(productId, amount);
                                        }

                                        function handleMinus(productId) {
                                            let amountElement = document.getElementById('amount_' + productId);
                                            let amount = parseInt(amountElement.value);
                                            if (amount > 1) {
                                                amount--;
                                                amountElement.value = amount;
                                                handleQuantityChange(productId, amount);
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
</div>
            <?php include ('page/footer.php') ?>
        </div>
</body>

</html>