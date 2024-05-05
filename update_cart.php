<?php
session_start();

// Function to update quantity of a product in the cart
function updateCartQuantity($product_id, $quantity)
{
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] = $quantity;
                return; // Exit the function after updating quantity
            }
        }
    }
}

// Process updating product quantity in the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Call the function to update the quantity
    updateCartQuantity($product_id, $quantity);
}
?>