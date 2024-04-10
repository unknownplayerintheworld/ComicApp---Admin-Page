<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $genrename = $_POST['genrename'];
    $description = $_POST['description'];

    // Kiểm tra xem thể loại đã tồn tại chưa
    $check_query = "SELECT * FROM genre WHERE genrename = '$genrename'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "Thể loại đã tồn tại!";
        $_SESSION['status'] = false;
        $_SESSION['message'] = $conn->error;
    } else {
        // Thêm thể loại mới vào cơ sở dữ liệu
        $insert_query = "INSERT INTO genre (genrename, description) VALUES ('$genrename', '$description')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Thêm thể loại thành công!";
            $_SESSION['status'] = true;
            $_SESSION['message'] = "Successful update!";
        } else {
            $_SESSION['status'] = false;
            $_SESSION['message'] = $conn->error;
            echo "Lỗi: " . $conn->error;
        }
    }
    header("Location:./addGenre.php");
}
?>
