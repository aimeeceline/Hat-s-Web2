
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
    <!--------------------------Hiển thị sản phẩm--------------------------------------------------->
    <h2 class="title">SẢN PHẨM NỔI BẬT</h2>
  <div class="onmainindex">
    <?php
    $item_per_page = 8;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $p->displayProducts($conn, $item_per_page, $current_page, $p, true);//Hàm này nằm trong classfunctionPHPdatabase.php
    ?>
</div>

<?php 
      include("page/footer.php");
    ?>
</div>  

<body>
</html>
