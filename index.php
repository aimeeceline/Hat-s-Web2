
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Tìm kiếm">
            <label for="check" class="icon">
                <a href="html/notfound.html"><i class="fas fa-search"></i></a>
            </label>
        </div>
    </div>
    <div class="buttons">
    <div class="login">
    <img
          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAkpJREFUSEvl1knIjVEcx/HPS+aNcWVnYSND5lKmiNgQC2RFyZBMCymlWFjItEBSNkRKSUJIFBtTkSHWZCEkRZGp/9u59bzPe+99njvUu3B2955zft/zH87vPB16aHT0EFcz4N4Yhynp0A/xHL8bCaJR8DIcxcgc5C0243JZeCPgw9haIHwIO8rAy4Ln42YSfIRdeJJ+T8L+TOrn4k4RvCz4FualWk7Gz5xwXzzGWFzHonaAe+Eb+mMTjtcQ3Yhj+Ioh+FMPXibi6OBnSWQxrtUQjCivprkxeNUqODr4XRJZhfM1BFfiXJqLPe9bBcf+TxiKel17ENvxESPaUePQ2IfdySSW4kpOeAkuIsxlD/a2CxyN9RKjkuD91MV9UifPTP+/Sa6W7/pu5yjTXJVN0WRnE6haQGGbUec4YOFoBBxicbU2YAGm41eKPO7uyaIrlD1No+DCSMouKAsehhmYhnCufjnAjxT5A0T9PxcdoAg8GAewltJP6N+U9p3JxaqeoR54OU5geGbn9+Ri1bx6PAZm1n7AelyqRq4Fjkc+0laZP40jeIGIqJZWPBJbsCYtiLVTUxm67KkGjpcmrsZoRIQLca+oZrn5WcnTIwOvEdnokqVq4LDFbUloHU41CK0sjzRHqWJ0s9pq4IhyAG6kaJvkdm67jfgwCM1B9e5xXJsw+RgrcKEVKlbjTNKIN/pLRS8f8cTMJ03UNqJuZWTf6LDc6J3OkQfPznwvzcHdVqioqZcHh2FMSLCn2dQ0eYCaekXO1SSveNv/B/4HUH5pHwh1c9gAAAAASUVORK5CYII=" />
    <?php if(isset($_SESSION['myid']) && isset($_SESSION['myuser']) && isset($_SESSION['mypass']) && isset($_SESSION['myrole']) && $_SESSION['myrole'] == 2) { 
    $loggedInUserName = $_SESSION['myuser'];
    echo "Xin chào, $loggedInUserName!";?>
        <span class="tooltip">
            <button>Lịch sử mua hàng</button>
            <a href="logout.php"><button>Đăng xuất</button></a>
        </span>
    <?php } else {?>
        <span class="tooltip">
            <a href="html/signupsignin.html"><button>Đăng nhập</button></a>
            <a href="html/signup.html"><button>Đăng ký</button></a>
        </span>
    <?php } ?>
