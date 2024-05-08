
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/indexadmin.css">

    <link rel="stylesheet" href="../css/themsanpham.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="logo">
                            <img src="../img/banner/logooadmin.png">
                        </span>
                        <span class="title">HAT BOOKSTORE</span>
                    </a>
                </li>

                <li>
                    <a href="../html/trangchuadmin.html">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Bảng điều khiển</span>
                    </a>
                </li>

                <li>
                    <a href="../html/quanlydonhang.html">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý đơn hàng</span>
                    </a>
                </li>

                <li>
                    <a href="../html/quanlysanpham.html" id="active">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý sản phẩm</span>
                    </a>
                </li>

                <li>
                    <a href="../html/quanlykhachhang.html">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý khách hàng</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="hello">
                    <p>CHÀO MỪNG QUẢN TRỊ CỦA HAT !!!</p>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="Tìm kiếm chức năng quản trị">
                        <a href="../html/adminnotfound.html"><ion-icon name="search-outline"></ion-icon></a>
                    </label>
                </div>
            </div>


            <!-- ================ LÀM QUẢN LÝ SẢN PHẨM Ở ĐÂY ================= -->
            <div class="addproduct">
    <h1>------------------------------ Thêm sản phẩm mới ------------------------------</h1>
    <form id="suaUserForm" action="../admin/addproduct.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="goi">Danh mục:</label>
            <select id="goi" name="id_category">
                <option value="1">Kỹ năng sống - Phát triển cá nhân</option>
                <option value="2">Manga-Comic</option>
                <option value="3">Nghệ thuật-Văn hóa</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image1">Ảnh 1:</label>
            <input type="file" id="image1" name="pro_img1" accept="image/*">
        </div>
        <div class="form-group">
            <label for="image2">Ảnh 2:</label>
            <input type="file" id="image2" name="pro_img2" accept="image/*">
        </div>
        <div class="form-group">
            <label for="image3">Ảnh 3:</label>
            <input type="file" id="image3" name="pro_img3" accept="image/*">
        </div>
        <div class="form-group">
            <label for="name">Mã sản phẩm:</label>
            <input type="text" id="name" name="pro_id" placeholder="KNS49">
        </div>
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="pro_name" placeholder="Đắc Nhân Tâm">
        </div>
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="text" id="price" name="pro_price" placeholder="77.400 đ">
        </div>
        <div class="form-group">
            <label for="author">Tác giả:</label>
            <input type="text" id="author" name="pro_author" placeholder="Dale Carnegie">
        </div>
        <div class="form-group">
            <label for="publisher">Nhà xuất bản:</label>
            <input type="text" id="publisher" name="pro_publisher" placeholder="Văn Học">
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea style="height: 100px;" id="description" name="pro_description" placeholder=""></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Số lượng tồn kho:</label>
            <input type="text" id="quantity" name="pro_quantity" placeholder="1000">
        </div>
        <button type="submit"><i class="fa-solid fa-download"></i>Thêm sản phẩm</button>
    </form>
</div>
        </div>
    </div>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>