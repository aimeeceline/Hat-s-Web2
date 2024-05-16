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
    $whereConditions[] = "id_category = ($theloai)";
}

// Xử lý tìm kiếm theo giá bán
if (isset($_POST['giaban']) && !empty($_POST['giaban'])) {
    $giaban = $_POST['giaban'];
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

// Xử lý tìm kiếm theo tên sản phẩm
if (isset($_POST['productName']) && !empty($_POST['productName'])) {
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $whereConditions[] = "pro_name LIKE '%$productName%'";
}

// Kiểm tra xem người dùng đã nhấn nút "Áp dụng" hay chưa
if (isset($_POST['apply-button'])) {
    // Tạo điều kiện truy vấn từ mảng $whereConditions
    $searchQuery = '';
    if (!empty($whereConditions)) {
        $searchQuery = '?' . http_build_query(array('search' => implode(' AND ', $whereConditions)));
    }

    // Lưu dữ liệu tìm kiếm vào sessionStorage
    $_SESSION['searchData'] = json_encode($whereConditions);
} else {
    // Đây là trường hợp khi người dùng chưa nhấn nút "Áp dụng"
    // Lấy dữ liệu tìm kiếm từ sessionStorage nếu có
    $searchConditions = isset($_SESSION['searchData']) ? json_decode($_SESSION['searchData'], true) : [];
    // Tạo điều kiện truy vấn từ dữ liệu tìm kiếm
    if (!empty($searchConditions)) {
        $whereConditions = $searchConditions;
    }
}

// Thực hiện truy vấn tìm kiếm
$sql = "SELECT * FROM product WHERE status=1";
if (!empty($whereConditions)) {
    $sql .= " AND " . implode(" AND ", $whereConditions);
}
$result = $conn->query($sql);

// Lấy tổng số trang
$total_pages = ($result) ? ceil($result->num_rows / 6) : 0;

// Lấy trang hiện tại, mặc định là trang 1
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính chỉ số bắt đầu của kết quả trên trang hiện tại
$start_index = ($current_page - 1) * 6;

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
        <?php include("page/header.php"); ?>
        <h2 id='head'>KẾT QUẢ TÌM KIẾM:</h2>
        <?php include("page/searchform.php"); ?>

        <div class="onmain">
            <?php
            // Hiển thị kết quả tìm kiếm nếu có
            if (isset($result) && $result->num_rows > 0) {
                $counter = 0;
                while ($row = $result->fetch_assoc()) {
                    $counter++;
                    if ($counter > $start_index && $counter <= ($start_index + 6)) {
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
                }
            } else {
                echo '0 results found';
            }
            ?>
        </div>
    </div>

    <div class="pagination">
        <?php
        // Hiển thị nút Previous
        if ($current_page > 1) {
            echo '<li><a href="?page=' . ($current_page - 1) . '">TRC</a></li>';
        }

        // Hiển thị nút phân trang
        for ($i = 1; $i <= $total_pages; $i++) {
            // Kiểm tra xem có phải trang hiện tại không
            $current_class = ($i == $current_page) ? ' class="hientai"' : '';
            echo '<li' . $current_class . '><a href="?page=' . $i . '">' . $i . '</a></li>';
        }

        // Hiển thị nút Next
        if ($current_page < $total_pages) {
            echo '<li><a href="?page=' . ($current_page + 1) . '">SAU</a></li>';
        }
        ?>
    </div>
    <?php include("page/footer.php"); ?>
</div>
</body>

</html>
