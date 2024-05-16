<?php
session_start();
include ("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$limit = 10; // Số lượng sản phẩm trên mỗi trang
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
$start = ($current_page - 1) * $limit;

// Truy vấn tổng số sản phẩm
$total_records_query = "SELECT COUNT(*) AS total FROM product";
$total_records_result = $conn->query($total_records_query);
$total_records_row = $total_records_result->fetch_assoc();
$total_records = $total_records_row['total'];

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
    <link rel="stylesheet" href="../css/pagination.css">

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
                    <a href="../admin/quanlykhachhang.php">
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
                
            </div>
            
            <!-- ================ LÀM QUẢN LÝ SẢN PHẨM Ở ĐÂY ================= -->
            <div class="user">
                <div class="banner">
                    <button id="adduser"><a href="../admin/themsanpham.php">+ Thêm sản phẩm</a></button>
                    <form action="" method="GET">
                    <label>
                    <input type="text" id="searchInput" name="search" placeholder="Nhập tên sản phẩm">
                        <button id="searchButton">Tìm</button>
                    </label>
</form>
                    
                </div>
                

                <div class="user-table">
        <table>
            <thead>
                <tr>
                    <td>Mã SP</td>
                    <td>Ảnh</td>
                    <td>Tên SP</td>
                    <td>Danh mục</td>
                    <td>Giá</td>
                    <td>Tồn kho</td>
                    <td>Thao tác</td>
                </tr>
            </thead>
            <tbody>
                <?php
                // Hiển thị thông tin sản phẩm (nếu không tìm kiếm hoặc khi tìm kiếm có kết quả)
                if (!isset($_GET['search']) || $result->num_rows > 0) {
                    // Truy vấn dữ liệu từ cơ sở dữ liệu
                    $sql = "SELECT * FROM product ORDER BY pro_id DESC LIMIT $start, $limit";
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
                                    echo "<td>" . $row["pro_id"] . "</td>";
                                    echo ' <td><img src="' . $image_path . '" alt="' . $name . '"></td>';
                                    echo "<td>" . $row["pro_name"] . "</td>";
                                    echo "<td>" . $category_name . "</td>";
                                    echo "<td>" . $row["pro_price"] . "</td>";
                                    echo "<td>" . $row["pro_quantity"] . "</td>";
                                    echo "<td>";
                                    if ($row["status"] == 1) {
                                    echo "<button id='suanguoidung' onclick='hienBoxSuaUser(\"" . $row['pro_id'] . "\",\"" . $row['pro_name'] . "\",  \"" . $row['pro_price'] . "\",\"" . $row['pro_author'] . "\",\"" . $row['pro_publisher'] . "\",\"" . $row['pro_description'] . "\",\"" . $row['pro_quantity'] . "\",\"" . $row['id_category'] . "\",\"" . $image_path . "\",\"" . $image_path2 . "\",\"" . $image_path3 . "\")'>Sửa</button>";
                                        echo "<button id='xoanguoidung' data-proid='" . $row['pro_id'] . "' onclick='performAction(this)'>Xóa</button>";
                                    }
                                    else{
                                        echo '<button class="restore-btn" data-proid="' . htmlspecialchars($row['pro_id']) . '">Khôi phục</button>'; 
                                                                       }                                   echo "</td>";
                                    echo "<tr>";
                                                                
                        }                       
                    } else {
                        echo "<tr><td colspan='7'>Không có sản phẩm nào.</td></tr>";
                    }
                }
                
                // Hiển thị kết quả tìm kiếm
                if (isset($_GET['search'])) {
                    // Lấy từ khoá tìm kiếm từ URL
                    $searchKeyword = '%' . $_GET['search'] . '%';

                    // Truy vấn dữ liệu từ cơ sở dữ liệu
                    $sql = "SELECT * FROM product WHERE pro_name LIKE ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $searchKeyword);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Hiển thị kết quả tìm kiếm
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
                                    echo "<td>" . $row["pro_id"] . "</td>";
                                    echo ' <td><img src="' . $image_path . '" alt="' . $name . '"></td>';
                                    echo "<td>" . $row["pro_name"] . "</td>";
                                    echo "<td>" . $category_name . "</td>";
                                    echo "<td>" . $row["pro_price"] . "</td>";
                                    echo "<td>" . $row["pro_quantity"] . "</td>";
                                    echo "<td>";
                                    if ($row["status"] == 1) {
                                    echo "<button id='suanguoidung' onclick='hienBoxSuaUser(\"" . $row['pro_id'] . "\",\"" . $row['pro_name'] . "\",  \"" . $row['pro_price'] . "\",\"" . $row['pro_author'] . "\",\"" . $row['pro_publisher'] . "\",\"" . $row['pro_description'] . "\",\"" . $row['pro_quantity'] . "\",\"" . $row['id_category'] . "\",\"" . $image_path . "\",\"" . $image_path2 . "\",\"" . $image_path3 . "\")'>Sửa</button>";
                                        echo "<button id='xoanguoidung' data-proid='" . $row['pro_id'] . "' onclick='performAction(this)'>Xóa</button>";
                                    }
                                    else{
                                        echo '<button class="restore-btn" data-proid="' . htmlspecialchars($row['pro_id']) . '">Khôi phục</button>'; 
                                                                       }                                   echo "</td>";
                                    echo "<tr>";
                                   
                        }
                    } else {
                        echo "<tr><td colspan='7'>Không tìm thấy sản phẩm nào phù hợp.</td></tr>";
                    }
                }
                
                ?>
                        </tbody>
                    </table>
                    <div class="pagination1">
                    <?php
                    $is_searching = isset($_GET['search']);

                    if (!$is_searching) {
                    $total_pages = ceil($total_records / $limit);
                    if ($current_page > 1) {
                        echo '<li><a href="quanlysanpham.php?page=' . ($current_page - 1) . $searchQuery . '">TRC</a></li>';
                    }
        
                    // Hiển thị nút phân trang
                    for ($i = 1; $i <= $total_pages; $i++) {
                        // Kiểm tra xem có phải trang hiện tại không
                        $current_class = ($i == $current_page) ? ' class="hientai"' : '';
                        echo '<li' . $current_class . '><a href="quanlysanpham.php?page=' . $i . $searchQuery . '">' . $i . '</a></li>';
                                    }
        
                    // Hiển thị nút Next
                    if ($current_page < $total_pages) {
                        echo '<li><a href="quanlysanpham.php?page=' . ($current_page + 1) . $searchQuery . '">SAU</a></li>';
                    }
                }

