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
                            <option value="category">Lọc theo danh mục</option>
                            <option value="publisher">Lọc theo nhà xuất bản</option>
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
                <!-- ================ Add Charts JS ================= -->
                <div class="chartsBx">
                    <h2>TOP 10 SÁCH CÓ SỐ LƯỢNG BÁN RA CAO NHẤT TRONG NĂM 2023</h2>
                    <div class="chart"> <canvas id="chart-4"></canvas> </div>
                </div>
                <div class="user-table">
                    <table>
                        <thead>
                            <tr>
                                <td>STT</td>
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

                                    // Gọi phương thức để lấy tên loại sản phẩm từ bảng category
                                    $category_name = $p->getCategoryName($category);

                                    // Tạo đường dẫn cho ảnh dựa trên loại sản phẩm
                                    $image_path = '../img/product/' . $category_name . '/' . $img;
                                    echo "<tr>";
                                    echo "<td>".$row["pro_id"]."</td>";
                                    echo ' <td><img src="' . $image_path . '" alt="' . $name . '"></td>';
                                    echo "<td>".$row["pro_name"]."</td>";
                                    echo "<td>".$row["id_category"]."</td>";
                                    echo "<td>".$row["pro_price"]."</td>";
                                    echo "<td>".$row["pro_quantity"]."</td>";
                                    echo "<td>";
                                    echo "<button id='suanguoidung' onclick='hienBoxSuaUser1(\"".$row['pro_id']."\", \"".$row['pro_img1']."\", \"".$row['pro_img2']."\", \"".$row['pro_img3']."\", \"".$row['pro_name']."\", \"".$row['pro_price']."\",\"".$row['pro_author']."\",\"".$row['pro_publisher']."\",\"".$row['pro_description']."\",\"".$row['pro_quantity']."\")'>Sửa</button>";
                                    if ($row["status"] == 1) {
                                    // Nếu người dùng chưa bị khóa, hiển thị nút "Khóa"
                                    echo "<button class='xoanguoidung' onclick='performAction(\"lock\", \"". $row['id'] ."\")'>Xóa</button>";
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
                                            boxSuaUser.style.display = 'none';
                                            document.querySelector('.overlay').classList.remove('show-overlay');
                                            document.body.classList.remove('no-scroll');
                                        }
                                    </script>
                                    <h2 style="margin-bottom: 10px;">Sửa thông tin sản phẩm  </h2>
                                    <form id="suaUserForm" action="../admin/suaproduct.php" method="post"> <!--Thêm action và method vào form-->
                                        <div class="form-group">
                                            <label for="image1">Ảnh 1:</label>
                                            <div class="change_img">
                                                <img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 1.jpg" id="product_pic1" name="pro_img1">
                                                <div class="change_action">
                                                    <label for="input_file1" class="change_button">Sửa</label>
                                                    <input type="file" id="input_file1" class="input_file" accept="image/*">
                                                    <label class="change_button" onclick="del(this)">Xóa</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="image2">Ảnh 2:</label>
                                            <div class="change_img">
                                                <img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 2.jpg" id="product_pic2" name="pro_img2">
                                                <div class="change_action">
                                                    <label for="input_file2" class="change_button">Sửa</label>
                                                    <input type="file" id="input_file2" class="input_file" accept="image/*">
                                                    <label class="change_button" onclick="del(this)">Xóa</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="image3">Ảnh 3:</label>
                                            <div class="change_img">
                                                <img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 3.jpg" id="product_pic3" name="pro_img3">
                                                <div class="change_action">
                                                    <label for="input_file3" class="change_button">Sửa</label>
                                                    <input type="file" id="input_file3" class="input_file" accept="image/*">
                                                    <label class="change_button" onclick="del(this)">Xóa</label>
                                                </div>
                                            </div>
                                        </div>
                                        


                                        <div class="form-group">
                                            <label for="email">Mã sản phẩm:</label>
                                            <input type="text" name="pro_id" id="email" value="KNS49">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tên sản phẩm:</label>
                                            <input type="text" name="pro_name" id="name" value="Đắc Nhân Tâm">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Giá:</label>
                                            <input type="text" name="pro_price" id="email" value="77.400 đ">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Tác giả:</label>
                                            <input type="text"name="pro_author" id="email" value="Dale Carnegie">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Nhà xuất bản:</label>
                                            <input type="text" name="pro_publisher" id="email" value="Văn Học">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Mô tả:</label>
                                            <textarea
                                            name="pro_description" id="description">Đắc nhân tâm của Dale Carnegie là quyển sách của mọi thời đại và một hiện tượng đáng kinh ngạc trong ngành xuất bản Hoa Kỳ. Chiếm vị trí số một trong danh mục sách bán chạy nhất và trở thành một sự kiện có một không hai trong lịch sử ngành xuất bản thế giới và được đánh giá là một quyển sách có tầm ảnh hưởng nhất mọi thời đại.</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="quatyti">Số lượng tồn kho:</label>
                                            <input type="text" name="pro_quantity" id="quatyti" value="1000">
                                        </div>
                                        <div class="form-group">
                                            <label for="goi">Danh mục:</label>
                                            <select id="goi" name="id_category">
                                                <option>Kỹ năng sống - Phát triển cá nhân</option>
                                                <option>Manga-Comic</option>
                                                <option>Nghệ thuật-Văn hóa</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="update">
                                                <a onclick="warning()"><i class="fa-solid fa-download"></i>Cập nhật</a>
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
        <!-- ======= Charts JS ====== -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <script src="../js/chartsachbanchay.js"></script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script>
        function hienBoxSuaUser1(pro_id, pro_img1, pro_img2, pro_img3, pro_name,pro_author,pro_publisher,pro_description,pro_quantity,pro_price,id_category) {

    var boxSuaUser = document.getElementById('boxsuauser');
    var overlay = document.querySelector('.overlay');
    var form = document.getElementById('suaUserForm');

    // Điền dữ liệu vào form
    form.elements['pro_id'].value = pro_id;
    form.elements['pro_img1'].value = pro_img1;
    form.elements['pro_img2'].value = pro_img2;
    form.elements['pro_img3'].value = pro_img3;
    form.elements['pro_author'].value = pro_author;
    form.elements['pro_publisher'].value = pro_publisher;
    form.elements['pro_description'].value = pro_description;
    form.elements['pro_quantity'].value = pro_quantity;
    form.elements['pro_price'].value = pro_price;
    form.elements['id_category'].value = id_category;
    form.elements['pro_name'].value = pro_name;


    // Hiển thị form
    boxSuaUser.style.display = 'block';
    overlay.classList.add('show-overlay');
    document.body.classList.add('no-scroll');
}
 </script>

</body>

</html>