<?php session_start(); 
  if (isset($_SESSION['login']) == false) {
    header("Location: login.php");
  }
  else {
    if (($_SESSION['login']) == false) {
      header("Location: login.php");
    }
    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Chapter</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body>
<?php
    if (isset($_SESSION['status'])) {
      if ($_SESSION['status'] == false) {
?>
        <div id="error_box" class="alert alert-danger alert-dismissible fade show" style="position: sticky;top: 8vh;width: 100%; z-index:1; text-align: center;">
          <strong>Thất bại! </strong><span id="error"><?php echo($_SESSION['message']) ?></span>
        </div>
<?php
        // $_SESSION['error'] = "";
        unset($_SESSION['status']);
      }
        if ($_SESSION['status'] == true) {
?>
          <div id="error_box" class="alert alert-success alert-dismissible fade show" style="position: sticky;top: 8vh;width: 100%; z-index:1; text-align: center;">
            <strong>Thành công! </strong><span id="error"><?php echo($_SESSION['message']) ?></span>
          </div>
<?php
          // $_SESSION['success'] = "";
          unset($_SESSION['status']);
        }
    }
?>
<div class="container mt-5">
    <h2>Add Chapter</h2>
    <form method="post" action="insert_chapter.php">
        <div class="form-group">
            <label for="comicID">Select Comic:</label>
            <select class="form-control" id="comicID" name="comicID">
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
            </select>
        </div>
        <div class="form-group">
            <label for="maxCurrentChapter">Max Current Chapter:</label>
            <input type="text" class="form-control" id="maxCurrentChapter" name="maxCurrentChapter" readonly>
        </div>
        <div class="form-group">
            <label for="chapterNumberPos">Chapter Number/Position:</label>
            <input type="text" class="form-control" id="chapterNumberPos" name="chapterNumberPos" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Chapter</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#comicID').on('click', function(){
        // Xử lý khi dropdown menu thay đổi giá trị
        // Đoạn mã trong đây sẽ được thực thi khi người dùng chọn một truyện mới từ dropdown menu
        var comicID = $(this).val();
        $.ajax({
            url: "checkNewestChapter.php",
            type: "post",
            dataType: "html",
            data: {
                comicID
            }
        }).done(function(result){
            const row = JSON.parse(result);
            $("#chapterNumberPos").val("");
            $("#maxCurrentChapter").val(row.max_current_chapter);
        })
    });
});
</script>
<script>
    // Tự động đóng thông báo sau 3 giây
    setTimeout(function() {
    var errorBox = document.getElementById('error_box');
    if (errorBox) {
        errorBox.style.display = 'none';
    }
}, 3000);
</script>
</body>
</html>
<?php
    }
}
?>
