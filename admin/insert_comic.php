<?php
session_start(); 
include_once "connection.php"; // Kết nối đến cơ sở dữ liệu

// Lấy dữ liệu từ form
$comicName = $_POST['comicName'];
$avatarLink = $_POST['avatarLink'];
$description = $_POST['description'];
$genreIDfk = $_POST['genreID'];
$transIDfk = $_POST['transteamID'];
$selectedGenres = $_POST['genreIDs'];

// SQL Insert Query
$sql = "INSERT INTO comic (comicName, avatarLink,views,views_in_month,views_in_week, description, created_at, updated_at) VALUES ('$comicName', '$avatarLink',0,0,0, '$description', NOW(), NOW())";
if ($conn->query($sql) === TRUE) {
    $comicID_last = mysqli_insert_id($conn);
    echo "Comic added successfully!";
    $sql2 = "INSERT INTO comic_trans (comicIDfk, transIDfk) VALUES ($comicID_last,$transIDfk);";
    if($conn->query($sql2) === TRUE){
        echo "Comic_trans added successfully!";
        $success = true;

// Lặp qua mảng chứa các thể loại được chọn
        foreach ($selectedGenres as $genreIDfk) {
            // Câu truy vấn SQL để thêm một bản ghi vào bảng comic_genre
            $sql3 = "INSERT INTO comic_genre (comicIDfk, genreIDfk) VALUES ($comicID_last, $genreIDfk)";
            
            // Thực hiện truy vấn và kiểm tra kết quả
            if ($conn->query($sql3) === TRUE) {
                // Không cần thông báo gì nếu thêm thành công
            } else {
                // Đánh dấu cờ thành công là false nếu có lỗi
                $success = false;
                // Thêm thông tin lỗi vào thông báo của người dùng (tùy chọn)
                $_SESSION['message'] .= "Error adding genre ID $genreIDfk: " . $conn->error . "\n";
            }
        }

        // Kiểm tra trạng thái cờ thành công
        if ($success) {
            echo "All genres added successfully!";
            $_SESSION['status'] = true;
            $_SESSION['message'] = "Successful update!";
        } else {
            echo "Error adding genres: " . $_SESSION['message'];
            $_SESSION['status'] = false;
        }
    }
    else {
        $_SESSION['status'] = false;
        $_SESSION['message'] = $conn->error;
        echo "Error adding comic_trans: " . $conn->error;
    }
} else {
    $_SESSION['status'] = false;
    $_SESSION['message'] = $conn->error;
    echo "Error adding comic: " . $conn->error;
}
header("Location:./addComic.php");
$conn->close(); // Đóng kết nối
?>
