<?php
session_start();
// Kết nối đến cơ sở dữ liệu
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Nhận dữ liệu từ yêu cầu POST
$data = json_decode(file_get_contents("php://input"), true);

// Trích xuất dữ liệu từ yêu cầu
$name = mysqli_real_escape_string($conn, $data['name']);
$phone = mysqli_real_escape_string($conn, $data['phone']);
$address = mysqli_real_escape_string($conn, $data['address']);
$id = $_SESSION['id'];

// Cập nhật thông tin người nhận trong cơ sở dữ liệu
$sql = "UPDATE `user` SET `name`='$name', `phone`='$phone', `address`='$address' WHERE `id`='$id'"; // Thay thế 'ID_CUA_BAN' bằng phương thức lấy ID của người dùng từ session hoặc một cách thích hợp khác

if (mysqli_query($conn, $sql)) {
    // Gửi phản hồi JSON về trình duyệt để xác nhận rằng thông tin đã được cập nhật thành công
    echo json_encode(array("message" => "Thông tin người nhận đã được cập nhật thành công"));
} else {
    // Gửi phản hồi JSON về trình duyệt để báo lỗi nếu có vấn đề xảy ra trong quá trình cập nhật
    echo json_encode(array("message" => "Có lỗi xảy ra khi cập nhật thông tin người nhận: " . mysqli_error($conn)));
}

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);
?>
