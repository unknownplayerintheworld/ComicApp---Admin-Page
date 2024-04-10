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
    <title>Add Translation Team</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
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
<body>
    <div class="container mt-5">
        <h2>Add Translation Team</h2>
        <form action="insert_transteam.php" method="post">
            <div class="form-group">
                <label for="transname">Translation Team Name:</label>
                <input type="text" class="form-control" id="transname" name="transname" required>
            </div>
            <div class="form-group">
                <label for="transslogan">Translation Team Slogan:</label>
                <input type="text" class="form-control" id="transslogan" name="transslogan">
            </div>
            <div class="form-group">
                <label for="transavatar">Translation Team Avatar:</label>
                <input type="text" class="form-control" id="transavatar" name="transavatar" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Team</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<script>
    // Tự động đóng thông báo sau 3 giây
    setTimeout(function() {
    var errorBox = document.getElementById('error_box');
    if (errorBox) {
        errorBox.style.display = 'none';
    }
}, 3000);
</script>
<?php
    }
}
?>