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
    include_once "connection.php";
    // Truy vấn cơ sở dữ liệu để lấy danh sách nhóm dịch
    $sql_trans = "SELECT * FROM transteam";
    $result_trans = $conn->query($sql_trans);

    // Truy vấn cơ sở dữ liệu để lấy danh sách thể loại
    $sql_genre = "SELECT * FROM genre";
    $result_genre = $conn->query($sql_genre);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comic</title>
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
    if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
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
    <h2>Add Comic</h2>
    <form method="post" action="insert_comic.php">
        <div class="form-group">
            <label for="comicName">Comic Name:</label>
            <input type="text" class="form-control" id="comicName" name="comicName" required>
        </div>
        <div class="form-group">
            <label for="avatarLink">Avatar Link:</label>
            <input type="text" class="form-control" id="avatarLink" name="avatarLink" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="genre">Genre:</label>
            <select class="form-control" id="genreID" name="genreID">
                <?php
                    // Hiển thị danh sách thể loại
                    if ($result_genre->num_rows > 0) {
                        while($row_genre = $result_genre->fetch_assoc()) {
                            echo "<option value='" . $row_genre["genreID"] . "'>" . $row_genre["genrename"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No genres found</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="transteam">TransTeam:</label>
            <select class="form-control" id="transteamID" name="transteamID">
                <?php
                    // Hiển thị danh sách nhóm dịch
                    if ($result_trans->num_rows > 0) {
                        while($row_trans = $result_trans->fetch_assoc()) {
                            echo "<option value='" . $row_trans["transteamID"] . "'>" . $row_trans["transname"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No trans teams found</option>";
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Comic</button>
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
    // Đóng kết nối cơ sở dữ liệu
    mysqli_close($conn);
                }
            }
?>
