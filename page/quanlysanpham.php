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
      include("header.php");
      include("sidebar/sidebar.php");
      include("footer.php");
    ?>
    <?php
     if(isset($_GET['quanly'])){
        $tam= $_GET['quanly'];
     }else{
        $tam='';
     }
     if($tam=='')
    ?>
  </div>
       
</body>

</html>