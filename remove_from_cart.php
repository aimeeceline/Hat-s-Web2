<?php
session_start();

// Function to remove a product from the cart
function removeFromCart($product_id)
{
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Find the index of the product to remove
        $key = array_search($product_id, array_column($_SESSION['cart'], 'product_id'));

        // If the product is found, remove it from the cart
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
            // Reset array keys to prevent gaps in the array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
}

// Process removing a product from the cart if the product ID is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    removeFromCart($product_id);
}

// Redirect back to the cart page
header('Location: cart.php');
exit;
?>