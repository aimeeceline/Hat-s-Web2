<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xử lý tìm kiếm từ Ajax
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM product WHERE pro_name LIKE CONCAT('%', ?, '%')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();


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
    <link rel="stylesheet" href="css/pagination.css">
</head>

<body>
    <div class="container">
        <?php include("page/header.php"); ?>

        <h1>Kết quả tìm kiếm</h1>
        <div class="onmain">
            <?php
            // Hiển thị kết quả tìm kiếm nếu có
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['pro_id'];
                    $name = $row['pro_name'];
                    $category = $row['id_category'];
                    $price = $row['pro_price'];
                    $img = $row['pro_img1'];

                    // Gọi phương thức để lấy tên loại sản phẩm từ bảng category
                    $category_name = $p->getCategoryName($category);

                    // Tạo đường dẫn cho ảnh dựa trên loại sản phẩm
                    $image_path = 'img/product/' . $category_name . '/' . $img;
                    $formatted_price = number_format($price, 0, ',', '.');
                    echo '<div class="on2main">
                <div class="main">
                    <a href="chitietsanpham.php?id=' . $id . '">
                        <img src="' . $image_path . '" alt="' . $name . '">
                    </a>
                </div>
                <a href="chitietsanpham.php?id=' . $id . '">
                    <div class="unmain">
                        <p>' . $name . '</p>
                        <p><b>' . $formatted_price . 'đ</b></p>
                    </div>
                </a>
                
            </div>';
                }
            } else {
                echo '0 results found';
            }
            ?>
        </div>
        <!-- Hiển thị nút phân trang -->
        
        <?php include("page/footer.php"); ?>
    </div>
</body>

</html>
