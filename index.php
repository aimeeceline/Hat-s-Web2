<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
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

</head>

<body>
  <div class="container">
    <?php 
      include("page/header.php");
      include("page/slider.php");
    ?>
    <h2 class="title">SẢN PHẨM NỔI BẬT</h2>
   

  </div>

  <div class="onmainindex">
    <?php
    $item_per_page = 12;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    // Thực hiện truy vấn SQL để lấy dữ liệu sản phẩm
    $ketqua = mysqli_query($conn, "SELECT * FROM product WHERE status=1 LIMIT $item_per_page OFFSET $offset");
    if ($ketqua) {
      $total = mysqli_num_rows($ketqua);
      if ($total > 0) {
        while ($row = mysqli_fetch_array($ketqua)) {
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
                  
                      <a href="chitietsanpham.php?id='.$id.'">
                        <img src="'.$image_path.'" alt="'.$name.'">
                      </a>
                    </div>
                    <a href="chitietsanpham.php?id='.$id.'">
                      <div class="unmain">
                        <p>'.$name.'</p>
                        <p><b>'.$formatted_price.'đ</b></p>
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
    ?>
</div>


<?php 
      include("page/footer.php");
    ?>
</div>    
<body>



</html>
