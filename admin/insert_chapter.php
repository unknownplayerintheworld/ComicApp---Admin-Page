<?php
session_start(); 
include_once "connection.php"; // Kết nối đến cơ sở dữ liệu

// Lấy dữ liệu từ form
$chapterPos = $_POST['chapterNumberPos'];
$comicID = $_POST['comicID'];
// echo $comicID."|".$chapterPos;

// SQL Insert Query
$sql = "INSERT INTO chapter (chapter_number_pos, chapter_comicID, updated_at) VALUES ('$chapterPos', '$comicID',NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Comic added successfully";
    $_SESSION['status'] = true;
    $_SESSION['message'] = "Successful update!";
} else {
    echo "Error adding comic: " . $conn->error;
    $_SESSION['status'] = false;
    $_SESSION['message'] = $conn->error;
}
header("Location:./addChapter.php");
$conn->close(); // Đóng kết nối
?>
