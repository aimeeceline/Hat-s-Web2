<?php
session_start();
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pro_name'], $_POST['id_category'], $_POST['pro_price'], $_FILES['pro_img1'], $_FILES['pro_img2'], $_FILES['pro_img3']) &&
        !empty($_POST['pro_name']) && !empty($_POST['id_category']) && !empty($_POST['pro_price'])) {

        $pro_name = $_POST['pro_name'];
        $id_category = $_POST['id_category'];
        $pro_price = $_POST['pro_price'];
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');

        // Xác định thư mục đích dựa trên ID danh mục   
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

        $image_paths = array();
        for ($i = 1; $i <= 3; $i++) {
            $input_name = "pro_img$i";
            if (isset($_FILES[$input_name]) && $_FILES[$input_name]['size'] > 0) {
                $upload_file = $_FILES[$input_name]['name'];
                $file_extension = pathinfo($upload_file, PATHINFO_EXTENSION);

                if (in_array($file_extension, $allowed_types)) {
                    $image_tmp = $_FILES[$input_name]['tmp_name'];
                    
                    // Lấy tên tệp hình ảnh
                    $image_name = basename($upload_file);
                    // Tạo đường dẫn đến thư mục lưu trữ
                    $image_path = $upload_directory . $image_name;

                    if (move_uploaded_file($image_tmp, $image_path)) {
                        $image_paths[] = $image_name; // Lưu trữ chỉ tên tệp, không phải đường dẫn
                    } else {
                        echo "Không thể di chuyển file.";
                        exit;
                    }
                } else {
                    echo "Loại hoặc kích thước của tệp không hợp lệ.";
                    exit;
                }
            } else {
                echo "Vui lòng chọn tệp hình ảnh.";
                exit;
            }
        }

        $stmt = $conn->prepare("INSERT INTO product (`pro_name`, `id_category`, `pro_price`, `pro_img1`, `pro_img2`, `pro_img3`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $pro_name, $id_category, $pro_price, $image_paths[0], $image_paths[1], $image_paths[2]);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Vui lòng điền đầy đủ thông tin sản phẩm.";
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
$conn->close();
?>
