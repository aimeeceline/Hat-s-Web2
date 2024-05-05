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
            <div class="user">
                <div class="banner">
                    <button id="adduser"><a href="../html/themsanpham.html">+ Thêm sản phẩm</a></button>
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
                                <td>Mã SP</td>
                                <td>Ảnh</td>
                                <td>Tên SP </td>
                                <td>Danh mục</td>
                                <td>Giá</td>
                                <td>Tồn kho</td>
                                <td>Ngày cập nhật</td>
                                <td>Thao tác</td>
                            </tr>
                        </thead>
                        <!-- ================ bảng sửa sản phẩm  ================= -->
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>KNS49</td>
                                <td><img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 1.jpg"></td>
                                <td>Đắc nhân tâm</td>
                                <td>KNS-PTCN</td>
                                <td>200.000đ</td>
                                <td>1000</td>
                                <td>29/7/2023 11:11</td>
                                <td>
                                    <button class="suanguoidung" onclick="hienBoxSuaUser()">Sửa</button>
                                    <button onclick="myFunction()" class="xoanguoidung">Xóa</button>
                                    <script>
                                        function myFunction() {
                                            const confirmation = confirm("Bạn có chắc chắn xóa sách này không?");
                                            if (confirmation) {
                                                alert("Đã xóa sản phẩm thành công!");
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>


                            <tr>
                                <td>1</td>
                                <td>KNS49</td>
                                <td><img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 1.jpg"></td>
                                <td>Đắc nhân tâm</td>
                                <td>KNS-PTCN</td>
                                <td>200.000đ</td>
                                <td>1000</td>
                                <td>29/7/2023 11:11</td>
                                <td>
                                    <button class="suanguoidung" onclick="hienBoxSuaUser()">Sửa</button>
                                    <button onclick="myFunction()" class="xoanguoidung">Xóa</button>
                                    <script>
                                        function myFunction() {
                                            const confirmation = confirm("Bạn có chắc chắn xóa sách này không?");
                                            if (confirmation) {
                                                alert("Đã xóa sản phẩm thành công!");
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>KNS49</td>
                                <td><img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 1.jpg"></td>
                                <td>Đắc nhân tâm</td>
                                <td>KNS-PTCN</td>
                                <td>200.000đ</td>
                                <td>1000</td>
                                <td>29/7/2023 11:11</td>
                                <td>
                                    <button class="suanguoidung" onclick="hienBoxSuaUser()">Sửa</button>
                                    <button onclick="myFunction()" class="xoanguoidung">Xóa</button>
                                    <script>
                                        function myFunction() {
                                            const confirmation = confirm("Bạn có chắc chắn xóa sách này không?");
                                            if (confirmation) {
                                                alert("Đã xóa sản phẩm thành công!");
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>KNS49</td>
                                <td><img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 1.jpg"></td>
                                <td>Đắc nhân tâm</td>
                                <td>KNS-PTCN</td>
                                <td>200.000đ</td>
                                <td>1000</td>
                                <td>29/7/2023 11:11</td>
                                <td>
                                    <button class="suanguoidung" onclick="hienBoxSuaUser()">Sửa</button>
                                    <button onclick="myFunction()" class="xoanguoidung">Xóa</button>
                                    <script>
                                        function myFunction() {
                                            const confirmation = confirm("Bạn có chắc chắn xóa sách này không?");
                                            if (confirmation) {
                                                alert("Đã xóa sản phẩm thành công!");
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>KNS49</td>
                                <td><img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 1.jpg"></td>
                                <td>Đắc nhân tâm</td>
                                <td>KNS-PTCN</td>
                                <td>200.000đ</td>
                                <td>1000</td>
                                <td>29/7/2023 11:11</td>
                                <td>
                                    <button class="suanguoidung" onclick="hienBoxSuaUser()">Sửa</button>
                                    <button onclick="myFunction()" class="xoanguoidung">Xóa</button>
                                    <script>
                                        function myFunction() {
                                            const confirmation = confirm("Bạn có chắc chắn xóa sách này không?");
                                            if (confirmation) {
                                                alert("Đã xóa sản phẩm thành công!");
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
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
                                    <form id="suaUserForm">
                                        <div class="form-group">
                                            <label for="image1">Ảnh 1:</label>
                                            <div class="change_img">
                                                <img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 1.jpg" id="product_pic1">
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
                                                <img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 2.jpg" id="product_pic2">
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
                                                <img src="../img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 3.jpg" id="product_pic3">
                                                <div class="change_action">
                                                    <label for="input_file3" class="change_button">Sửa</label>
                                                    <input type="file" id="input_file3" class="input_file" accept="image/*">
                                                    <label class="change_button" onclick="del(this)">Xóa</label>
                                                </div>
                                            </div>
                                        </div>
                                        


                                        <div class="form-group">
                                            <label for="email">Mã sản phẩm:</label>
                                            <input type="text" id="email" value="KNS49">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tên sản phẩm:</label>
                                            <input type="text" id="name" value="Đắc Nhân Tâm">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Giá:</label>
                                            <input type="text" id="email" value="77.400 đ">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Tác giả:</label>
                                            <input type="text" id="email" value="Dale Carnegie">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Nhà xuất bản:</label>
                                            <input type="text" id="email" value="Văn Học">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Mô tả:</label>
                                            <textarea
                                                id="description">Đắc nhân tâm của Dale Carnegie là quyển sách của mọi thời đại và một hiện tượng đáng kinh ngạc trong ngành xuất bản Hoa Kỳ. Chiếm vị trí số một trong danh mục sách bán chạy nhất và trở thành một sự kiện có một không hai trong lịch sử ngành xuất bản thế giới và được đánh giá là một quyển sách có tầm ảnh hưởng nhất mọi thời đại.</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="quatyti">Số lượng tồn kho:</label>
                                            <input type="text" id="quatyti" value="1000">
                                        </div>
                                        <div class="form-group">
                                            <label for="goi">Danh mục:</label>
                                            <select id="goi" name="goi">
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

                                <script src="../js/suasanpham.js"></script>
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
</body>

</html>