<?php
session_start();
include("../classfunctionPHPdatabase.php");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/indexadmin.css">
    <link rel="stylesheet" href="../css/quanlysanpham.css">
    <link rel="stylesheet" href="../css/quanlykhachhang.css">

</head>

<body>
    <div class="container">
        <!-- =============== Navigation ================ -->
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
                    <a href="../admin/indexadmin.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Bảng điều khiển</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/quanlydonhang.php">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý đơn hàng</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/quanlysanpham.php" id="active">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý sản phẩm</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/quanlykhachhang.php" >
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
            <div class="user">
                <div class="banner">
                    <button id="adduser"><a href="../admin/themsanpham.php">+ Thêm sản phẩm</a></button>
                    <div class="finder">
                        <select id="searchType" name="searchType" onchange="changeContent()">
                            <option value="category">Lọc theo DM</option>
                            <option value="publisher">Lọc theo NXB</option>
                        </select>
                        <select id="contentBox">
                            <option value="KNS-PTCN">Kỹ năng sống - Phát triển cá nhân</option>
                            <option value="MG-CM">Manga-Comic</option>
                            <option value="NT-VH">Nghệ thuật-Văn hóa</option>
                        </select>
                    </div>
                    <script>
                        function changeContent() {
                            const selectedValue = document.getElementById('searchType').value;
                            const contentBox = document.getElementById('contentBox');

                            if (selectedValue === 'category') {
                                contentBox.innerHTML = `
                                    <option value="KNS-PTCN">Kỹ năng sống-Phát triển cá nhân</option>
                                    <option value="MG-CM">Manga-Comic</option>
                                    <option value="NT-VH">Nghệ thuật-Văn hóa</option>
                                `;
                            } else if (selectedValue === 'publisher') {
                                contentBox.innerHTML = `
                                    <option value="Publisher1">Nhà xuất bản Kim Đồng</option>
                                    <option value="Publisher2">Nhà xuất bản Lao Động</option>
                                    <option value="Publisher3">Nhà xuất bản Trẻ</option>
                                `;
                            } else {
                                contentBox.innerHTML = '';
                            }
                        }
                    </script>
                    <div><input id="timnguoidung" type="text" placeholder="Tên sản phẩm cần tìm">
                    <button type="button" >Tìm</button></div>
                </div>
               
                <div class="user-table">
                    <table>
                        <thead>
                            <tr>
                                <td>Mã SP</td>
                                <td>Ảnh</td>
                                <td>Tên SP </td>
                                <td>Danh mục</td>
                                <td>Giá</td>
                                <td>Tồn kho</td>
                                <td>Thao tác</td>
                            </tr>
                        </thead>
                        <!-- ================ bảng sửa sản phẩm  ================= -->
                        <tbody>
                        <?php 
                            // Truy vấn dữ liệu từ cơ sở dữ liệu
                           

                            $sql = "SELECT * FROM product";
                            $result = $conn->query($sql);
        
                            // Kiểm tra nếu có dữ liệu trả về từ truy vấn
                            if ($result->num_rows > 0) {
                                // Duyệt qua từng dòng dữ liệu và hiển thị thông tin sản phẩm
                                while ($row = $result->fetch_assoc()) {
                                    $category = $row['id_category'];
                                    $img = $row['pro_img1'];
                                    $img2 = $row['pro_img2'];
                                    $img3 = $row['pro_img3'];


                                    // Gọi phương thức để lấy tên loại sản phẩm từ bảng category
                                    $category_name = $p->getCategoryName($category);

                                    // Tạo đường dẫn cho ảnh dựa trên loại sản phẩm
                                    $image_path = '../img/product/' . $category_name . '/' . $img;
                                    $image_path2 = '../img/product/' . $category_name . '/' . $img2;
                                    $image_path3 = '../img/product/' . $category_name . '/' . $img3;

                                    echo "<tr>";
                                    echo "<td>".$row["pro_id"]."</td>";
                                    echo ' <td><img src="' . $image_path . '" alt="' . $name . '"></td>';
                                    echo "<td>".$row["pro_name"]."</td>";
                                    echo "<td>".$category_name."</td>";
                                    echo "<td>".$row["pro_price"]."</td>";
                                    echo "<td>".$row["pro_quantity"]."</td>";
                                    echo "<td>";
                                    echo "<button id='suanguoidung' onclick='hienBoxSuaUser(\"".$row['pro_id']."\",\"".$row['pro_name']."\",  \"".$row['pro_price']."\",\"".$row['pro_author']."\",\"".$row['pro_publisher']."\",\"".$row['pro_description']."\",\"".$row['pro_quantity']."\",\"".$row['id_category']."\",\"".$image_path."\",\"".$image_path2."\",\"".$image_path3."\")'>Sửa</button>";
                                    if ($row["status"] == 1) {
                                    // Nếu người dùng chưa bị khóa, hiển thị nút "Khóa"
                                    echo "<button class='xoanguoidung' onclick='performAction(\"lock\", \"". $row['pro_id'] ."\")'>Xóa</button>";
                                }
                                
                                echo "</td>";
                                    echo "<tr>";

                                }
                            } else {
                                echo "No products available";
                            }
        

                        $conn->close();
                        ?>
                        </tbody>
                    </table>
                    <div class="overlay"></div>
                    <div class="boxsuauser" id="boxsuauser">
                                    <button onclick="dongFormChinhSua()">X</button>
                                    <script>
                                        function dongFormChinhSua() {
                                            var boxSuaUser = document.getElementById('boxsuauser');
                                            var overlay = document.querySelector('.overlay');

                                            boxSuaUser.style.display = 'none';
                                            document.querySelector('.overlay').classList.remove('show-overlay');
                                            document.body.classList.remove('no-scroll');
                                        }
                                    </script>
                                    <h2 style="margin-bottom: 10px;">Sửa thông tin sản phẩm  </h2>
                                    <form id="suaUserForm" action="../admin/suaproduct.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="image1">Ảnh 1:</label>
                                            <div class="change_img">
                                                <img src="" id="pro_img1" name="pro_img1">
                                                <div class="change_action">
                                                    <label for="input_file1" class="change_button">Sửa</label>
                                                    <input type="file" id="input_file1" name="pro_img1" class="input_file" accept="image/*" onchange="previewImage(event)">
                                                    <label class="change_button" onclick="del(this)">Xóa</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="image2">Ảnh 2:</label>
                                            <div class="change_img">
                                                <img src="" id="pro_img2" name="pro_img2">
                                                <div class="change_action">
                                                    <label for="input_file2" class="change_button">Sửa</label>
                                                    <input type="file" id="input_file2" name="pro_img2" class="input_file" accept="image/*" onchange="previewImage2(event)">
                                                    <label class="change_button" onclick="del(this)">Xóa</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="image3">Ảnh 3:</label>
                                            <div class="change_img">
                                                <img src="" id="pro_img3" name="pro_img3">
                                                <div class="change_action">
                                                    <label for="input_file3" class="change_button">Sửa</label>
                                                    <input type="file" id="input_file3" name="pro_img3" class="input_file" accept="image/*" onchange="previewImage3(event)">
                                                    <label class="change_button" onclick="del(this)">Xóa</label>
                                                </div>
                                            </div>
                                        </div>
                                        


                                        <div class="form-group">
                                            <label for="email">Mã sản phẩm:</label>
                                            <input type="text" name="pro_id" id="pro_id" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tên sản phẩm:</label>
                                            <input type="text" name="pro_name" id="pro_name" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Giá:</label>
                                            <input type="text" name="pro_price" id="pro_price" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Tác giả:</label>
                                            <input type="text"name="pro_author" id="pro_author" value="Dale Carnegie">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Nhà xuất bản:</label>
                                            <input type="text" name="pro_publisher" id="pro_publisher" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Mô tả:</label>
                                            <textarea
                                            name="pro_description" id="pro_description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="quatyti">Số lượng tồn kho:</label>
                                            <input type="text" name="pro_quantity" id="quatyti" value="1000">
                                        </div>
                                        <div class="form-group">
                                            <label for="goi">Danh mục:</label>
                                            <select id="goi" name="id_category">
                                                <option value="1">Kỹ năng sống - Phát triển cá nhân</option>
                                                <option value="2">Manga-Comic</option>
                                                <option value="3">Nghệ thuật-Văn hóa</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="update">
                                            <button type="submit"><i class="fa-solid fa-download"></i>Cập nhật</button> <!--Thay đổi nút "a" thành "button" và thêm type="submit"-->
                                            </div>

                                        </div>  

                                    </form>
                                </div>
                                <script>
                                document.getElementById('suaUserForm').addEventListener('submit', function(event) {
                                    event.preventDefault(); // Ngăn chặn form gửi dữ liệu mặc định
                                    var formData = new FormData(this); // Lấy dữ liệu từ form
                                    fetch('../admin/suaproduct.php', { // Gửi dữ liệu đến sua.php
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Có lỗi xảy ra khi cập nhật thông tin người dùng.');
                                        }
                                        return response.text();
                                    })
                                    .then(data => {
                                        alert(data); 
                                        location.reload();// Hiển thị thông báo từ server
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                                });
                                ///////////////////
                                function performAction(action, pro_id) {
                             if (action === 'lock') {
                             if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
                            // Gửi yêu cầu xóa sản phẩm thông qua AJAX
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "xoasanpham.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    // Xử lý kết quả nếu cần
                                    // Ví dụ: Cập nhật giao diện người dùng sau khi xóa
                                    location.reload(); // Tải lại trang sau khi xóa thành công
                                }
                            };
                            xhr.send("pro_id=" + pro_id);
                        }
                    }
                }
                var input1 = document.getElementById('input_file1');
                var input2 = document.getElementById('input_file2');
                var input3 = document.getElementById('input_file3');

                var file1 = input1.files[0];
                var file2 = input2.files[0];
                var file3 = input3.files[0];

                // Kiểm tra xem người dùng đã chọn file mới hay không
                if (file1) {
                    // Nếu có, thực hiện các xử lý tương ứng (ví dụ: hiển thị trước ảnh)
                }
                if (file2) {
                    // Nếu có, thực hiện các xử lý tương ứng (ví dụ: hiển thị trước ảnh)
                }
                if (file3) {
                    // Nếu có, thực hiện các xử lý tương ứng (ví dụ: hiển thị trước ảnh)
                }
                function previewImage(event) {
                        var file = event.target.files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('pro_img1').src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                function previewImage2(event) {
                    var file = event.target.files[0];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('pro_img2').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }

                function previewImage3(event) {
                    var file = event.target.files[0];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('pro_img3').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
                                        </script>
                                <script src="../js/suaproduct.js"></script>
                </div>
                <div class="pagination">
                    <li class="hientai">1</li>
                    <li><a href="quanlysanpham1.html" style="color: black;">2</a></li></a>
                    <li><a href="quanlysanpham1.html" style="color: black;">NEXT</a></li>
                </div>
            </div>
        </div>
        
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script>
        function hienBoxSuaUser( pro_id, pro_name, pro_price, pro_author, pro_publisher, pro_description, pro_quantity, id_category,pro_img1, pro_img2, pro_img3) {
    var boxSuaUser = document.getElementById('boxsuauser');
    var overlay = document.querySelector('.overlay');
    var form = document.getElementById('suaUserForm');
    // Thiết lập đường dẫn ảnh cho các thẻ <img>
    document.getElementById('pro_img1').src = pro_img1;
    document.getElementById('pro_img2').src = pro_img2;
    document.getElementById('pro_img3').src = pro_img3;
            


    // Điền dữ liệu vào form
    form.elements['pro_id'].value = pro_id;
    form.elements['pro_name'].value = pro_name;
    form.elements['pro_price'].value = pro_price;
    form.elements['pro_author'].value = pro_author;
    form.elements['pro_publisher'].value = pro_publisher;
    form.elements['pro_description'].value = pro_description;
    form.elements['pro_quantity'].value = pro_quantity;

    

    // Lấy tất cả các options trong select danh mục
    var selectCategory = form.elements['id_category'].options;

    // Duyệt qua từng option để chọn option tương ứng với id_category
    for (var i = 0; i < selectCategory.length; i++) {
        if (selectCategory[i].value === id_category) {
            selectCategory[i].selected = true; // Chọn option có value là id_category
            break;
        }
    }

    // Hiển thị form
    boxSuaUser.style.display = 'block';
    overlay.classList.add('show-overlay');
    document.body.classList.add('no-scroll');
}
console.log(pro_img1, pro_img2, pro_img3);

 </script>

</body>

</html>