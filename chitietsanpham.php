<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();


// Xác định id_category từ URL
$pro_id = isset($_GET['id']) ? $_GET['id'] : null;

// Kiểm tra id_category có hợp lệ không
if (!is_numeric($pro_id)) {
    // Xử lý khi id_category không hợp lệ
    echo "Lỗi: pro_id không hợp lệ!";
    exit;
}

// Tạo câu truy vấn SQL để lấy các sản phẩm thuộc id_category đã chọn
$query = "SELECT * FROM product WHERE pro_id = $pro_id";
$result = mysqli_query($conn, $query);

// Kiểm tra kết quả truy vấn
if ($result) {
    // Lấy dữ liệu từ kết quả truy vấn
    $row = mysqli_fetch_assoc($result);

    // Gán dữ liệu vào các biến PHP
    $product_name = $row['pro_name'];
    $category = $row['id_category'];
    $product_price = $row['pro_price'];
    $author = $row['pro_author'];
    $publisher = $row['pro_publisher'];
    $description = $row['pro_description'];
    $product_image1 = $row['pro_img1'];
    $product_image2 = $row['pro_img2'];
    $product_image3 = $row['pro_img3'];
    // Gọi phương thức để lấy tên loại sản phẩm từ bảng category
    $category_name = $p->getCategoryName($category);
    
    // Tạo đường dẫn cho ảnh dựa trên loại sản phẩm
    $image_path1 = 'img/product/' . $category_name . '/' . $product_image1;
    $image_path2 = 'img/product/' . $category_name . '/' . $product_image2;
    $image_path3 = 'img/product/' . $category_name . '/' . $product_image3;
    $formatted_price = number_format($product_price, 0, ',', '.'); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

  <title><?php echo $pro_name ?></title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/chitietsanpham.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />


</head>

<body>
  <div class="container">
  <?php 
      include("page/header.php");
    ?>

  <div class="center">
    <div class="image">
        <div class="big-image">
            <img src="<?php echo $image_path1; ?>" alt="<?php echo $product_name; ?>">
        </div>
        <div class="small-image">
            <img src="<?php echo $image_path1; ?>" alt="<?php echo $product_name; ?>">
            <img src="<?php echo $image_path2; ?>" alt="<?php echo $product_name; ?>">
            <img src="<?php echo $image_path3; ?>" alt="<?php echo $product_name; ?>">
        </div>
    </div>
    <div class="infor">
        <h1 class="name"><?php echo $product_name; ?></h1>
        <div class="price"><?php echo $formatted_price; ?>đ</div>
        <div class="description"><b>Tác giả:</b> <?php echo $author; ?><br><b>Nhà xuất bản:</b> <?php echo $publisher; ?>
            <br><br><?php echo $description; ?></div>
        <div class="rating">
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9734;</span>
            <span class="nbuy">(205)</span>
        </div>
        <div id="buy-amount">
            <button class="minus-btn" onclick="handleMinus()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                </svg>
            </button>
            <input type="text" name="amount" id="amount" value="1">
            <button class="plus-btn" onclick="handlePlus()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
        </div>
        <div class="addtocart">
            <button onclick="myFunction()">Thêm vào giỏ hàng</button>
        </div>
    </div>
</div>

</body>
