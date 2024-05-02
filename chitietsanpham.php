<?php
session_start();
include ("classfunctionPHPdatabase.php");
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

  <title><?php echo $product_name; ?></title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/chitietsanpham.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <div class="container">
    <?php include ("page/header.php"); ?>

    <div class="center">
      <div class="image">
        <div class="big-image">
          <img src="<?php echo $image_path1; ?>" alt="<?php echo $product_name; ?>" id="bigImage">
        </div>
        <div class="small-image">
          <img src="<?php echo $image_path1; ?>" alt="<?php echo $product_name; ?>"
            onclick="changeBigImage('<?php echo $image_path1; ?>')">
          <img src="<?php echo $image_path2; ?>" alt="<?php echo $product_name; ?>"
            onclick="changeBigImage('<?php echo $image_path2; ?>')">
          <img src="<?php echo $image_path3; ?>" alt="<?php echo $product_name; ?>"
            onclick="changeBigImage('<?php echo $image_path3; ?>')">
        </div>
      </div>

      <script>
        function changeBigImage(newImagePath) {
          // Thay đổi đường dẫn của ảnh lớn thành đường dẫn của ảnh nhỏ được click
          document.getElementById('bigImage').src = newImagePath;
        }
      </script>

      <div class="infor">
        <h1 class="name"><?php echo $product_name; ?></h1>
        <div class="price"><?php echo $formatted_price; ?>đ</div>
        <div class="description"><b>Tác giả:</b> <?php echo $author; ?><br><b>Nhà xuất bản:</b>
          <?php echo $publisher; ?>
          <br><br><?php echo $description; ?>
        </div>
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
        <script>
          let amountElement = document.getElementById('amount');
          let amount = amountElement.value;

          let render = (amount) => {
            amountElement.value = amount;
          }

          let handlePlus = () => {
            amount++;
            render(amount);
            // Cập nhật giá trị của trường quantity
            document.querySelector('[name="quantity"]').value = amount;
          }

          let handleMinus = () => {
            if (amount > 1) {
              amount--;
              render(amount);
              // Cập nhật giá trị của trường quantity
              document.querySelector('[name="quantity"]').value = amount;
            }
          }

          amountElement.addEventListener('input', () => {
            amount = amountElement.value;
            amount = parseInt(amount);
            amount = (isNaN(amount) || amount == 0) ? 1 : amount;
            render(amount);
            // Cập nhật giá trị của trường quantity
            document.querySelector('[name="quantity"]').value = amount;
          });
        </script>

        <div class="addtocart">
          <form id="add-to-cart-form" method="post">
            <input type="hidden" name="product_id" value="<?php echo $pro_id; ?>">
            <input type="hidden" name="product_img" value="<?php echo $image_path1; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
            <input type="hidden" name="quantity" value="1" id="amount">
            <button type="submit">Thêm vào giỏ hàng</button>
          </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
          document.getElementById("add-to-cart-form").addEventListener("submit", function (event) {
            event.preventDefault();
            axios.post('cart.php', new FormData(this))
              .then(function (response) {
                console.log('Dữ liệu đã được gửi thành công');

                alert("SẢN PHẨM ĐÃ THÊM THÀNH CÔNG!!!");
                // Load lại trang để cập nhật số lượng sản phẩm trong giỏ hàng và hiển thị cảnh báo
                window.location.reload();
              })
              .catch(function (error) {
                console.error('Lỗi khi gửi dữ liệu: ', error);
              });
          });
        </script>

      </div>
    </div>
    <h2 class="title">SẢN PHẨM KHÁC</h2>
    <div class="onmainindex">
      <?php
      $item_per_page = 4;
      $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
      $p->displayProducts($conn, $item_per_page, $current_page, $p, true); //Hàm này nằm trong classfunctionPHPdatabase.php
      ?>
    </div>
    <?php include ("page/footer.php"); ?>
  </div>
</body>

</html>