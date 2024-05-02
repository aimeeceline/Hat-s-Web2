
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
<style>
    .author-info {
      display: flex;
      align-items: center;
    }

    .author-image {
      width: 350px; /* Điều chỉnh kích thước hình ảnh */
      height: auto;
      margin-left: 150px;
 
    }

    .author-bio {
      flex: 1;
      font-size: 18px;
      max-width: 550px; /* Giới hạn chiều rộng của đoạn văn */
      margin-left: 150px;
    }

    /* Căn giữa hình ảnh và đoạn văn */
    .author-info .author-image,
    .author-info .author-bio {
     align-items: center;
    }
  </style>
<body>
  <div class="container">
    <?php 
      include("page/header.php");
    ?>
     <div class="content">
      <div class="author-info">
        <!-- Hình ảnh tác giả Nguyễn Du -->
        <img src="img/tacgia/namcao.png" alt="Nam Cao" class="author-image">
        <!-- Thông tin về Nam Cao -->
        <div class="author-bio">
          <h2>Nam Cao</h2>
          <p>
           
Nam Cao, tên thật là Trần Hữu Tri (1915-1951), là một trong những nhà văn vĩ đại của văn học Việt Nam. Sinh ra và lớn lên trong một gia đình nông dân ở Nghệ An, cuộc đời và tác phẩm của ông thường phản ánh cuộc sống của những tầng lớp lao động nông thôn và thành thị.

Tác phẩm nổi tiếng nhất của Nam Cao là "Chí Phèo", một bộ truyện ngắn viết về những khổ đau và nỗi đau của con người nghèo, qua nhân vật Chí Phèo và những câu chuyện về cuộc đời, tình yêu, và sự đấu tranh với số phận không công bằng.

Ngoài ra, Nam Cao cũng viết nhiều tác phẩm khác như "Người Lao Động", "Cỏ Dại", "Cánh Đồng Bất Tận", và "Những Ngôi Sao Lấp Lánh". Tác phẩm của ông không chỉ làm nổi bật những nét đẹp, những mâu thuẫn trong xã hội Việt Nam thời đó mà còn chứa đựng thông điệp nhân văn sâu sắc và những tình cảm đậm đà về con người.
          </p>
        </div>
      </div>

      <div class="author-info">
        <!-- Hình ảnh tác giả Tô Hoài -->
        <img src="img/tacgia/tohoai.png" alt="Tô Hoài" class="author-image">
        <!-- Thông tin về Tô Hoài -->
        <div class="author-bio">
          <h2>Tô Hoài</h2>
          <p>
           
Tô Hoài (1920-2014) là một nhà văn nữ nổi tiếng của văn học Việt Nam, được biết đến với những tác phẩm thiếu nhi và truyện ngắn đậm chất hài hước và nhân văn. Bà sinh ra ở Hà Nội, và tác phẩm của bà thường phản ánh cuộc sống hàng ngày của người dân Việt Nam, đặc biệt là trong giai đoạn hậu chiến.

Một trong những tác phẩm nổi tiếng của Tô Hoài là "Vợ Chồng A Phủ", một bộ truyện về cuộc sống của gia đình nông dân A Phủ ở vùng quê Việt Nam. Bằng cách viết hài hước và đầy nhân văn, bà đã tạo ra những nhân vật đời thường sống động, gần gũi với độc giả.

Ngoài ra, Tô Hoài còn có các tác phẩm khác như "Con Chim Xanh Biếc", "Một Dòng Sông Mặt Trời", và "Chú Cuội". Tác phẩm của bà thường được đánh giá cao về khả năng mô tả và sức sáng tạo, cũng như khả năng đánh đồng đội cảm của người đọc.
          </p>
        </div>
      </div>
    </div>



<?php 
      include("page/footer.php");
    ?>
</div>    
<body>



</html>
