<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Chapter</title>
</head>
<body>

<h2>Add Chapter</h2>
<form method="post" action="getListChapter.php">
    <label for="comicID">Select Comic:</label><br>
    <select id="comicID" name="comicID">
        <?php
        include_once "connection.php"; // Kết nối đến cơ sở dữ liệu

        // Truy vấn để lấy tất cả các truyện từ cơ sở dữ liệu
        $sql = "SELECT comicID, comicName FROM comic.comic";
        $result = $conn->query($sql);

        // Hiển thị tất cả các truyện trong dropdown menu
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["comicID"] . "'>" . $row["comicName"] . "</option>";
            }
        } else {
            echo "<option value=''>No comics found</option>";
        }
        ?>
    </select><br><br>
    
    <label for="chapterID">Chapter Number/Position List:</label><br>
    <select type="text" id="chapterID" name="chapterID" ></select><br><br>
    
    <input type="submit" value="Add Image Chapter">
</form>
<script src="./jquery.min.js"></script>
</body>
</html>
<script>
$(document).ready(function(){
    $('#comicID').on('click', function(){
        // Xử lý khi dropdown menu thay đổi giá trị
        // Đoạn mã trong đây sẽ được thực thi khi người dùng chọn một truyện mới từ dropdown menu
        var comicID = $(this).val();
        $.ajax({
            url: "getListChapter.php",
            type: "post",
            dataType: "html",
            data: {
                comicID
            }
        }).done(function(result){
            const row = JSON.parse(result);
            console.log(result);
            $('#chapterID').empty();
            
            // Thêm các option mới từ dữ liệu mảng result
            for (var i = 0; i < row.length; i++) {
                $('#chapterID').append('<option value="' + row[i].chapterID + '">' + row[i].chapter_number_pos + '</option>');
                alert(row[i].chapterID);
            }
        })
    });
});
</script>