<?php
include("../classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$option = $_GET['option'];

$sql = "";
if ($option == "active") {
    $sql = "SELECT * FROM user WHERE locked = 0 AND id > 1";
} elseif ($option == "locked") {
    $sql = "SELECT * FROM user WHERE locked = 1 AND id > 1";
} else {
    $sql = "SELECT * FROM user WHERE id > 1";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["user"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["pass"]."</td>";
       
        if ($row["locked"] == 0) {
            echo "<td style='color: green;'>Hoạt động</td>";

        } else {
            echo "<td style='color: grey;'>Bị khóa</td>";
        }
        
        echo "</td>";
        echo "<td>";
        echo "<button id='suanguoidung' onclick='hienBoxSuaUser(\"".$row['id']."\", \"".$row['user']."\", \"".$row['name']."\", \"".$row['email']."\", \"".$row['pass']."\")'>Sửa</button>";

        if ($row["locked"] == 1) {
            // Nếu người dùng đã bị khóa, hiển thị nút "Mở khóa"
            echo "<button class='xoanguoidung' onclick='performAction(\"unlock\", \"". $row['id'] ."\")'>Mở khóa</button>";

        } else {
            // Nếu người dùng chưa bị khóa, hiển thị nút "Khóa"
            echo "<button class='xoanguoidung' onclick='performAction(\"lock\", \"". $row['id'] ."\")'>Khóa</button>";
        }
        
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "0 kết quả";
}
$conn->close();
?>