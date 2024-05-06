<?php
session_start();

if (isset($_POST['productId']) && isset($_POST['checked'])) {
    $productId = $_POST['productId'];
    $checked = $_POST['checked'];
    
    // Lưu trạng thái của checkbox vào session
    $_SESSION['checkbox_state'][$productId] = $checked;
    
    echo 'success'; // Phản hồi về phía client
} else {
    echo 'error';
}
?>