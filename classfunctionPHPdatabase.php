<?php
error_reporting(0);

class database
{
    function connect()
    {
        $con = mysqli_connect("localhost", "root", "", "hatbookstore_dt");
        // Kiểm tra kết nối
        if (!$con) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }
        // Xuất thông báo nếu cần
        // echo "Kết nối thành công";
        return $con;
    }


    public function displayProducts($conn, $item_per_page, $current_page, $p, $random = false)
    {
        $offset = ($current_page - 1) * $item_per_page;
        $query = "SELECT * FROM product WHERE status = 1";
        if ($random) {
            $query .= " ORDER BY RAND()";
        }
        $query .= " LIMIT $item_per_page OFFSET $offset";

        // Thực hiện truy vấn SQL
        $ketqua = mysqli_query($conn, $query);

        if ($ketqua) {
            $total = mysqli_num_rows($ketqua);
            if ($total > 0) {
                while ($row = mysqli_fetch_array($ketqua)) {
                    $id = $row['pro_id'];
                    $name = $row['pro_name'];
                    $category = $row['id_category'];
                    $price = $row['pro_price'];
                    $img = $row['pro_img1'];

                    $category_name = $p->getCategoryName($category);

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
        } else {
            echo "Lỗi truy vấn: " . mysqli_error($conn);
        }
    }


    // Phương thức để lấy tên loại sản phẩm từ id_category
    public function getCategoryName($category_id)
    {
        // Thực hiện truy vấn SQL để lấy tên loại sản phẩm từ cơ sở dữ liệu
        $query = "SELECT name FROM category WHERE id = $category_id";
        $result = mysqli_query($this->connect(), $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['name'];
        } else {
            return "Unknown"; // Trả về "Unknown" nếu không tìm thấy tên loại sản phẩm
        }
    }

}
?>