?></div>

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
                        <h2 style="margin-bottom: 10px;">Sửa thông tin sản phẩm </h2>
                        <form id="suaUserForm" action="suaproduct.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="image1">Ảnh 1:</label>
                                <div class="change_img">
                                    <img src="" id="pro_img1" name="pro_img1">
                                    <div class="change_action">
                                        <label for="input_file1" class="change_button">Sửa</label>
                                        <input type="file" id="input_file1" name="pro_img1" class="input_file"
                                            accept="image/*" onchange="previewImage(event)">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image2">Ảnh 2:</label>
                                <div class="change_img">
                                    <img src="" id="pro_img2" name="pro_img2">
                                    <div class="change_action">
                                        <label for="input_file2" class="change_button">Sửa</label>
                                        <input type="file" id="input_file2" name="pro_img2" class="input_file"
                                            accept="image/*" onchange="previewImage2(event)">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image3">Ảnh 3:</label>
                                <div class="change_img">
                                    <img src="" id="pro_img3" name="pro_img3">
                                    <div class="change_action">
                                        <label for="input_file3" class="change_button">Sửa</label>
                                        <input type="file" id="input_file3" name="pro_img3" class="input_file"
                                            accept="image/*" onchange="previewImage3(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
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
                                <input type="text" name="pro_author" id="pro_author" value="Dale Carnegie">
                            </div>
                            <div class="form-group">
                                <label for="email">Nhà xuất bản:</label>
                                <input type="text" name="pro_publisher" id="pro_publisher" value="">
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả:</label>
                                <textarea name="pro_description" id="pro_description"></textarea>
                            </div>
                            <div class="form-group" style="display: none;">
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
                                    <button type="submit"><i class="fa-solid fa-download">Cập nhật</button>
                                    <!--Thay đổi nút "a" thành "button" và thêm type="submit"-->
                                </div>

                            </div>

                        </form>
                    </div>
                    <script>
                        document.getElementById('suaUserForm').addEventListener('submit', function (event) {
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
                            reader.onload = function (e) {
                                document.getElementById('pro_img1').src = e.target.result;
                            }
                            reader.readAsDataURL(file);
                        }
                        function previewImage2(event) {
                            var file = event.target.files[0];
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('pro_img2').src = e.target.result;
                            }
                            reader.readAsDataURL(file);
                        }

                        function previewImage3(event) {
                            var file = event.target.files[0];
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('pro_img3').src = e.target.result;
                            }
                            reader.readAsDataURL(file);
                        }
                    </script>
                    <script src="../js/suaproduct.js"></script>
                </div>
                <script>
                    function performAction(button) {
    var proId = button.getAttribute('data-proid'); // Lấy giá trị từ thuộc tính data-proid
    var confirmMsg = confirm("BẠN CÓ CHẮC MUỐN XÓA SẢN PHẨM NÀY?");
    if (confirmMsg) {
        // Gửi yêu cầu kiểm tra sản phẩm trong ORDERDETAILS
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === 'sold') {
                        // Sản phẩm đã được bán, xác nhận thêm từ người dùng
                        var confirmSold = confirm("Sản phẩm này đã được bán. Bạn có chắc chắn muốn xóa không?");
                        if (confirmSold) {
                            sendDeleteRequest(proId);
                        }
                    } else if (response === 'not_sold') {
                        // Sản phẩm chưa bán, gửi yêu cầu xóa
                        sendDeleteRequest(proId);
                    } else {
                        alert("Có lỗi xảy ra khi kiểm tra sản phẩm.");
                    }
                } else {
                    alert("Có lỗi khi gửi yêu cầu đến máy chủ.");
                }
            }
        };
        xhr.open("POST", "check_product_status.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("proId=" + proId);
    }
}
function sendDeleteRequest(proId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'sold_updated') {
                    alert("Đã cập nhật trạng thái sản phẩm thành công.");
                    location.reload();
                } else if (response === 'not_sold_deleted') {
                    alert("Đã xóa sản phẩm chưa bán thành công.");
                    location.reload();
                } else {
                    alert("Có lỗi xảy ra khi xử lý yêu cầu.");
                }
            } else {
                alert("Có lỗi khi gửi yêu cầu đến máy chủ.");
            }
        }
    };
    xhr.open("POST", "xoasp.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("proId=" + proId);
}
document.querySelectorAll('.restore-btn').forEach(button => {
    button.addEventListener('click', function() {
        var proId = this.getAttribute('data-proid');
        restoreProduct(proId);
    });
});

function restoreProduct(proId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'success') {
                    alert("ĐÃ KHÔI PHỤC THÀNH CÔNG!");
                    location.reload(); // Tải lại trang để cập nhật danh sách sản phẩm
                } else {
                    alert("CÓ LỖI KHI KHÔI PHỤC SẢN PHẨM");
                }
            } else {
                alert("Có lỗi khi gửi yêu cầu đến máy chủ.");
            }
        }
    };
    xhr.open("POST", "restore_product.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("proId=" + proId);
}
                </script>

            </div>
        </div>


        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script>
            function hienBoxSuaUser(pro_id, pro_name, pro_price, pro_author, pro_publisher, pro_description, pro_quantity, id_category, pro_img1, pro_img2, pro_img3) {
                var overlay = document.querySelector('.overlay');
                var form = document.getElementById('suaUserForm');
                var boxSuaUser = document.getElementById('boxsuauser');
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

        </script>

</body>

</html>