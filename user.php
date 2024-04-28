<?php
// user.php

function checkuser($user, $pass){
    $conn = classfunctionPHPdatabase(); // Đảm bảo rằng bạn đã có hàm classfunctionPHPdatabase() trong tệp classfunctionPHPdatabase.php và nó trả về kết nối PDO
    $stmt = $conn->prepare("SELECT * FROM user WHERE user = :user AND pass = :pass");
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['role'];
    } else {
        return 0; // Trả về 0 nếu không tìm thấy người dùng
    }
}
?>
