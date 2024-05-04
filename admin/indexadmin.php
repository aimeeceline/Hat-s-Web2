<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ quản trị</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/indexadmin.css">
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
                    <a href="../html/trangchuadmin.html" id="active">
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
                    <a href="../html/quanlysanpham.html">
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
                <div class="search" >
                    <label>
                        <input type="text" placeholder="Tìm kiếm chức năng quản trị">
                       <a href="../html/adminnotfound.html"><ion-icon name="search-outline"></ion-icon></a>
                    </label>
                </div>
            </div>
            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">3000</div>
                        <div class="cardName">Lượt truy cập hôm nay</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">694</div>
                        <div class="cardName">Đơn hàng tháng 12</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Đánh giá mới</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">10.370.790đ</div>
                        <div class="cardName">Lợi nhuận tháng 12</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>
            
            <h2 style="margin-left: 20px;">Thống kê tình hình kinh doanh</h2>
        
            <div class="filter">
                <div class="flex">
                <span><input type="radio" name="chon" value="ten" id="ten" onclick="checkTen()" checked>Theo tên sản phẩm</span>
                <span><input type="radio" name="chon" value="loai" id="loai" onclick="checkLoai()">Theo loại sản phẩm</span>
                <input type="text" name="tenSp" id="tenSp" placeholder="Tên sản phẩm">
                <select name="loaiSp" id="loaiSp">
                    <option value="Kỹ năng sống - Phát triển bản thân">Kỹ năng sống - Phát triển bản thân</option>
                    <option value="Manga-Comic">Manga-Comic</option>
                    <option value="Nghệ thuật-Văn hóa">Nghệ thuật-Văn hóa</option>
                </select>
                </div>
                <div class="date">
                    <label for="start">Từ ngày: </label>
                    <input type="date" id="start" name="start" value="2023-11-24" min="2018-01-01" max="2023-12-31">
                    <label for="start">đến </label>
                    <input type="date" id="end" name="end" value="2023-11-30" min="2018-01-01" max="2023-12-31">
                </div>
                <button class="thongke"><a href="../html/thongke.html">Thống kê</a></button>
            </div>

            <div id="reportResult">
                
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã ĐH</th>
                            <th>Người đặt</th>
                            <th>SĐT</th>
                            <th>Tình trạng</th>
                            <th>Thành tiền</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="../html/chitietdonhang.html"> ĐH 5728319</a></td>
                            <td>thaihien99</td>
                            <td>0987654321</td>
                            <td id="premium">Chờ xác nhận</td>
                            <td>75.999đ</td>
                            <td>14/10/2023</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><a href="../html/chitietdonhang.html"> ĐH 5728319</a></td>
                            <td>thaihien99</td>
                            <td>0987654321</td>
                            <td id="premium">Chờ xác nhận</td>
                            <td>75.999đ</td>
                            <td>14/10/2023</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><a href="../html/chitietdonhang.html"> ĐH 5728319</a></td>
                            <td>thaihien99</td>
                            <td>0987654321</td>
                            <td id="premium">Chờ xác nhận</td>
                            <td>75.999đ</td>
                            <td>14/10/2023</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><a href="../html/chitietdonhang.html"> ĐH 5728319</a></td>
                            <td>thaihien99</td>
                            <td>0987654321</td>
                            <td id="basic">Đã giao</td>
                            <td>75.999đ</td>
                            <td>14/10/2023</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><a href="../html/chitietdonhang.html"> ĐH 5728319</a></td>
                            <td>thaihien99</td>
                            <td>0987654321</td>
                            <td id="basic">Đã giao</td>
                            <td>75.999đ</td>
                            <td>14/10/2023</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><a href="../html/chitietdonhang.html"> ĐH 5728319</a></td>
                            <td>thaihien99</td>
                            <td>0987654321</td>
                            <td id="basic">Đã giao</td>
                            <td>75.999đ</td>
                            <td>14/10/2023</td>
                            <td><input type="checkbox"></td>
                        </tr>

                    </tbody>

                </table>
                <div class="pagination">
                    <li class="hientai">1</li>
                    <li><a href="trangchuadmin1.html" style="color: black;">2</a></li></a> 
                    <li><a href="trangchuadmin1.html" style="color: black;" >NEXT</a></li>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Đơn hàng gần đây</h2>
                        <a href="../html/quanlydonhang.html" class="btn">Xem chi tiết</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>MÃ ĐƠN HÀNG</td>
                                <td>GIÁ</td>
                                <td>THANH TOÁN</td>
                                <td>Còn hàng</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><a href="../html/chitietdonhang.html">ĐH 6248937</a></td>
                                <td>170.070đ</td>
                                <td>COD</td>
                                <td><span class="status inProgress">Chờ xác nhận</span></td>
                            </tr>

                            <tr>
                                <td><a href="../html/chitietdonhang.html">ĐH 7632148</a></td>
                                <td>80.360đ</td>
                                <td>BTP</td>
                                <td><span class="status inProgress">Chờ xác nhận</span></td>
                            </tr>

                            <tr>
                                <td><a href="../html/chitietdonhang.html">ĐH 9753814</a></td>
                                <td>50.000đ</td>
                                <td>COD</td>
                                <td><span class="status pending">Đã lấy hàng</span></td>
                            </tr>

                            <tr>
                                <td><a href="../html/chitietdonhang.html">ĐH 8553756</a></td>
                                <td>96.900đ</td>
                                <td>COD</td>
                                <td><span class="status pending">Đã lấy hàng</span></td>
                            </tr>

                            <tr>
                                <td><a href="../html/chitietdonhang.html">ĐH 4187256</a></td>
                                <td>120.300đ</td>
                                <td>COD</td>
                                <td><span class="status return">Đã trả hàng</span></td>
                            </tr>

                            <tr>
                                <td><a href="../html/chitietdonhang.html">ĐH 8196437</a></td>
                                <td>260.040đ</td>
                                <td>BTP</td>
                                <td><span class="status delivered">Đã giao</span></td>
                            </tr>
                            <tr>
                                <td><a href="../html/chitietdonhang.html">ĐH 5379468</a></td>
                                <td>120.000đ</td>
                                <td>BTP</td>
                                <td><span class="status delivered">Đã giao</span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                
                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Người dùng mới đăng ký</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../img/banner/avt1.png" alt=""></div>
                            </td>
                            <td>
                                <h4>aimeeceline00<br> <span>Bạc</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../img/banner/avt2.png" alt=""></div>
                            </td>
                            <td>
                                <h4>thaihien99<br> <span>Bạc</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../img/banner/avt3.png" alt=""></div>
                            </td>
                            <td>
                                <h4>vantuan00<br> <span>Bạc</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../img/banner/avt4.png" alt=""></div>
                            </td>
                            <td>
                                <h4>myhuong7749<br> <span>Bạc</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../img/banner/avt5.png" alt=""></div>
                            </td>
                            <td>
                                <h4>hoasenhong404<br> <span>Vàng</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../img/banner/avt6.png" alt=""></div>
                            </td>
                            <td>
                                <h4>umboumbo11<br> <span>Vàng</span></h4>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        
        

            <script>
            
                    ten = document.getElementById("ten");
                    loai = document.getElementById("loai");
                    tenSp = document.getElementById("tenSp");
                    loaiSp = document.getElementById("loaiSp");
                    function checkTen(){
                        tenSp.style.display="block";
                        loaiSp.style.display="none";
                    }
        
                    function checkLoai(){
                        tenSp.style.display="none";
                        loaiSp.style.display="block";
                    }
                      
            </script>
            </div>
    </div>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>