<?php
$servername = "roundhouse.proxy.rlwy.net"; // Tên máy chủ MySQL
$post = "12665";
$username = "root"; // Tên người dùng MySQL
$password = "hXQXtCfafwuFYffuMNkaZbXFRwOyldmg"; // Mật khẩu MySQL
$dbname = "comic"; // Tên cơ sở dữ liệu MySQL

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname,$post);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
