const inputFiles = document.querySelectorAll('.input_file');
const productPics = document.querySelectorAll('[id^="product_pic"]');
const reUserForm = document.getElementById('suaUserForm');
const reuserBtn = document.getElementById('suanguoidung');
const boxreuser = document.getElementById('boxsuauser');
function hienBoxSuaUser(id, user, name, email, pass) {
    var boxSuaUser = document.getElementById('boxsuauser');
    var overlay = document.querySelector('.overlay');
    var idInput = document.getElementById('id');
    var userInput = document.getElementById('user');
    var nameInput = document.getElementById('name');
    var emailInput = document.getElementById('email');
    var passInput = document.getElementById('pass');

    // Đổ dữ liệu vào form chỉnh sửa
    idInput.value = id;
    userInput.value = user;
    nameInput.value = name;
    emailInput.value = email;
    passInput.value = pass;

    if (boxSuaUser.style.display === 'block') {
        boxSuaUser.style.display = 'none';
        overlay.classList.remove('show-overlay');
        document.body.classList.remove('no-scroll');
    } else {
        boxSuaUser.style.display = 'block';
        overlay.classList.add('show-overlay');
        document.body.classList.add('no-scroll');
    }
}


reUserForm.addEventListener('submit', function (event) {
    event.preventDefault();
    boxreuser.style.display = 'none';
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

var form = document.getElementById("formId");
function submitForm(event) {
    event.preventDefault();
}

form.addEventListener('submit', submitForm);

function del(element) {
    var changeImgDiv = element.parentNode.parentNode;
    var pic = changeImgDiv.querySelector("img");
    var input = changeImgDiv.querySelector(".input_file");
    var result = confirm("Bạn có chắc muốn xóa hình không ?");
    if (result) {
        alert("Xóa hình thành công!!!")
    }
}

