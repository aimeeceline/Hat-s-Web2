<?php
session_start();
include ("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xác định id_category từ URL
$id_category = isset($_GET['id_category']) ? $_GET['id_category'] : null;

// Kiểm tra id_category có hợp lệ không
if (!is_numeric($id_category)) {
    // Xử lý khi id_category không hợp lệ
    echo "Lỗi: id_category không hợp lệ!";
    exit;
}

// Tính số lượng sản phẩm trên mỗi trang
$item_per_page = 6;

// Tính toán offset (vị trí bắt đầu của mỗi trang)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $item_per_page;

// Tạo câu truy vấn SQL để lấy các sản phẩm thuộc id_category đã chọn và thực hiện truy vấn để lấy kết quả
$query = "SELECT * FROM product WHERE id_category = $id_category LIMIT $item_per_page OFFSET $offset";
$result = mysqli_query($conn, $query);

// Hiển thị các sản phẩm
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

        <?php
        include ("page/header.php");
        ?>
        <?php
        // Xử lý dữ liệu gửi từ form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý tìm kiếm theo tên sản phẩm
            $search_name = $_POST['search_name'];
            $query = "SELECT * FROM product WHERE pro_name LIKE '%$search_name%'";

            // Xử lý tìm kiếm theo thể loại
            $categories = isset($_POST['theloai']) ? $_POST['theloai'] : [];
            if (!empty($categories)) {
                $category_condition = "'" . implode("','", $categories) . "'";
                $query .= " AND id_category IN ($category_condition)";
            } else {
                // Nếu không có thể loại nào được chọn, bạn có thể hiển thị thông báo hoặc xử lý theo cách khác tùy ý của bạn
                echo "Vui lòng chọn ít nhất một thể loại để tìm kiếm.";
                exit; // Dừng xử lý form
            }

            // Xử lý tìm kiếm theo giá bán
            $prices = isset($_POST['giaban']) ? $_POST['giaban'] : [];
            if (!empty($prices)) {
                $price_condition = [];
                foreach ($prices as $price) {
                    switch ($price) {
                        case '1':
                            $price_condition[] = "pro_price < 100000";
                            break;
                        case '2':
                            $price_condition[] = "pro_price >= 100000 AND pro_price <= 500000";
                            break;
                        case '3':
                            $price_condition[] = "pro_price >= 500000 AND pro_price <= 1000000";
                            break;
                    }
                }
                $query .= " AND (" . implode(" OR ", $price_condition) . ")";
            }

            // Thực hiện truy vấn SQL
            $result = mysqli_query($conn, $query);
            if ($result) {
                // Xử lý kết quả trả về từ cơ sở dữ liệu
                // Hiển thị kết quả tìm kiếm
            } else {
                echo "Lỗi truy vấn: " . mysqli_error($conn);
            }
        }

        ?>


        <!-- Form tìm kiếm sản phẩm -->
        <?php
        $category_name = $p->getCategoryName($id_category);

        // In ra tên loại sản phẩm
        echo '<h2 id=head>' . mb_strtoupper($category_name, 'UTF-8') . '</h2>';
        ?>

        <div class="show">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div id="accordion">
                    <div class="cap">Tìm kiếm nâng cao</div>
                    <input type="text" name="search_name" placeholder="Nhập tên sản phẩm cần tìm"
                        style="width: 90%; padding: 10px; border-radius: 8px; margin: 8px;">

                    <!-- Thể loại -->
                    <div class="cap1">Thể loại:</div>
                    <div class="ct">
                        <label><input type="checkbox" name="theloai[]" value="Kỹ năng sống phát triển cá nhân">Kỹ năng
                            sống phát triển cá nhân</label>
                        <label><input type="checkbox" name="theloai[]" value="Manga-Comic">Manga-Comic</label>
                        <label><input type="checkbox" name="theloai[]" value="Nghệ thuật văn hóa">Nghệ thuật văn
                            hóa</label>
                    </div>
                    <!-- Giá bán -->
                    <div class="cap1">Giá bán:</div>
                    <div class="ct">
                        <label><input type="checkbox" name="giaban[]" value="1">&#60 100.000 đ</label>
                        <label><input type="checkbox" name="giaban[]" value="2">100.000 đ - 500.000 đ</label>
                        <label><input type="checkbox" name="giaban[]" value="3">500.000 đ - 1.000.000 đ</label>
                    </div>
                    <!-- Nút Áp dụng -->
                    <button type="submit" class="apply-button">Áp dụng</button>
                </div>
            </form>

            <!-- Hiển thị danh sách sản phẩm -->
            <div class="onmain">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
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
                    echo "Không có sản phẩm nào.";
                }
                ?>
            </div>

        </div>
        <!-- Hiển thị nút phân trang -->
        <div class="pagination">
            <?php
            // Tạo câu truy vấn SQL để đếm tổng số sản phẩm thuộc id_category đã chọn
            $count_query = "SELECT COUNT(*) AS total FROM product WHERE id_category = $id_category";
            $count_result = mysqli_query($conn, $count_query);
            $row = mysqli_fetch_assoc($count_result);
            $total_items = $row['total'];

            // Tính toán số lượng trang
            $total_pages = ceil($total_items / $item_per_page);

            // Hiển thị nút Previous
            if ($current_page > 1) {
                echo '<li><a href="' . $_SERVER['PHP_SELF'] . '?id_category=' . $id_category . '&page=' . ($current_page - 1) . '">TRC</a></li>';
            }

            // Hiển thị nút phân trang
            for ($i = 1; $i <= $total_pages; $i++) {
                // Kiểm tra xem có phải trang hiện tại không
                $current_class = ($i == $current_page) ? ' class="hientai"' : '';
                echo '<li' . $current_class . '><a href="' . $_SERVER['PHP_SELF'] . '?id_category=' . $id_category . '&page=' . $i . '">' . $i . '</a></li>';
            }

            // Hiển thị nút Next
            if ($current_page < $total_pages) {
                echo '<li><a href="' . $_SERVER['PHP_SELF'] . '?id_category=' . $id_category . '&page=' . ($current_page + 1) . '">SAU</a></li>';
            }
            ?>
        </div>

        <?php
        include ("page/footer.php");
        ?>
    </div>

</body>

</html>