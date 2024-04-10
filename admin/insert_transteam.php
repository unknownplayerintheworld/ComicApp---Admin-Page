<?php 
session_start(); 
if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
    header("Location: login.php");
    exit;
}

include_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý dữ liệu gửi từ biểu mẫu
    $transname = $_POST['transname'];
    $transslogan = $_POST['transslogan'];
    $transavatar = $_POST['transavatar'];

    // Kiểm tra xem tên nhóm đã tồn tại trong cơ sở dữ liệu chưa
    $check_sql = "SELECT * FROM transteam WHERE transname = '$transname'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "Error: Translation team name already exists";
    } else {
        // Thực hiện truy vấn để thêm nhóm dịch vào cơ sở dữ liệu
        $sql = "INSERT INTO transteam (transname, transslogan, transavatar) VALUES ('$transname', '$transslogan', '$transavatar')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['status'] = true;
            $_SESSION['message'] = "Successful update!";
            echo "New trans team added successfully";
        } else {
            $_SESSION['status'] = false;
            $_SESSION['message'] = "Successful update!";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    header("Location:./addTransteam.php");
    $conn->close();
}
?>