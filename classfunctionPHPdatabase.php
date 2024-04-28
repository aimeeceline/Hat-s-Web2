<?php
error_reporting(0);

class database 
{
    function connect() 
    {
        $con = mysqli_connect("localhost","root","","hatbookstore_dt");
        // Kiểm tra kết nối
        if (!$con) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        } 
        // Xuất thông báo nếu cần
        // echo "Kết nối thành công";
        return $con;
    }


/*function outputproducts($sql) {
    $p = new database(); // Tạo một đối tượng database mới
    $link = $p->connect(); // Kết nối đến CSDL
    $ketqua = mysqli_query($link, $sql);
    if ($ketqua) {
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            while ($row = mysqli_fetch_array($ketqua)) {
                $id = $row['pro_id'];
                $name = $row['pro_name'];
                $price = $row['pro_price'];
                $img = $row['pro_img1'];
                echo '<div class="on2main">
                        <div class="main">
                            <a href="product.php?id='.$id.'">
                                <img src="public/fontend/images/dummy/products/'.$img.'" alt="'.$name.'">
                            </a>
                        </div>
                        <a href="product.php?id='.$id.'">
                            <div class="unmain">
                                <p>'.$name.'</p>
                                <p><b>$'.$price.'</b></p>
                            </div>
                        </a>
                    </div>';
            }
        } else {
            echo "Không có sản phẩm nào.";
        }
    } else {
        echo "Lỗi truy vấn: " . mysqli_error($link);
    }
}*/
// Phương thức để lấy tên loại sản phẩm từ id_category
public function getCategoryName($category_id) {
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
