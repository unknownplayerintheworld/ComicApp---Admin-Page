<?php
session_start(); 
    include "./connection.php";
    
    $output_arr = array();
    
    if (isset($_POST['comicID'])) {
        $comicID = $_POST['comicID'];
    
        $sqlQuery = "SELECT * FROM chapter INNER JOIN comic ON chapter.chapter_comicID = comic.comicID WHERE comicID = $comicID";
        $result = mysqli_query($conn, $sqlQuery);
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $chapter_data = array(); // Tạo một mảng con mới trong mỗi vòng lặp
                $chapter_data['chapterID'] = $row['chapterID'];
                $chapter_data['chapter_number_pos'] = $row['chapter_number_pos'];
                $output_arr[] = $chapter_data; // Thêm mảng con vào mảng chính
            }
        }
    }
    
    $encode = json_encode($output_arr, JSON_UNESCAPED_UNICODE);
    echo($encode);
    
    mysqli_close($conn);
?>
