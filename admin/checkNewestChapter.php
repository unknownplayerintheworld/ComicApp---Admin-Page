<?php
 session_start(); 
 include "./connection.php"; ?>

<?php
    $output = "";
    $output_arr = array();
    if (isset($_POST['comicID'])) {
        $comicID = $_POST['comicID'];

        $sqlQuery = 
        // "SELECT account_guess.username AS username,card.cardID AS cardID,
        //                 card.type AS type,
        //                     vehicleinout.licensePlate AS licensePlate 
        //                         FROM card LEFT JOIN monthcard ON cardID = monthcardID 
        //                     LEFT JOIN vehicleinout on vehicleinout.cardID = card.cardID 
        //                 LEFT JOIN account_guess on account_guess.CardID = card.cardID
        //             WHERE card.cardID = '$cardID' and (card.display = 1 OR monthcard.display = 1) order by time desc limit 1;"
        "select max(chapter_number_pos) as max_current_chapter from chapter inner join comic on chapter.chapter_comicID = comic.comicID where comicID = $comicID"
                    ;
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $output_arr['max_current_chapter'] = $row['max_current_chapter'];
            }
        }
    }
    $encode = json_encode($output_arr, JSON_UNESCAPED_UNICODE);
    echo($encode);

    mysqli_close($conn);
?>