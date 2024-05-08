const inputFiles = document.querySelectorAll('.input_file');
const productPics = document.querySelectorAll('[id^="product_pic"]');
const reUserForm = document.getElementById('suaUserForm');
const reuserBtn = document.getElementById('suanguoidung');
const boxreuser = document.getElementById('boxsuauser');

function hienBoxSuaUser1(pro_id, pro_img1, pro_img2, pro_img3, pro_name,pro_author,pro_publisher,pro_description,pro_quantity,pro_price,id_category) {
    var boxSuaUser = document.getElementById('boxsuauser');
    var overlay = document.querySelector('.overlay');
    var pro_idInput = document.getElementById('pro_id');
    var pro_img1Input = document.getElementById('pro_img1');
    var pro_img2Input = document.getElementById('pro_img2');
    var pro_img3Input = document.getElementById('pro_img3');
    var pro_nameInput = document.getElementById('pro_name');
    var pro_authorInput = document.getElementById('pro_author');
    var pro_publisherInput = document.getElementById('pro_publisher');
    var pro_descriptionInput = document.getElementById('pro_description');
    var pro_quantityInput = document.getElementById('pro_quantity');
    var pro_priceInput = document.getElementById('pro_price');
    var id_categoryInput = document.getElementById('id_category');

    // Đổ dữ liệu vào form chỉnh sửa
    pro_idInput.value = pro_id;
    pro_img1Input.value = pro_img1;
    pro_img2Input.value = pro_img2;
    pro_img3Input.value = pro_img3;
    pro_nameInput.value = pro_name;
    pro_authorInput.value = pro_author;
    pro_publisherInput.value = pro_publisher;
    pro_descriptionInput.value = pro_description;
    pro_quantityInput.value = pro_quantity;
    pro_priceInput.value = pro_price;
    id_categoryInput.value = id_category;

    if (boxSuaUser.style.display === 'block') {
        boxSuaUser.style.display = 'block';
        overlay.classList.remove('show-overlay');
        document.body.classList.remove('no-scroll');
    } else {
        boxSuaUser.style.display = 'block';
        overlay.classList.add('show-overlay');
        document.body.classList.add('no-scroll');
    }
}

reuserBtn.addEventListener('click', function() {
    // Lấy dữ liệu từ các trường và hiển thị hộp sửa thông tin sản phẩm
    hienBoxSuaUser1(pro_id, pro_img1, pro_img2, pro_img3, pro_name, pro_author, pro_publisher, pro_description, pro_quantity, pro_price, id_category);
});

reUserForm.addEventListener('submit', function (event) {
    // Ngăn chặn form gửi dữ liệu mặc định
    event.preventDefault();
    boxreuser.style.display = 'none'; // Ẩn hộp sửa thông tin sản phẩm sau khi gửi form
});

for (let i = 0; i < inputFiles.length; i++) {
    inputFiles[i].addEventListener('change', function (event) {
        const inputFile = event.target;
        const productPic = productPics[i];

        if (inputFile.files && inputFile.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                productPic.src = e.target.result;
                productPic.style.display = "block";
            }

            reader.readAsDataURL(inputFile.files[0]);
        }
    });
}

function del(element) {
    var changeImgDiv = element.parentNode.parentNode;
    var pic = changeImgDiv.querySelector("img");
    var input = changeImgDiv.querySelector(".input_file");
    var result = confirm("Bạn có chắc muốn xóa hình không ?");
    if (result) {
        alert("Xóa hình thành công!!!");
    }
}
