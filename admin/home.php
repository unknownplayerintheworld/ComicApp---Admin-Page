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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Admin Page - Rule Them All</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
        }
        .header {
            background-color: #1E90FF;
            color: #fff;
            padding: 10px;
            text-align: right;
            position: fixed;
            top: 0;
            right: 0;
            z-index: 9999;
            width: 100%;
        }
        .container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
            text-align: center;
        }
        h1 {
            text-align: center;
            font-size: 36px;
            color: #1E90FF;
            text-shadow: 2px 2px #000;
        }
        .button {
            display: inline-block;
            width: 200px;
            padding: 15px;
            margin: 20px;
            background-color: #FF4500;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        .button:hover {
            background-color: #FFA500;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #1E90FF;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <span>Welcome, <?php echo $_SESSION['user']; ?></span>
    </div>
    <div class="container">
        <h1>Admin Page - Rule Them All</h1>
        <a href="./addComic.php" class="btn btn-primary">Add Story</a>
        <a href="./addChapter.php" class="btn btn-primary">Add Chapter</a>
        <a href="./addImageChapter.php" class="btn btn-primary">Add Chapter Image</a>
        <a href="./addTransteam.php" class="btn btn-primary">Add Trans Team</a>
        <a href="./addGenre.php" class="btn btn-primary">Add Genre</a>
    </div>
    <div class="footer">
        <p>&copy; 2024 Admin Page - All rights reserved.</p>
    </div>
</body>
</html>
<?php
  }
}
?>