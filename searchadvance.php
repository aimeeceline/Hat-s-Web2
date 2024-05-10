<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Khởi tạo một biến để giữ điều kiện truy vấn
$whereConditions = [];

// Xử lý tìm kiếm theo thể loại
if (isset($_POST['theloai']) && !empty($_POST['theloai'])) {
    $theloai = $_POST['theloai'][0];
    //var_dump($theloai);
    $whereConditions[] = "id_category = ($theloai)";
}

// Xử lý tìm kiếm theo giá bán
if (isset($_POST['giaban']) && !empty($_POST['giaban'])) {
    $giaban = $_POST['giaban'];
    //var_dump($giaban);
    $priceConditions = [];
    foreach ($giaban as $value) {
        switch ($value) {
            case '4':
                $priceConditions[] = "pro_price < 100000";
                break;
            case '5':
                $priceConditions[] = "pro_price >= 100000 AND pro_price <= 500000";
                break;
            case '6':
                $priceConditions[] = "pro_price >= 500000 AND pro_price <= 1000000";
                break;
        }
    }
    $whereConditions[] = "(" . implode(" OR ", $priceConditions) . ")";
}

$sql = "SELECT * FROM product WHERE status=1";
if (!empty($whereConditions)) {
    $sql .= " AND " . implode(" AND ", $whereConditions);
}
//echo $sql;
// Thực thi truy vấn
$result = $conn->query($sql);

// Đóng kết nối sau khi sử dụng
$conn->close();
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
        <?php include("page/header.php");
        include("page/searchform.php");
        ?>
    
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
        </div>
        <!-- Hiển thị nút phân trang -->
        <?php include("page/footer.php"); ?>
    </div>
</body>

</html>
