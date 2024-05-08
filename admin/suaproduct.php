<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $pro_id = $_POST['pro_id'];
    $pro_img1 = $_POST['pro_img1'];
    $pro_img2 = $_POST['pro_img2'];
    $pro_img3 = $_POST['pro_img3'];
    $pro_name = $_POST['pro_name'];
    $pro_author = $_POST['pro_author'];
    $pro_publisher = $_POST['pro_publisher'];
    $pro_description = $_POST['pro_description'];
    $pro_quantity = $_POST['pro_quantity'];
    $pro_price = $_POST['pro_price'];
    $id_category = $_POST['id_category'];


    // Khởi tạo mảng để lưu các cặp tên cột và giá trị cần cập nhật
    $update_fields = array();

    // Kiểm tra từng trường liệu có được cập nhật không
    if (!empty($pro_img1)) {
        $update_fields[] = "pro_img1='$pro_img1'";
    }
    if (!empty($pro_img2)) {
        $update_fields[] = "pro_img2='$pro_img2'";
    }
    if (!empty($pro_img3)) {
        $update_fields[] = "pro_img3='$pro_img3'";
    }
    if (!empty($pro_name)) {
        $update_fields[] = "pro_name='$pro_name'";
    }
    if (!empty($pro_author)) {
        $update_fields[] = "pro_author='$pro_author'";
    }
    if (!empty($pro_publisher)) {
        $update_fields[] = "pro_publisher='$pro_publisher'";
    }
    if (!empty($pro_description)) {
        $update_fields[] = "pro_description='$pro_description'";
    }
    if (!empty($pro_quantity)) {
        $update_fields[] = "pro_quantity='$pro_quantity'";
    }
    if (!empty($pro_price)) {
        $update_fields[] = "pro_price='$pro_price'";
    }
    if (!empty($id_category)) {
        $update_fields[] = "id_category='$id_category'";
    }

    // Tạo câu truy vấn UPDATE dựa trên các trường được cập nhật
    $update_query = "UPDATE user SET " . implode(', ', $update_fields) . " WHERE id=$id";

    if ($conn->query($update_query) === TRUE) {
        echo "Cập nhật thông tin thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>
