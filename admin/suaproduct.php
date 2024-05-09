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
    $category_name = '';
    switch ($id_category) {
        case 1:
            $upload_directory = "C:/xampp/htdocs/Hat-s-Web2/img/product/Kỹ năng sống - Phát triển cá nhân/";
            break;
        case 2:
            $upload_directory = "C:/xampp/htdocs/Hat-s-Web2/img/product/Manga – Comic/";
            break;
        case 3:
            $upload_directory = "C:/xampp/htdocs/Hat-s-Web2/img/product/Nghệ thuật – Văn hóa/";
            break;
        default:
            echo "ID danh mục không hợp lệ.";
            exit;
    }
    
    // Lấy đường dẫn hình ảnh mới từ các trường input
    $pro_img1 = $_FILES['pro_img1']['name']; // Tên file ảnh 1
    $pro_img2 = $_FILES['pro_img2']['name']; // Tên file ảnh 2
    $pro_img3 = $_FILES['pro_img3']['name']; // Tên file ảnh 3
    // Di chuyển hình ảnh mới vào thư mục lưu trữ (nếu cần)
    move_uploaded_file($_FILES['pro_img1']['tmp_name'], $upload_directory . $pro_img1);
    move_uploaded_file($_FILES['pro_img2']['tmp_name'], $upload_directory . $pro_img2);
    move_uploaded_file($_FILES['pro_img3']['tmp_name'], $upload_directory . $pro_img3);
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
    $update_query = "UPDATE product SET " . implode(', ', $update_fields) . " WHERE pro_id=$pro_id";

    if ($conn->query($update_query) === TRUE) {
        echo "Cập nhật thông tin thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>
