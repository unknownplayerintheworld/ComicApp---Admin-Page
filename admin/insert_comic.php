<?php
session_start(); 
include_once "connection.php"; // Kết nối đến cơ sở dữ liệu

// Lấy dữ liệu từ form
$comicName = $_POST['comicName'];
$avatarLink = $_POST['avatarLink'];
$description = $_POST['description'];
$genreIDfk = $_POST['genreID'];
$transIDfk = $_POST['transteamID'];

// SQL Insert Query
$sql = "INSERT INTO comic (comicName, avatarLink,views,views_in_month,views_in_week, description, created_at, updated_at) VALUES ('$comicName', '$avatarLink',0,0,0, '$description', NOW(), NOW())";
if ($conn->query($sql) === TRUE) {
    $comicID_last = mysqli_insert_id($conn);
    echo "Comic added successfully!";
    $sql2 = "INSERT INTO comic_trans (comicIDfk, transIDfk) VALUES ($comicID_last,$transIDfk);";
    if($conn->query($sql2) === TRUE){
        echo "Comic_trans added successfully!";
        $sql3 = "INSERT INTO comic_genre (comicIDfk, genreIDfk) VALUES
        ($comicID_last, $genreIDfk);";
        if($conn->query($sql3) === TRUE){
            echo "Comic_genre added successfully!";
            $_SESSION['status'] = true;
            $_SESSION['message'] = "Successful update!";
        }
        else{
            $_SESSION['status'] = false;
            $_SESSION['message'] = $conn->error;
            echo "Error adding comic_genre: " . $conn->error;
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
