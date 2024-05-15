<?php
session_start();
include ("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}
$sql = "SELECT p.*, SUM(o.quantity) AS total_quantity
        FROM orderdetails o
        JOIN product p ON o.product_id = p.pro_id
        WHERE status=1
        GROUP BY o.product_id
        ORDER BY total_quantity DESC
        LIMIT 8";


$result = mysqli_query($conn, $sql);
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
    <?php include ("page/header.php"); ?>

    <!--------------------------Hiển thị sản phẩm--------------------------------------------------->
    <h2 class="title">SẢN PHẨM ĐANG HOT</h2>
    <div class="onmainindex">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
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
        echo 'Không có sản phẩm nào.';
      }
      ?>
    </div>

    <?php include ("page/footer.php"); ?>
  </div>
</body>

</html>

<?php
mysqli_close($conn);
?>
