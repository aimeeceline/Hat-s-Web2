<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Thực hiện truy vấn tìm kiếm nếu có dữ liệu gửi từ form
if (isset($_POST['search'])) {
    // Thực hiện tìm kiếm từ dữ liệu gửi từ form và lưu vào session
    $search = $_POST['search'];
    $_SESSION['searchData'] = $search;

    $sql = "SELECT * FROM product WHERE pro_name LIKE CONCAT('%', ?, '%') and status=1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
} elseif (isset($_SESSION['searchData'])) {
    // Nếu có dữ liệu tìm kiếm trong session, thực hiện truy vấn từ dữ liệu đó
    $search = $_SESSION['searchData'];
    $sql = "SELECT * FROM product WHERE pro_name LIKE CONCAT('%', ?, '%') and status=1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Nếu không có dữ liệu tìm kiếm, có thể hiển thị tất cả sản phẩm hoặc thông báo không có kết quả
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
        <?php include("page/header.php");
        echo "<h2 id='head'>KẾT QUẢ TÌM KIẾM:</h2>";
        include("page/searchform.php");
        ?>

        <div class="onmain">
            <?php
            $results_per_page = 6;

            if (isset($result)) {
                $total_results = $result->num_rows;
                $total_pages = ceil($total_results / $results_per_page);
            } else {
                $total_pages = 0;
            }

            // Lấy trang hiện tại, mặc định là trang 1
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Tính chỉ số bắt đầu của kết quả trên trang hiện tại
            $start_index = ($current_page - 1) * $results_per_page;

            // Hiển thị kết quả tìm kiếm nếu có
            if (isset($result) && $result->num_rows > 0) {
                $counter = 0;
                while ($row = $result->fetch_assoc()) {
                    $counter++;
                    if ($counter > $start_index && $counter <= ($start_index + $results_per_page)) {
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
        if ($total_pages > 1) {
            // Tạo URL chứa dữ liệu tìm kiếm nếu có
            $searchQuery = isset($_SESSION['searchData']) ? '&search=' . urlencode($_SESSION['searchData']) : '';

            // Hiển thị nút Previous
            if ($current_page > 1) {
                echo '<li><a href="?page=' . ($current_page - 1) . $searchQuery . '">TRC</a></li>';
            }

            // Hiển thị nút phân trang
            for ($i = 1; $i <= $total_pages; $i++) {
                // Kiểm tra xem có phải trang hiện tại không
                $current_class = ($i == $current_page) ? ' class="hientai"' : '';
                echo '<li' . $current_class . '><a href="?page=' . $i . $searchQuery . '">' . $i . '</a></li>';
                            }

            // Hiển thị nút Next
            if ($current_page < $total_pages) {
                echo '<li><a href="?page=' . ($current_page + 1) . $searchQuery . '">SAU</a></li>';
            }
        }
        ?>
    </div>
    <?php include("page/footer.php"); ?>
</body>

</html>
<?php
// Đóng kết nối sau khi sử dụng
$conn->close();
?>