</div>
</div>
        <a href="html/giohang.html" class="cart">
          <img
            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAXRJREFUSEvt1r9LVlEcx/GX4Kbg6iRSkG4m4pZRQ2OCm4Tg/9AgKE6Co+i/ENLgEgRBS5CUm4I4BWKSe+DSmsSR88jj7V7v90TwODxnO+d8zud9vz+4fAf0aA30iOtfwIOYxkz+6CMc43dJECXgpF3FCkYqkEtsYCcKLwHvYqnFeBuvI/Ao+BXeZsOLbP4l759hC2N5/wKf2uBR8Hc8QErpI/ysGI/iDEM4wNz/AD/MpslrHZsNpul8DVe5B37dBY9E/ARfs8lLfGgwnMf7fDeL1O2NKwJONfycHZ5jv8Etqrt+XgUP4yTXs61MJffnmMJN+qvg1BSdbi0xjmifdpXsr4i70/UGPzCO5ezcOasD1em6z26VqRpxXZ2itSt6e6/Bkfo1aRqzFYm4Dy7JQD/VN7/bfnNF/1LRBrv/zTWJb9FwCnUTOO28qRsE3mGh0LRNvofFblEdOJ2lMeZxzaDQBqjep/nrEB+rF5HRpxQW0vcM/AcLDWsfXKwkoAAAAABJRU5ErkJggg==" />
          <span>&nbsp;0&nbsp;</span>
        </a>
    </nav>
    <!-----------------------------------Kết thúc Header--------------------------------------------------->
    <!-----------------------------------Bắt đầu Slider------------------------------------------->
    <div class="slider">
      <div class="lista">
        <div class="item">
          <img src="img/banner/banner1.png">
        </div>
        <div class="item">
          <img src="img/banner/banner2.png">
        </div>
        <div class="item">
          <img src="img/banner/banner3.png">
        </div>
        <div class="item">
          <img src="img/banner/banner4.png">
        </div>
        <div class="item">
          <img src="img/banner/banner5.png">
        </div>
        <div class="item">
          <img src="img/banner/banner6.png">
        </div>
      </div>
      <div class="bat"><!--button prev and next-->
        <button id="prev">&#60;</button>
        <button id="next">&#62;</button>
      </div>
      <ul class="dots"><!--dots-->
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <script>
      let list = document.querySelector('.slider .lista');
      let items = document.querySelectorAll('.slider .lista .item');
      let dots = document.querySelectorAll('.slider .dots li');
      let prev = document.getElementById('prev');
      let next = document.getElementById('next');
      let active = 0;
      let lenghItems = items.length - 1;
      next.onclick = function () {
        if (active + 1 > lenghItems) {
          active = 0;
        }
        else {
          active += 1;
        }
        reloadSlider();
      }
      prev.onclick = function () {
        if (active - 1 < 0) {
          active = lenghItems;
        }
        else {
          active -= 1;
        }
        reloadSlider();
      }
      let refreshSlider = setInterval(() => { next.click() }, 4000)
      function reloadSlider() {
        let checkLeft = items[active].offsetLeft;
        list.style.left = -checkLeft + 'px';

        let lastActiveDot = document.querySelector('.slider .dots li.active');
        lastActiveDot.classList.remove('active');
        dots[active].classList.add('active');
        clearInterval(refreshSlider);
        refreshSlider = setInterval(() => { next.click() }, 6000);
      }
      dots.forEach((li, key) => {
        li.addEventListener('click', function () {
          active = key;
          reloadSlider();
        })
      })
    </script>
    <!---------------------------------Kết thúc Slider--------------------------------------------->
    <!---------------------------------Bắt đầu sản phẩm--------------------------------------------->
    <h2> SÁCH BÁN CHẠY</h2>
    <div class="onmainindex">

      <div class="on2main">
        <div class="main"><a href="html/Chiến tranh tiền tệ.html">
          <img src="img/product/Manga – Comic/Chú thuật hồi chiến 1.jpg"></a></div>
        <a href="html/Chú thuật hồi chiến.html">
          <div class="unmain">
         <p>Chú Thuật Hồi Chiến</p>
          <p><b>28.500 đ</b></p>
        </div></a>
      </div>

      <div class="on2main">
        <div class="main"><a href="html/Chiến tranh tiền tệ.html"><img
              src="img/product/Kỹ năng sống - Phát triển cá nhân/Chiến tranh tiền tệ 1.jpg"></div>
        <div class="unmain">
          <p>Chiến Tranh Tiền Tệ</p>
          <p><b>120.900 đ</b></p>
        </div></a>
      </div>

      <div class="on2main">
        <div class="main"><a href="html/Chiến tranh tiền tệ.html"><img src="img/product/Nghệ thuật – Văn hóa/giận 1.jpg" alt=""></a></div>
        <a href="html/Chiến tranh tiền tệ.html"> <div class="unmain">
          <p>Giận</p>
          <p><b>107.000 đ</b></p>
        </div>
        </a>
      </div>

      <div class="on2main">
        <div class="main"><a href="html/Chiến tranh tiền tệ.html"><img
            src="img/product/Nghệ thuật – Văn hóa/Kiếp Nào Ta Cũng Tìm Thấy Nhau 1.jpg" alt=""></div>
            <a href="html/Chiến tranh tiền tệ.html"> <div class="unmain">
          <p>Kiếp Nào Ta Cũng Tìm Thấy Nhau</p>
          <p><b>89.000 đ</b></p>
        </div>
        
      </div>
    </a>
    </div>

    <h2 style="color: red;"> SÁCH MỚI !!!</h2>
    <div class="onmainindex">

      <div class="on2main">
        <div class="main"><a href="html/Chiến tranh tiền tệ.html"></a><img src="img/product/Manga – Comic/SxF 1.jpg" alt=""></div>
        <a href="html/Chiến tranh tiền tệ.html"> <div class="unmain">
          <p>Spy X Family</p>
          <p><b>28.000 đ</b></p>
        </div>
        </a>
      </div>

      <div class="on2main">
        <div class="main"><a href="html/Chiến tranh tiền tệ.html"><img src="img/product/Kỹ năng sống - Phát triển cá nhân/Đắc Nhân Tâm 1.jpg"
            alt=""></div>
        <div class="unmain">
          <p>Đắc Nhân Tâm</p>
          <p><b>77.400 đ</b></p>
        </div></a>
      </div>

      <div class="on2main">
        <div class="main"><a href="html/Chiến tranh tiền tệ.html"><img src="img/product/Nghệ thuật – Văn hóa/hoa sen 1.jpg"></div>
        <div class="unmain">
          <p>Từng Bước Nở Hoa Sen</p>
          <p><b>100.000 đ</b></p>
        </div></a>
      </div>

      <div class="on2main">
        <div class="main"><a href="html/Chiến tranh tiền tệ.html"><img src="img/product/Manga – Comic/conan 1.jpg" alt=""></a></div>
        <a href="html/Chiến tranh tiền tệ.html">

        <div class="unmain">
          <p>Thám Tử Lừng Danh Conan</p>
          <p><b>26.000 đ</b></p>
        </div>
      </div>
    </a>
    </div>
    <!---------------------------------Kết thúc sản phẩm--------------------------------------------->
    <!-----------------------------------Bắt đầu Footer------------------------------------------->
    <section class="contact" id="contact">
      <h2>Liên hệ với chúng tôi</h2>
      <p>Hãy liên hệ với chúng tôi nếu có bất kỳ thắc mắc hoặc phản hồi nào.</p>
      <p>
        -----------------------------------------------------------------------------------------------------------------
      </p>
      <div class="contact-details">
        <div class="left-column">
          <p><i class="fas fa-map-marker-alt"></i> 273 An Dương Vương, Quận 5</p>
          <p><i class="fas fa-envelope"></i> HAT2004@gmail.com</p>
          <p><i class="fas fa-phone"></i> (84) 796553739</p>
        </div>
        <div class="right-column">
          <p><i class="fas fa-clock"></i> Thứ hai - Thứ bảy: 9:00 Sáng - 5:00 Chiều</p>
          <p><i class="fas fa-clock"></i> Chủ nhật: Đóng cửa</p>
          <p><i class="fas fa-globe"></i> www.hatbook.com</a></p>
        </div>
        <div class="getdetail">
          <h3>Nhận thông báo từ chúng tôi:</h3>
          <form>
            <label for="emailInput">Email:</label>
            <input type="email" id="emailInput" name="email" placeholder="Nhập địa chỉ email của bạn" required>
            <input type="submit" value="Gửi">
          </form>
        </div>
      </div>
    </section>
  </div>
  </div>
  <footer>
    <div>
      <span>Copyright © 2023 All Rights Reserved</span>
      <span class="link">
        <a href="html/index.html">Trang chủ</a>
      </span>
    </div>
  </footer>

</body>

</html>