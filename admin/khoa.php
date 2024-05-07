<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$action = $_POST['action'];
$id = $_POST['id'];

switch ($action) {
    
    case 'lock':
        // Khóa khách hàng
        // Cần thêm mã để khóa khách hàng trong cơ sở dữ liệu
        $sql = "UPDATE user SET locked = 1 WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "User locked successfully";
        } else {
            echo "Error locking user: " . $conn->error;
        }
        break;
    case 'unlock':
        // Mở khách hàng
        // Cần thêm mã để mở khách hàng trong cơ sở dữ liệu
        $sql = "UPDATE user SET locked = 0 WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
echo "User unlocked successfully";
        } else {
            echo "Error unlocking user: " . $conn->error;
        }
        break;
    default:
        echo "Invalid action";
}
// Đóng kết nối
$conn->close();
?>
