<?php
session_start(); 
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
    <title>Add Genre</title>
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
    <h2>Add Genre</h2>
    <form method="post" action="insert_genre.php">
        <div class="form-group">
            <label for="genreID">Genre:</label><br>
            <select class="form-control" id="genreID" name="genreID">
                <?php
                include_once "connection.php"; // Kết nối đến cơ sở dữ liệu

                // Truy vấn để lấy tất cả các thể loại từ cơ sở dữ liệu
                $sql = "SELECT genreID, genrename FROM comic.genre";
                $result = $conn->query($sql);

                // Hiển thị tất cả các thể loại trong dropdown menu
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["genreID"] . "'>" . $row["genrename"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No genre found</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="genrename">Genre Name:</label>
            <input type="text" class="form-control" id="genrename" name="genrename" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <button type="submit" class="btn btn-primary">Add Genre</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
