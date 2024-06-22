<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Thông tin kết nối CSDL
$servername = "62.72.46.190";
$username = "admin02";
$password = "Hoangnam147*";
$dbname = "payment";

// Tạo kết nối đến CSDL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}
$conn->query("SET time_zone = '+07:00'");

?>