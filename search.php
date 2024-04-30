<?php
session_start();
include("classfunctionPHPdatabase.php");
$p = new database();
$conn = $p->connect();

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}
if(isset($_POST['search'])) {
    $search = $_POST['search'];
<<<<<<< Updated upstream
    $sql = "SELECT * FROM product WHERE pro_name LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["pro_id"]. " - Name: " . $row["pro_name"].   " - Price: $" . $row["pro_price"]. "<br>";
=======
    $sql = "SELECT * FROM product WHERE pro_name LIKE CONCAT('%', ?, '%')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<img src='" . $row["pro_image1"] . "' alt='" . $row["pro_name"] . "' style='width:100px;height:100px;'>";
            echo "ID: " . $row["pro_id"]. " - Name: " . $row["pro_name"]. " - Price: $" . $row["pro_price"]. "<br>";
            echo "</div>";
>>>>>>> Stashed changes
        }
    } else {
        echo "0 results found";
    }
}

$conn->close();
<<<<<<< Updated upstream
?>
=======
?>
>>>>>>> Stashed changes
