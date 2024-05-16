<style>
    .apply-button {
    color: white; /* Thiết lập màu chữ thành trắng */
    background-color: black; /* Thiết lập màu nền thành đen */
    border: none; /* Xóa viền */
    padding: 10px 20px; /* Tùy chỉnh padding */
    border-radius: 5px; /* Bo tròn góc */
    cursor: pointer; /* Biến con trỏ thành hình bàn tay khi hover */
}

.apply-button:hover {
    background-color: #333; /* Thay đổi màu nền khi hover */
}

</style>
        <div class="show">
            <form method="POST" action="searchadvance.php">
                <div id="accordion">
                    <div class="cap">Tìm kiếm nâng cao</div>
                    <input type="text" name="productName" placeholder="Nhập tên sản phẩm cần tìm" style="width: 90%; padding: 10px; border-radius: 8px; margin: 8px;">
                    <!-- Thể loại -->
                    <div class="cap1">Thể loại:</div>
                    <div class="ct">
                        <label><input type="checkbox" name="theloai[]" value="1">Kỹ năng sống phát triển cá nhân</label>
                        <label><input type="checkbox" name="theloai[]" value="2">Manga-Comic</label>
                        <label><input type="checkbox" name="theloai[]" value="3">Nghệ thuật văn hóa</label>
                    </div>
                    <!-- Giá bán -->
                    <div class="cap1">Giá bán:</div>
                    <div class="ct">
                        <label><input type="checkbox" name="giaban[]" value="4">&#60 100.000 đ</label>
                        <label><input type="checkbox" name="giaban[]" value="5">100.000 đ - 500.000 đ</label>
                        <label><input type="checkbox" name="giaban[]" value="6">500.000 đ - 1.000.000 đ</label>
                    </div>
                    <!-- Nút Áp dụng -->
                    <button type="submit" name="apply-button" class="apply-button">Áp dụng</button>
                </div>
            </form>