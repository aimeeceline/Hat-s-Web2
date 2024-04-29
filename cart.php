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
  <!--------------------------Bắt đầu Header--------------------------------------------------->
  <div class="container">
        <?php 
            include('page/header.php')
            ?>
    <!---------------------------Kết thúc Header--------------------------------------------------->
    



    <h1>Giỏ hàng của bạn:</h1>
    <p style="color: red; font-size: 200%; text-align: center;">Giỏ hàng trống. <br>Hãy bắt đầu mua sắm ở trang sản phẩm nhé!!!</p>
     <?php
    echo "<br><br><br><br><br>";
    ?>



    <!-----------------------------------Bắt đầu Footer------------------------------------------->
    <?php
      include('page/footer.php')
    ?>
  </div>
    
</body>
    
</html>