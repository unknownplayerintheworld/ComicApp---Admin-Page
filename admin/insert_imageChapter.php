<?php
session_start(); 
include_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comicID']) && isset($_POST['chapterID']) && isset($_POST['imagechapter'])) {
    $comicID = $_POST['comicID'];
    $chapterID = $_POST['chapterID'];
    $imagechapter = $_POST['imagechapter'];

    // Tách chuỗi imageChapter thành mảng các link ảnh
    $imageLinks = explode(",", $imagechapter);
    $i = 1;

    // Lặp qua mảng và thêm từng link ảnh vào cơ sở dữ liệu
    foreach ($imageLinks as $link) {
        $link = trim($link); // Loại bỏ khoảng trắng thừa
        if (!empty($link)) {
            // Thực hiện truy vấn INSERT để thêm link ảnh vào bảng imagechapter
            $sql = "INSERT INTO imagechapter (link, image_chapterID,image_pos) VALUES ('$link', $chapterID,$i)";
            if (mysqli_query($conn, $sql)) {
                echo "Link ảnh '$link' đã được thêm thành công!";
                $_SESSION['status'] = true;
                $_SESSION['message'] = "Successful update!";
            } else {
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                $_SESSION['status'] = false;
                $_SESSION['message'] = $conn->error;
            }
            $i++;
        }
    }
    header("Location:./addImageChapter.php");
    mysqli_close($conn);
}
?>
